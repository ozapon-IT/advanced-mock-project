<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:100'],
            'image' => ['required', 'image', 'mimes:jpeg,png', 'max:2048'],
            'area' => ['required', 'exists:areas,id'],
            'genre' => ['required', 'exists:genres,id'],
            'summary' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => '店舗名を入力してください。',
            'name.string' => '店舗名は文字列で入力してください。',
            'name.max' => '店舗名は100文字以内で入力してください。',

            'image.required' => '店舗画像を選択してください。',
            'image.image' => '店舗画像は画像ファイルを選択してください。',
            'image.mimes' => '店舗画像はJPEGまたはPNG形式でアップロードしてください。',
            'image.max' => '店舗画像は2MB以下のサイズにしてください。',

            'area.required' => 'エリアを選択してください。',
            'area.exists' => '選択されたエリアが無効です。',

            'genre.required' => 'ジャンルを選択してください。',
            'genre.exists' => '選択されたジャンルが無効です。',

            'summary.required' => '店舗概要を入力してください。',
            'summary.string' => '店舗概要は文字列で入力してください。',
            'summary.max' => '店舗概要は255文字以内で入力してください。',
        ];
    }
}
