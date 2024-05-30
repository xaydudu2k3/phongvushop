<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'name' => 'required',
      'usertype_id' => 'required',
      'cccd' => 'required',
      'phone' => 'required',
      'email' => 'required',
      'thumb' => 'required',
      'password' => 'required',
    ];
  }
  public function messages()
  {
    return [
      'name.required' => 'Vui lòng nhập tên nhân viên',
      'cccd.required' => 'Vui lòng nhập cccd nhân viên',
      'phone.required' => 'Vui lòng nhập sđt nhân viên',
      'email.required' => 'Vui lòng nhập email nhân viên',
      // 'email.email' => 'Email không hợp lệ',
      // 'email.unique' => 'Email đã tồn tại trong hệ thống. Vui lòng sử dụng email khác.',
      'thumb.required' => 'Vui lòng nhập ảnh nhân viên',
      'password.required' => 'Vui lòng mật khẩu nhân viên',
    ];
  }
}
