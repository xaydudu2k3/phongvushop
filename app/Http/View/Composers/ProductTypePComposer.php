<?php

namespace App\Http\View\Composers;

use App\Models\ProductType;
use Illuminate\View\View;

class ProductTypePComposer
{
  protected $users;

  public function __construct()
  {
  }

  
  public function compose(View $view): void
  {
    $product_types = ProductType::select('product_types.*')->orderBy('id')->get();
    $view->with('product_types',$product_types);
  }
}
