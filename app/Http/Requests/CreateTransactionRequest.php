<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'sum' => 'required|numeric|min:0.01',
            'type_id' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'payment_id' => 'required|integer|exists:payments,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название транзакции обязательно для заполнения',
            'name.max' => 'Название транзакции не должно превышать 255 символов',
            'sum.required' => 'Сумма обязательна для заполнения',
            'sum.numeric' => 'Сумма должна быть числом',
            'sum.min' => 'Сумма должна быть больше 0',
            'type_id.required' => 'Тип транзакции обязателен для заполнения',
            'type_id.in' => 'Выбран неверный тип транзакции',
            'category_id.required' => 'Категория обязательна для заполнения',
            'category_id.exists' => 'Выбранная категория не существует',
            'payment_id.required' => 'Счёт обязателен для заполнения',
            'payment_id.exists' => 'Выбранный счёт не существует',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'название транзакции',
            'sum' => 'сумма',
            'type_id' => 'тип транзакции',
            'category_id' => 'категория',
            'payment_id' => 'счёт',
        ];
    }
}
