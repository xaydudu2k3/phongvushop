<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
      'content'=>'required',
      'thumb' => 'required', //|image|mimes:jpeg,jpg,svg,png,gif
      'price'=>'required',
      'quantity'=>'required',
    ];
  }
  public function messages(){
    return [
      'name.required' => 'Vui lòng nhập tên sản phẩm',
      'content.required' => 'Vui lòng nhập mô tả sản phẩm',
      'thumb.required' => 'Vui lòng nhập file ảnh sản phẩm',
      // 'thumb.image' => 'Tệp tải lên phải là một hình ảnh.',
      // 'thumb.mimes' => 'Định dạng hình ảnh không được hỗ trợ. Vui lòng chọn một tệp hình ảnh định dạng khác (JPG, PNG, GIF).',
      'price.required' => 'Vui lòng nhập giá tiền sản phẩm',
      'quantity.required' => 'Vui lòng nhập số lượng sản phẩm',
    ];
  }
}
