<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'review' => [
                'required',
                'string',
                'min:10',
            ],
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'rating.required' => '総合評価を選択してください。',
            'rating.integer' => '総合評価は整数である必要があります。',
            'rating.min' => '総合評価は最低1以上である必要があります。',
            'rating.max' => '総合評価は最大5まで選択できます。',

            'title.required' => 'タイトルを入力してください。',
            'title.string' => 'タイトルは文字列で入力してください。',
            'title.max' => 'タイトルは255文字以内で入力してください。',

            'review.required' => 'レビューを入力してください。',
            'review.string' => 'レビューは文字列で入力してください。',
            'review.min' => 'レビューは最低10文字以上入力してください。',
        ];
    }
}
