<?php

namespace App\HTTP\Services;

use App\Models\Sale;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SaleService
{
  public function get(){
    return Sale::orderbyDesc('id')->paginate(5);
  }
  public function create($request)
  {
    try {
      Sale::create([
        'name' => (string) $request->input('name'),
        'sale' => (string) $request->input('sale'),
        'token' => (string) $request->input('token'),
        'quantity' => (string) $request->input('quantity'),
        'active' => (string) $request->input('active'),
      ]);

      Session::flash('success', 'Tạo mã giảm giá thành công');

    } catch (\Exception $err) {
      Session::flash('error', $err->getMessage());
      return false;
    }

    return true;
  }

  public function update($request, $sale) : bool{
    $sale->name = (string) $request->input('name');
    $sale->sale = (string) $request->input('sale');
    $sale->token = (string) $request->input('token');
    $sale->quantity = (string) $request->input('quantity');
    $sale->active = (string) $request->input('active');
    $sale->save();

    Session::flash('success', 'Cập nhật mã giảm giá thành công');
    return true;
  }

  public function destroy($request){
    $id = (int) $request->input('id');
    $sale = Sale::where('id', $id)->first();
    if($sale){
      return Sale::where('id', $id)->delete();
    }

    return false;
  }
}
