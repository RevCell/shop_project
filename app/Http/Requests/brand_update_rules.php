<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class brand_update_rules extends FormRequest
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
            'image'=>['required','max:1024','min:2','mimes:png,jpg,gif']
        ];
    }
}
