<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|max:25',
            'email' => 'required|email|unique:admins,email,'.$this->id,
            'password' => 'nullable|confirmed|min:6',


        ];
    }

    public function messages()
    {
        return [
            //
            'name.required'=>'اسم المستخدم مطلوب',
            'email.required'=>'الإيميل مطلوب',
            'password.min'=>'كلمه المرور لا تقل عن 8 حروف أو أرقام',
            'password.confirmed' => 'كلمه المرور غير متطابقة'

        ];
    }
}
