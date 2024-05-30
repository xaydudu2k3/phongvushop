<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductTypeRequest extends FormRequest
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
      'thumb' => 'required',
    ];
  }
  public function messages()
  {
    return [
      'name.required' => 'Vui lòng nhập tên loại sản phẩm',
      'thumb.required' => 'Vui lòng nhập ảnh loại sản phẩm',
    ];
  }
}
