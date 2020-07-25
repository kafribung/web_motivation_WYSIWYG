<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MotivationRequest extends FormRequest
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
            'title'       => ['required', 'string', 'min:3', 'max:191', 'unique:motivations'],
            'img'         => ['mimes:png,jpg,jpeg', 'max:2080'],
            'tag_id'      => ['required', 'array'],
            'description' => ['required'],
        ];
    }
}
