<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class category_create_rules extends FormRequest
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
            'title'=>['required','unique:categories,title'],
            'category_id'=>['nullable','exists:categories,id']
        ];
    }
}
