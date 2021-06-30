<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditUsersRequest extends FormRequest
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
            'user_id' => ['required', 'regex:/^[A-Za-z0-9]+$/', 'max:10'],
            'user_pass' => ['required', 'regex:/^[A-Za-z0-9●]+$/', 'max:10'],
            'user_name' => ['required', 'max:20'],
            'mail_address' => ['nullable', 'email:strict,dns,spoof', 'max:50']
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
            'user_id.required' => 'ユーザIDは必須です。',
            'user_id.regex' => 'ユーザIDは半角英数字のみにしてください。',
            'user_id.max' => 'ユーザIDは10文字以下にしてください。',
            'user_pass.required' => 'パスワードは必須です。',
            'user_pass.regex' => 'パスワードは半角英数字のみにしてください。',
            'user_pass.max' => 'パスワードは10文字以下にしてください。',
            'user_name.required' => 'ユーザ名は必須です。',
            'user_name.max' => 'ユーザ名は20文字以下にして下さい。',
            'mail_address.required' => 'メールアドレスは必須です。',
            'mail_address.email' => '入力されたメールアドレスは使用できません。',
            'mail_address.max' => 'メールアドレスは50文字以下にしてください。'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response['summary'] = 'Failed validation.';
        $response['errors']  = $validator->errors()->toArray();
        $response['message'] = config("const.MESSAGE.ERROR.VALIDATION");

        throw new HttpResponseException(
            response()->json($response, 422)
        );
    }
}
