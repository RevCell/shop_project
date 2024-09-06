<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class product_update_rules extends FormRequest
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
            'category_id'=>['required','exists:categories,id'],
            'brand_id'=>['required','exists:brands,id'],
            'title'=>['required'],
            'price'=>['required'],
            'slug'=>['required','alpha_dash'],
            'image'=>['nullable','max:1024','min:20','mimes:png,jpg,gif'],
            'description'=>['required']
        ];
    }
}
