<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class role_update_rules extends FormRequest
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
            'title'=>['required'],
            'permission'=>['required','array'],
            'permission.*'=>['exists:permissions,id']
        ];
    }
}
