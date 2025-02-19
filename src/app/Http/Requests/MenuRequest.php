<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];

        if ($this->input('action') === 'create') {
            // 作成のバリデーションルール
            $rules = [
                'name' => ['required', 'string', 'max:100'],
                'price' => ['required', 'numeric', 'digits_between:1,8'],
            ];
        } elseif ($this->input('action') === 'update') {
            // 更新のバリデーションルール
            if ($this->isMethod('patch')) {
                foreach ($this->all() as $key => $value) {
                    // name_{id} と price_{id} 用のルールを動的に追加
                    if (preg_match('/^name_\d+$/', $key)) {
                        $rules[$key] = ['required', 'string', 'max:100'];
                    }
                    if (preg_match('/^price_\d+$/', $key)) {
                        $rules[$key] = ['required', 'numeric', 'digits_between:1,8'];
                    }
                }
            }
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $messages = [
            'name.required' => 'メニュー名を入力してください。',
            'name.string' => 'メニュー名は文字列で入力してください。',
            'name.max' => 'メニュー名は100文字以内で入力してください。',
            'price.required' => '価格を入力してください。',
            'price.numeric' => '価格は数値で入力してください。',
            'price.digits_between' => '価格は1桁以上8桁以内で入力してください。',
        ];

        // 更新処理の場合のエラーメッセージを動的に追加
        foreach ($this->all() as $key => $value) {
            if (preg_match('/^name_(\d+)$/', $key)) {
                $messages["$key.required"] = 'メニュー名を入力してください。';
                $messages["$key.string"] = 'メニュー名は文字列で入力してください。';
                $messages["$key.max"] = 'メニュー名は100文字以内で入力してください。';
            }
            if (preg_match('/^price_(\d+)$/', $key)) {
                $messages["$key.required"] = '価格を入力してください。';
                $messages["$key.numeric"] = '価格は数値で入力してください。';
                $messages["$key.digits_between"] = '価格は1桁以上8桁以内で入力してください。';
            }
        }

        return $messages;
    }
}
