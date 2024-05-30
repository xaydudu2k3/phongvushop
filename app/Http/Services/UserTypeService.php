<?php

namespace App\HTTP\Services;

use App\Models\UserType;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserTypeService
{
  public function get()
  {
    return UserType::orderby('id')->paginate(5);
  }

  public function create($request)
  {
    try {
      UserType::create([
        'name' => (string) $request->input('name'),
      ]);

      Session::flash('success', 'Tạo loại nhân viên thành công');

    } catch (\Exception $err) {
      Session::flash('error', $err->getMessage());
      return false;
    }

    return true;
  }

  public function update($request, $userType): bool
  {
    $userType->name = (string) $request->input('name');
    $userType->save();

    Session::flash('success', 'Cập nhật loại nhân viên thành công');
    return true;
  }

  public function destroy($request)
  {
    $id = (int) $request->input('id');
    $userType = UserType::where('id', $id)->first();
    if ($userType) {
      return UserType::where('id', $id)->delete();
    }

    return false;
  }
}
