<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
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
      'password' => 'required',
    ];
  }
  public function messages(){
    return [
      'name.required' => 'Vui lòng nhập tên',
      'phone.required' => 'VUi lòng điền số điện thoại',
      'address.required' => 'Vui lòng nhập địa chỉ',
      'password.required' => 'Vui lòng nhập mật khẩu',
    ];
  }
}
