<?php

namespace App\HTTP\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserService
{
  public function get()
  {
    return User::orderbyDesc('id')->paginate(5);
  }

  public function create($request)
  {
    try {
      User::create([
        'name' => (string) $request->input('name'),
        'usertype_id' => (string) $request->input('usertype_id'),
        'gender' => (string) $request->input('gender'),
        'cccd' => (string) $request->input('cccd'),
        'phone' => (string) $request->input('phone'),
        'email' => (string) $request->input('email'),
        'thumb' => (string) $request->input('thumb'),
        'password' => Hash::make($request->input('password')),
      ]);

      Session::flash('success', 'Tạo nhân viên thành công');
    } catch (\Exception $err) {
      Session::flash('error', $err->getMessage());
      return false;
    }

    return true;
  }

  public function update($request, $user): bool
  {
    $user->name = (string) $request->input('name');
    $user->usertype_id = (string) $request->input('usertype_id');
    $user->gender = (string) $request->input('gender');
    $user->cccd = (string) $request->input('cccd');
    $user->phone = (string) $request->input('phone');
    $user->email = (string) $request->input('email');
    $user->thumb = (string) $request->input('thumb');
    $newPassword = $request->input('password');
    if (!empty($newPassword) && $newPassword !== $user->password) {
      $user->password = Hash::make($newPassword);
    }

    $user->save();
    Session::flash('success', 'Cập nhật nhân viên thành công');
    return true;
  }

  public function destroy($request)
  {
    $id = (int) $request->input('id');
    $user = User::where('id', $id)->first();
    if ($user) {
      return User::where('id', $id)->delete();
    }

    return false;
  }
}
