<?php

namespace App\HTTP\Services;

use App\Mail\CustomerRegistered;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CustomerService
{
  public function get()
  {
    return Customer::orderbyDesc('id')->paginate(5);
  }

  public function create($request)
  {
    try {
      Customer::create([
        'name' => (string) $request->input('name'),
        'phone' => (string) $request->input('phone'),
        'address' => (string) $request->input('address'),
        'email' => (string) $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'status' => (string) $request->input('status'),
      ]);

      Session::flash('success', 'Tạo khách hàng thành công');
    } catch (\Exception $err) {
      Session::flash('error', $err->getMessage());
      return false;
    }

    return true;
  }

  public function update($request, $customer): bool
  {
    $customer->name = (string) $request->input('name');
    $customer->phone = (string) $request->input('phone');
    $customer->address = (string) $request->input('address');
    $customer->email = (string) $request->input('email');
    $newPassword = $request->input('password');
    if (!empty($newPassword) && $newPassword !== $customer->password) {
      $customer->password = Hash::make($newPassword);
    }
    $customer->status = (string) $request->input('status');
    $customer->token = (string) $request->input('token');
    $customer->save();

    Session::flash('success', 'Cập nhật khách hàng thành công');
    return true;
  }
  public function updateInfo($request, $customer): bool
  {
    $customer->name = (string) $request->input('name');
    $customer->phone = (string) $request->input('phone');
    $customer->address = (string) $request->input('address');
    $newPassword = $request->input('password');
    if (!empty($newPassword) && $newPassword !== $customer->password) {
      $customer->password = Hash::make($newPassword);
    }
    $customer->save();

    Session::flash('success', 'Cập nhật thông tin thành công');
    return true;
  }

  public function destroy($request)
  {
    $id = (int) $request->input('id');
    $customer = Customer::where('id', $id)->first();
    if ($customer) {
      return Customer::where('id', $id)->delete();
    }

    return false;
  }
}
