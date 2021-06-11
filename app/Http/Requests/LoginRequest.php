<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "id" => ["required", "max:10", "regex:/^[A-Za-z0-9-]+$/"],
            "password" => ["required", "regex:/^[A-Za-z0-9-]+$/"]
        ];
    }

    /**
     * Get validation message
     *
     * @return array
     */
    public function messages()
    {
        return [
            "id.required" => "IDは必須です。",
            "id.max" => "IDは10文字以下にしてください。",
            "id.regex" => "IDは半角英数字で\n入力してください。",
            "password.required" => "パスワードは必須です。",
            "password.regex" => "パスワードは半角英数字\nで入力してください。"
        ];
    }
}
