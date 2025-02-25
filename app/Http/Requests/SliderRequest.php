<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
      'name'=>'required',
      'thumb'=>'required',
      'description' =>'required',
    ];
  }
  public function messages(){
    return [
      'name.required' => 'Vui lòng nhập tên slider',
      'thumb.required' => 'Vui lòng nhập ảnh slider',
      'description.required' => 'Vui lòng nhập mô tả slider',
    ];
  }
}
