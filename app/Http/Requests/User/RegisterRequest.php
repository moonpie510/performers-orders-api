<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя',

            'email.required' => 'Укажите email',
            'email.email' => 'Неверный формат email',
            'email.unique' => 'Пользователь с таким email уже существует',

            'password.required' => 'Введите пароль',
            'password.confirmed' => 'Подтвердите пароль',
        ];
    }
}
