<?php

namespace App\HTTP\Services;

use App\Models\Promotion;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PromotionService
{
  public function get(){
    return Promotion::orderbyDesc('id')->paginate(5);
  }

  public function create($request)
  {
    try {
      Promotion::create([
        'name' => (string) $request->input('name'),
        'sale' => (string) $request->input('sale'),
      ]);

      Session::flash('success', 'Tạo khuyến mãi thành công');

    } catch (\Exception $err) {
      Session::flash('error', $err->getMessage());
      return false;
    }

    return true;
  }

  public function update($request, $promotion) : bool{
    $promotion->name = (string) $request->input('name');
    $promotion->sale = (string) $request->input('sale');
    $promotion->save();

    Session::flash('success', 'Cập nhật khuyến mãi thành công');
    return true;
  }

  public function destroy($request){
    $id = (int) $request->input('id');
    $promotion = Promotion::where('id', $id)->first();
    if($promotion){
      return Promotion::where('id', $id)->delete();
    }

    return false;
  }
}
