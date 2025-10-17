<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'currency_id' => 'required|integer|exists:currencies,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название счёта обязательно для заполнения',
            'name.max' => 'Название счёта не должно превышать 255 символов',
            'type_id.required' => 'Тип счёта обязателен для заполнения',
            'type_id.in' => 'Выбран неверный тип счёта',
            'currency_id.required' => 'Валюта обязательна для заполнения',
            'currency_id.exists' => 'Выбранная валюта не существует',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'название счёта',
            'type_id' => 'тип счёта',
            'currency_id' => 'валюта',
        ];
    }
}
