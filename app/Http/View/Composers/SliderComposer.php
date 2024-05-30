<?php

namespace App\Http\View\Composers;

use App\Models\Slider;
use App\Repositories\UserRepository;
use Illuminate\View\View;

class SliderComposer
{
  protected $users;

  public function __construct()
  {
  }

  public function compose(View $view): void
  {
    $sliders = Slider::select('sliders.*')->where('active',1)->orderBy('id')->get();
    $view->with('sliders',$sliders);
  }
}
