<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'description' => 'nullable|string|max:1000',
            'tag_color' => 'required|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'ID категории обязателен для заполнения',
            'category_id.exists' => 'Выбранная категория не существует',
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
            'category_id' => 'ID категории',
            'name' => 'название категории',
            'type_id' => 'тип категории',
            'description' => 'описание',
            'tag_color' => 'цвет метки',
        ];
    }
}
