<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_id' => 'required|integer|exists:payments,id',
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'currency_id' => 'required|integer|exists:currencies,id',
        ];
    }
    
    public function messages(): array
    {
        return [
            'payment_id.required' => 'ID счёта обязателен для заполнения',
            'payment_id.exists' => 'Выбранный счёт не существует',
            'name.required' => 'Название счёта обязательно для заполнения',
            'name.max' => 'Название счёта не должно превышать 255 символов',
            'type_id.required' => 'Тип счёта обязателен для заполнения',
            'currency_id.required' => 'Валюта обязательна для заполнения',
            'currency_id.exists' => 'Выбранная валюта не существует',
        ];
    }

    public function attributes(): array
    {
        return [
            'payment_id' => 'ID счёта',
            'name' => 'название счёта',
            'type_id' => 'тип счёта',
            'currency_id' => 'валюта',
        ];
    }
}
