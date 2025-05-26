<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTweetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Разрешаем выполнение запроса для всех пользователей
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'username' => [
                'required',
                'string',
                'alpha_num',      // Только буквы и цифры (можно заменить на 'regex', если нужен другой формат)
                'min:3',
                'max:30',
            ],
            'content' => ['required', 'string', 'max:280'],
        ];
    }
}
