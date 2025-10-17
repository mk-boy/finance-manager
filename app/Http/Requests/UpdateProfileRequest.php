<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'current_password' => 'nullable|string|current_password',
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'name.max' => 'Имя не должно превышать 255 символов',
            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Email должен быть корректным адресом',
            'email.unique' => 'Этот email уже используется',
            'current_password.current_password' => 'Текущий пароль неверен',
            'password.min' => 'Пароль должен содержать минимум 8 символов',
            'password.confirmed' => 'Подтверждение пароля не совпадает',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'имя',
            'email' => 'email',
            'current_password' => 'текущий пароль',
            'password' => 'пароль',
        ];
    }
}
