<?php

namespace App\HTTP\Services;

use App\Models\ProductType;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductTypeService
{
  public function get(){
    return ProductType::orderbyDesc('id')->paginate(5);
  }

  public function create($request)
  {
    try {
      ProductType::create([
        'name' => (string) $request->input('name'),
        'thumb' => (string) $request->input('thumb'),
        'active' => (string) $request->input('active'),
      ]);

      Session::flash('success', 'Tạo loại sản phẩm thành công');

    } catch (\Exception $err) {
      Session::flash('error', $err->getMessage());
      return false;
    }

    return true;
  }

  public function update($request, $productType) : bool{
    $productType->name = (string) $request->input('name');
    $productType->thumb = (string) $request->input('thumb');
    $productType->active = (string) $request->input('active');
    $productType->save();

    Session::flash('success', 'Cập nhật loại sản phẩm thành công');
    return true;
  }

  public function destroy($request){
    $id = (int) $request->input('id');
    $productType = ProductType::where('id', $id)->first();
    if($productType){
      return ProductType::where('id', $id)->delete();
    }

    return false;
  }
}
