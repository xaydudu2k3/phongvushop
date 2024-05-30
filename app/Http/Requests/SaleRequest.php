<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
      'sale' => 'required',
      'token' => 'required',
      'quantity' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Vui lòng nhập tên mã khuyến mãi',
      'token.required' => 'Vui lòng nhập mã khuyến mãi',
      'sale.required' => 'Vui lòng nhập số mã khuyến mãi',
      'quantity.required' => 'Vui lòng nhập số lượng mã khuyến mãi',
    ];
  }
}
