<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:50',
            'body' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            "required" => "必須項目です。",
            "title.max" => "50文字以内で入力してください。",
            "body.max" => "100文字以内で入力してください。"
        ];
    }
}
