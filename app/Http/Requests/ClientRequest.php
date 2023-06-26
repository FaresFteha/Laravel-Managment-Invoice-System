<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'email' => ['required', Rule::unique('clients')->ignore($this->id)],
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|same:password2',
            'password2' => 'required',
            'photo' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'البريد الالكتروني',
            'first_name' => 'الاسم الاول',
            'last_name' => 'الاسم الثاني',
            'password' => 'كلمة السر',
            'password2' => 'تاكيد كلمة السر',
            'photo' => 'صورة العميل',
            'postal_code' => 'الرمز البريدي',
            'address' => 'العنوان',
        ];
    }
}
