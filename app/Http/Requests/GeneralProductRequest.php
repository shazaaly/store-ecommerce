<?php

namespace App\Http\Requests;

use App\Http\Enumeration\CategoryType;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class GeneralProductRequest extends FormRequest
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

        $rules = [
            'name' => 'required|max:100',
            'slug' => 'required|unique:products,slug',
            'description' => 'required|max:1000',
            'short_description' => 'nullable|max:500',
            'categories' => 'array|min:1', //[]
            'categories.*' => 'numeric|exists:categories,id',
            'tags' => 'nullable',
            'brand_id' => 'required|exists:brands,id'

        ];
        return $rules;


    }

    public function messages()
    {
        return [
            //
            "name.required" => "اسم القسم مطلوب",
            "slug.required" => "اسم الرابط مطلوب",
        ];
    }
}
