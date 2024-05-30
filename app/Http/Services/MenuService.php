<?php

namespace App\HTTP\Services;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService
{
  public function getChild()
  {
    return Menu::where('parent_id', 0)->get();
  }
  public function getAll()
  {
    return Menu::orderBy('id')->paginate(5);
  }

  public function create($request)
  {
    try {
      Menu::create([
        'name' => (string) $request->input('name'),
        'parent_id' => (string) $request->input('parent_id'),
        'url' => (string) $request->input('url'),
        'active' => (string) $request->input('active'),
      ]);

      Session::flash('success', 'Tạo danh mục thành công');

    } catch (\Exception $err) {
      Session::flash('error', $err->getMessage());
      return false;
    }

    return true;
  }

  public function update($request, $menu): bool
  {
    if ($request->input('parent_id') != $menu->id) {
      $menu->parent_id = (string) $request->input('parent_id');
    }
    $menu->name = (string) $request->input('name');
    $menu->url = (string) $request->input('url');
    $menu->active = (string) $request->input('active');
    $menu->save();

    Session::flash('success', 'Cập nhật Danh mục thành công');
    return true;
  }

  public function destroy($request)
  {
    $id = (int) $request->input('id');
    $menu = Menu::where('id', $id)->first();
    if ($menu) {
      return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
    }

    return false;
  }
}
