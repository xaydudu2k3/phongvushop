<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
  public function ajaxSearch(){
    $data = Product::search()->get();
    return $data;
 }
}
