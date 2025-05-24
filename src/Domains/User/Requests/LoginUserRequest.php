<?php

namespace Domains\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Укажите email',
            'email.email' => 'Неверный формат email',
            'email.exists' => 'Неверный email или пароль',

            'password.required' => 'Введите пароль',
            'password.string' => 'Пароль должен быть строкой',
        ];
    }
}
