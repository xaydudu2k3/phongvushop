<?php

namespace App\Http\View\Composers;

use App\Models\Sale;
use Illuminate\View\View;

class SaleComposer
{
  protected $users;

  public function __construct()
  {
  }

  public function compose(View $view): void
  {
    $sales = Sale::select('sales.*')->where('active',1)->orderBy('id')->get();
    $view->with('sales',$sales);
  }
}
