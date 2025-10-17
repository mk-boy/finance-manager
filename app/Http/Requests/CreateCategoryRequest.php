<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'description' => 'nullable|string|max:255',
            'tag_color' => 'required|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название категории обязательно для заполнения',
            'name.max' => 'Название категории не должно превышать 255 символов',
            'type_id.required' => 'Тип категории обязателен для заполнения',
            'description.max' => 'Описание не должно превышать 1000 символов',
            'tag_color.required' => 'Цвет метки обязателен для заполнения',
            'tag_color.regex' => 'Цвет должен быть в формате HEX (#000000)',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'название категории',
            'type_id' => 'тип категории',
            'description' => 'описание',
            'tag_color' => 'цвет метки',
        ];
    }
}
