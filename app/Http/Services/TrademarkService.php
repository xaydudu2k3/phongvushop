<?php

namespace App\HTTP\Services;

use App\Models\Trademark;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TrademarkService
{
  public function get()
  {
    return Trademark::orderbyDesc('id')->paginate(5);
  }

  public function create($request)
  {
    try {
      Trademark::create([
        'name' => (string) $request->input('name'),
        'thumb' => (string) $request->input('thumb'),
        'url' => (string) $request->input('url'),
      ]);

      Session::flash('success', 'Tạo thương hiệu thành công');

    } catch (\Exception $err) {
      Session::flash('error', $err->getMessage());
      return false;
    }

    return true;
  }

  public function update($request, $trademark): bool
  {
    $trademark->name = (string) $request->input('name');
    $trademark->thumb = (string) $request->input('thumb');
    $trademark->url = (string) $request->input('url');
    $trademark->save();

    Session::flash('success', 'Cập nhật thương hiệu thành công');
    return true;
  }

  public function destroy($request)
  {
    $id = (int) $request->input('id');
    $trademark = Trademark::where('id', $id)->first();
    if ($trademark) {
      return Trademark::where('id', $id)->delete();
    }

    return false;
  }
}
