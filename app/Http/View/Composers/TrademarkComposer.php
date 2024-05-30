<?php

namespace App\Http\View\Composers;

use App\Models\Trademark;
use Illuminate\View\View;

class TrademarkComposer
{
  protected $users;

  public function __construct()
  {
  }

  public function compose(View $view): void
  {
    $trademarks = Trademark::select('trademarks.*')->orderBy('id')->get();
    $view->with('trademarks',$trademarks);
  }
}
