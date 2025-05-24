<?php

namespace Domains\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'partnership_id' => ['required', 'exists:partnerships,id'],
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

            'partnership_id.required' => 'Выберите партнерство',
            'partnership_id.exists' => 'Такого партнерства не существует',
        ];
    }
}
