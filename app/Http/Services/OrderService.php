<?php

namespace App\HTTP\Services;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderService
{
  public function get()
  {
    return Order::orderbyDesc('id')->paginate(5);
  }

  public function update($request, $order): bool
  {
    $order->status_id = (string) $request->input('status_id');
    if ($order->status_id == 2) {
      $order->userset_id = Auth::user()->id;
    }
    if (!empty($request->input('user_id'))) {
      $order->user_id = (string) $request->input('user_id');
    }
    if ($order->status_id == 5) {
      foreach ($order->orderdetails as $detail) {
        $product = Product::find($detail->product_id);
        $product->quantity += $detail->quantity;
        $product->save();
      }
    }
    $status = '';
    $content = '';
    $sale = Sale::find($order->sale_id);
    $customer = Customer::find($order->customer_id);
    switch ($order->status_id) {
      case 1:
        $status = "Chờ duyệt đơn hàng";
        $content = "đã đặt thành công, chờ đơn hàng được xác nhận để được giao hàng";
      case 2:
        $status = "Đã duyệt đơn hàng";
        $content = "đã được duyệt qua, chờ được giao hàng";
        break;
      case 3:
        $status = "Đang giao hàng";
        $content = "đang trên đường được giao hàng";
        break;
      case 4:
        $status = "Giao hàng thành công";
        $content = "đã được giao hàng thành công";
        break;
      case 5:
        $status = "Đơn hàng bị hủy";
        $content = "đã bị hủy";
        break;
      default:
        $status = "";
        break;
    }
    Mail::send('customer.emails.order', compact('customer', 'order', 'content', 'sale'), function ($email) use ($customer, $status) {
      $email->subject('Phong Vũ - ' . $status);
      $email->to($customer->email, $customer->name);
    });
    $order->update();

    Session::flash('success', 'Cập nhật hóa đơn thành công');
    return true;
  }

  public function destroy($request)
  {
    $id = (int) $request->input('id');
    $order = Order::where('id', $id)->first();
    if ($order) {
      Orderdetail::where('order_id', $order->id)->delete();
      $order->delete();
      return true;
    }

    return false;
  }
}
