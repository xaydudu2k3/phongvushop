<?php

namespace App\Http\View\Composers;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartComposer
{
  protected $users;

  public function __construct()
  {
  }

  public function compose(View $view): void
  {
    $carts = Session::get('carts');
    if (is_null($carts)) return ;

    $productId = array_keys($carts);

    $products = Product::with(['promotion'])
      ->select('id', 'name', 'quantity', 'thumb', 'price', 'promotion_id')
      ->whereIn('id', $productId)
      ->get();
      
    $view->with('products',$products);
  }
}
