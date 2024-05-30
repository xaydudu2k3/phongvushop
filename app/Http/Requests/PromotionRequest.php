<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
          'sale'=>'required',
        ];
    }

    public function messages(){
      return [
        'name.required' => 'Vui lòng nhập tên khuyến mãi',
        'sale.required' => 'Vui lòng nhập số khuyến mãi',
      ];
    }
}
