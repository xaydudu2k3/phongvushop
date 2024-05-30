<?php

namespace App\Providers;

use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\MenuComposer;
use App\Http\View\Composers\OrderComposer;
use App\Http\View\Composers\ProductComposer;
use App\Http\View\Composers\ProductHomeComposer;
use App\Http\View\Composers\ProductTypeComposer;
use App\Http\View\Composers\ProductTypePComposer;
use App\Http\View\Composers\SaleComposer;
use App\Http\View\Composers\SliderComposer;
use App\Http\View\Composers\TrademarkComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    View::composer('customer.layout.header',MenuComposer::class);
    View::composer('customer.home',SliderComposer::class);
    View::composer('customer.home',ProductTypeComposer::class);
    View::composer('customer.home',TrademarkComposer::class);
    View::composer('customer.home',ProductHomeComposer::class);
    View::composer('customer.product',ProductComposer::class);
    View::composer('customer.product',ProductTypePComposer::class);
    View::composer('customer.product',TrademarkComposer::class);
    View::composer('customer.sale',SaleComposer::class);
    View::composer('customer.order',OrderComposer::class);
    View::composer('customer.layout.cart',CartComposer::class);
  }
}
