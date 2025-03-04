<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ReservationRequest extends FormRequest
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
        $inputKeys = array_diff(array_keys($this->all()), ['_token', '_method']);
        if ($this->has('status') && count($inputKeys) === 1) {
            return [
                'status' => [
                    'required',
                    'string',
                    'in:来店済み',
                ],
            ];
        }

        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i');

        return [
            'reservation_date' => [
                'required',
                'after_or_equal:' . $currentDate,
            ],
            'reservation_time' => [
                'required',
                function ($attribute, $value, $fail) use ($currentDate, $currentTime) {
                    if ($this->reservation_date === $currentDate) {
                        $selectedTime = Carbon::createFromFormat('H:i', $value);
                        $limitTime = Carbon::createFromFormat('H:i', $currentTime)->addHour();
                        if ($selectedTime < $limitTime) {
                            $fail('予約時間は現在時刻から1時間以上後である必要があります。');
                        }
                    }
                },
            ],
            'number_of_people' => [
                'required',
            ],
            'reservation_menu' => [
                'required',
            ],
            'payment_method' => [
                'required',
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
            'reservation_date.required' => '予約日を選択してください。',
            'reservation_date.after_or_equal' => '過去の日付を選択することはできません。',
            'reservation_time.required' => '予約時間を選択してください。',
            'number_of_people.required' => '予約人数を選択してください。',
            'reservation_menu.required' => '予約メニューを選択してください。',
            'payment_method.required' => '支払い方法を選択してください。',
        ];
    }
}
