<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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

        if ($this->isMethod('POST')){    //create

            return [
                'name' => 'required',
                'photo' => 'required|mimes:jpg,jpeg,png'
            ];
        }else{
            return [
                'name' => 'required',
                'photo' =>'nullable|mimes:jpg,jpeg,png'
            ];
        }

    }

    public function messages()
    {
        return [
            //
            "name.required" => "اسم القسم مطلوب",
//            "photo.required" => "حقل الصورة مطلوب",
        ];
    }
}
