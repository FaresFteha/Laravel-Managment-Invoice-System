<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => ['required', Rule::unique('products')->ignore($this->id)],
            'name' => 'required',
            'category_id' => 'required',
            'unit_price' => 'required|numeric',
            'photo' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'code' => 'رمز المنتج',
            'name' => 'اسم المنتج',
            'category_id' => 'فئة المنتج',
            'unit_price' => 'سعر الوحدة',
            'photo' => 'صورة المنتج',
        ];
    }
}
