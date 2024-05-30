<?php

namespace App\HTTP\Services;

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartService
{

  public function create($request)
  {
    $quantity = (int) $request->input('num_product');
    $product_id = (int) $request->input('product_id');

    if ($quantity <= 0 || $product_id <= 0) {
      Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác');
      return false;
    }

    $carts = Session::get('carts');
    if (is_null($carts)) {
      Session::put('carts', [
        $product_id => $quantity
      ]);
      $carts = [];
      return true;
    }
    $uniqueProductCount = count($carts);
    if (!isset($carts[$product_id]) && $uniqueProductCount >= 5) {
      Session::flash('error', 'Không thể thêm quá 5 sản phẩm vào giỏ hàng');
      return false;
    }

    $exists = Arr::exists($carts, $product_id);
    if ($exists) {
      $carts[$product_id] += $quantity;
      Session::put('carts', $carts);
      return true;
    }
  // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
    if (isset($carts[$product_id])) {
      $carts[$product_id] += $quantity;
    } else {
      $carts[$product_id] = $quantity;
    }
    Session::put('carts', $carts);

    return true;
  }
  // public function create($request)
  // {
  //   $quantity = (int) $request->input('num_product');
  //   $product_id = (int) $request->input('product_id');

  //   if ($quantity <= 0 || $product_id <= 0) {
  //     Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác');
  //     return false;
  //   }

  //   $carts = Session::get('carts', []);

  //   // Kiểm tra tổng số lượng sản phẩm trong giỏ hàng
  //   $totalQuantity = array_sum($carts);
  //   if ($totalQuantity + $quantity > 2) {
  //     Session::flash('error', 'Không thể thêm quá 5 sản phẩm vào giỏ hàng');
  //     return false;
  //   }

  //   // Nếu giỏ hàng rỗng, tạo mới giỏ hàng
  //   if (empty($carts)) {
  //     Session::put('carts', [
  //       $product_id => $quantity
  //     ]);
  //     return true;
  //   }

  //   // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
  //   if (isset($carts[$product_id])) {
  //     $carts[$product_id] += $quantity;
  //   } else {
  //     $carts[$product_id] = $quantity;
  //   }

  //   Session::put('carts', $carts);
  //   return true;
  // }


  public function getProduct()
  {
    $carts = Session::get('carts');
    if (is_null($carts))
      return [];

    $productId = array_keys($carts);
    return Product::with(['promotion'])
      ->select('id', 'name', 'quantity', 'thumb', 'price', 'promotion_id')
      ->whereIn('id', $productId)
      ->get();
  }

  public function update($request)
  {
    Session::put('carts', $request->input('num_product'));
    return true;
  }

  public function delete($productId)
  {
    $carts = Session::get('carts');

    if (is_null($carts) || !Arr::exists($carts, $productId)) {
      Session::flash('error', 'Sản phẩm không tồn tại trong giỏ hàng');
      return false;
    }

    unset($carts[$productId]);

    Session::put('carts', $carts);

    return true;
  }

  public function deleteAll(): bool
  {
    Session::forget('carts');
    return true;
  }

  public function checkSaleToken($cartToken)
  {
    $sale = Sale::where('token', $cartToken)
      ->where('quantity', '>', 0)
      ->first();
    if ($sale) {
      Session::put('sale_id', $sale->id);
    } else {
      return false;
    }
    return true;
  }
  public function addOrder(Request $request)
  {
    // Lấy thông tin khách hàng từ input
    $customer_id = $request->input('customer_id');
    // Tạo một đối tượng Order mới
    $order = new Order();
    $order->customer_id = $customer_id;
    $order->status_id = 1;
    $order->sale_id = Session::get('sale_id');
    $order->save();

    // Lấy giỏ hàng hiện tại
    $carts = Session::get('carts');
    $productIds = array_keys($carts);

    foreach ($productIds as $productId) {
      $product = Product::with(['promotion'])
        ->select('id', 'name', 'quantity', 'thumb', 'price', 'promotion_id')
        ->where('id', $productId)
        ->firstOrFail();
      $product_id = $product->id;
      $quantity = $carts[$productId];
      $price = $product->price - $product->price * $product->promotion->sale;

      // Tạo một đối tượng OrderDetail mới
      $orderDetail = new Orderdetail();
      $orderDetail->order_id = $order->id;
      $orderDetail->product_id = $product_id;
      $orderDetail->quantity = $quantity;
      $orderDetail->price = $price;
      $orderDetail->save();

      // Trừ số lượng sản phẩm trong kho
      $product->quantity -= $quantity;
      $product->save();
    }
    $saleID = session()->get('sale_id');
    if ($saleID) {
      Sale::where('id', $saleID)->decrement('quantity');
      Session::forget('sale_id');
    }
    Session::forget('carts');

    $customer = Auth::guard('cus')->user();
    $content = 'đã đặt thành công, chờ đơn hàng được xác nhận để được giao hàng';
    Mail::send('customer.emails.order', compact('customer', 'order', 'content'), function ($email) use ($customer) {
      $email->subject('Phong Vũ - Chờ duyệt đơn hàng');
      $email->to($customer->email, $customer->name);
    });

    return redirect('/addpay')->with('success', 'Đặt hàng thành công');
  }
}
