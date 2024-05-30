<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
      'phone' => 'required',
      'address' => 'required',
      'email' => 'required',
      'password' => 'required',
    ];
  }
  public function messages()
  {
    return [
      'name.required' => 'Vui lòng nhập tên',
      'phone.required' => 'Vui lòng điền số điện thoại',
      'address.required' => 'Vui lòng nhập địa chỉ nhà',
      'email.required' => 'Vui lòng nhập email',
      'email.email' => 'Email không hợp lệ',
      'email.unique' => 'Email đã tồn tại trong hệ thống. Vui lòng sử dụng email khác.',
      'password.required' => 'Vui lòng nhập mật khẩu',
    ];
  }
}
