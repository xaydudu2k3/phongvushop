<?php

namespace App\Http\View\Composers;

use App\Models\Order;
use App\Models\Promotion;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderComposer
{
  protected $users;

  public function __construct()
  {
  }

  private function getProductPrice($product)
  {
    $price = $product->price;
    if ($product->promotion && $product->promotion->sale > 0) {
      $price = $price * (1 - $product->promotion->sale);
    }
    return $price;
  }
  public function compose(View $view): void
  {
    $customer = Auth::guard('cus')->user();
    $orders = Order::with(['customer', 'user', 'status', 'orderdetails.product','sale'])
      ->where('customer_id', $customer->id)->orderBy('id','desc')->get();
    foreach ($orders as $order) {
      foreach ($order->orderdetails as $detail) {
        $detail->price_sale = $this->getProductPrice($detail->product);
      }
    }
    $view->with('orders', $orders);
  }
}
