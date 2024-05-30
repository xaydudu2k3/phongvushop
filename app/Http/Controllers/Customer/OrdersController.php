<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\HTTP\Services\OrderService;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
  protected $orderService;
  /**
   * Display a listing of the resource.
   */
  public function __construct(OrderService $orderService)
  {
    $this->middleware('cus');
    $this->orderService = $orderService;
  }
  public function index()
  {
    return view('customer.order', [
      'title' => 'Đơn hàng',
    ]);
  }
}
