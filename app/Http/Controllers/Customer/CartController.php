<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\HTTP\Services\CartService;
use App\Models\Promotion;
use App\Models\Sale;
use Illuminate\Http\JsonResponse as HttpJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class CartController extends Controller
{
  protected $cartService;
  /**
   * Display a listing of the resource.
   */
  public function __construct(CartService $cartService)
  {
    $this->middleware('cus');
    $this->cartService = $cartService;
  }

  public function index(Request $request)
  {
    $result = $this->cartService->create($request);
    if ($result === false) {
      return redirect()->back();
    }
    return view('customer.cart');
  }

  public function show()
  {
    $promotions = Promotion::all();
    $products = $this->cartService->getProduct();

    return view('customer.cart', [
      'title' => 'Giỏ hàng',
      'products' => $products,
      'promotions' => $promotions,
      'carts' => Session::get('carts'),
    ]);
  }

  public function showPay()
  {
    $promotions = Promotion::all();
    $products = $this->cartService->getProduct();
    $saleId = Session::get('sale_id');
    $sale = null;

    if ($saleId) {
      $sale = Sale::findOrFail($saleId);
    }
    return view('customer.pay', [
      'title' => 'Thanh toán',
      'products' => $products,
      'promotions' => $promotions,
      'sale' => $sale,
      'carts' => Session::get('carts'),
    ]);
  }

  public function update(Request $request)
  {
    $this->cartService->update($request);
    return redirect('/carts');
  }

  public function delete($productId): JsonResponse
  {
    $result = $this->cartService->delete($productId);
    if ($result) {
      return response()->json([
        'error' => false,
        'message' => 'Xóa thành công sản phẩm trong giỏ hàng'
      ]);
    }

    return response()->json([
      'error' => true
    ]);
  }

  public function deleteAll(): JsonResponse
  {
    $result = $this->cartService->deleteAll();
    if ($result) {
      return response()->json([
        'error' => false,
        'message' => 'Đã xóa toàn bộ sản phẩm trong giỏ hàng'
      ]);
    }

    return response()->json([
      'error' => true
    ]);
  }

  public function checkSaleToken(Request $request)
  {
    $cartToken = $request->input('cart_token');
    if ($request->filled('cart_token')) {
      $result = $this->cartService->checkSaleToken($cartToken);
      if (!$result) {
        return back()->with('error', 'Mã không tồn tại hoặc là mã đã hết');
      }
    }
    // Session::forget('sale_id');
    return redirect('/pay');
  }

  public function addOrder(Request $request)
  {
    $this->cartService->addOrder($request);
    return redirect('/order');
  }
}
