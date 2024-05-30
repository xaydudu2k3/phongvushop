<?php

namespace App\Http\View\Composers;

use App\Models\Menu;
use App\Repositories\UserRepository;
use Illuminate\View\View;

class MenuComposer
{
  protected $users;

  public function __construct()
  {
  }

  public function compose(View $view): void
  {
    $menus = Menu::select('id','name','parent_id','url')->where('active',1)->orderBy('id')->get();
    $view->with('menus',$menus);
  }
}
