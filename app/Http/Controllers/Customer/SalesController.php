<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
  public function index(){
    return view('customer.sale',[
      'title' => 'Giảm giá',
    ]);
  }
}
