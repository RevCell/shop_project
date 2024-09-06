<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class gallery_create_rules extends FormRequest
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
            'address'=>['required','max:1024','min:5',"mimes:png,jpg,gif"],
            'product_id'=>['nullable','exists:products,id'],
            'extension'=>['nullable']
        ];
    }
}
