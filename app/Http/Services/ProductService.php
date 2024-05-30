<?php

namespace App\HTTP\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductService
{
  public function get()
  {
    return Product::orderbyDesc('id')->paginate(5);
  }

  public function create($request)
  {
    try {
      Product::create([
        'name' => (string) $request->input('name'),
        'description' => (string) $request->input('description'),
        'content' => (string) $request->input('content'),
        'producttype_id' => (string) $request->input('producttype_id'),
        'trademark_id' => (string) $request->input('trademark_id'),
        'promotion_id' => (string) $request->input('promotion_id'),
        'thumb' => (string) $request->input('thumb'),
        'quantity' => (string) $request->input('quantity'),
        'price' => (string) $request->input('price'),
      ]);

      Session::flash('success', 'Tạo sản phẩm thành công');
    } catch (\Exception $err) {
      Session::flash('error', $err->getMessage());
      return false;
    }

    return true;
  }

  public function update($request, $product): bool
  {
    $product->name = (string) $request->input('name');
    $product->description = (string) $request->input('description');
    $product->content = (string) $request->input('content');
    $product->producttype_id = (string) $request->input('producttype_id');
    $product->trademark_id = (string) $request->input('trademark_id');
    $product->promotion_id = (string) $request->input('promotion_id');
    $product->quantity = (string) $request->input('quantity');
    $product->thumb = (string) $request->input('thumb');
    $product->price = (string) $request->input('price');
    $product->save();

    Session::flash('success', 'Cập nhật sản phẩm thành công');
    return true;
  }

  public function destroy($request)
  {
    $id = (int) $request->input('id');
    $product = Product::where('id', $id)->first();
    if ($product) {
      return Product::where('id', $id)->delete();
    }

    return false;
  }
}
