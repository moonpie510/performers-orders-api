<?php

namespace App\Http\Requests\Order;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type_id' => ['required', 'exists:order_types,id'],
            'partnership_id' => ['required', 'exists:partnerships,id'],
            'user_id' => ['required', 'exists:users,id'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
            'address' => ['required', 'string'],
            'amount' => ['required', 'integer', 'gt:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'type_id.required' => 'Тип заказа не выбран',
            'type_id.exists' => 'Такого типа заказа не существует',

            'partnership_id.required' => 'Партнер не выбран',
            'partnership_id.exists' => 'Такого партнера не существует',

            'user_id.required' => 'User не выбран',
            'user_id.exists' => 'Такого пользователя не существует',

            'description.required' => 'Описание заказа не введено',

            'date.required' => 'Дата не выбрана',
            'date.date' => 'Дата имеет неверный формат',

            'address.required' => 'Адрес не введен',
            'address.string' => 'Адрес должен быть строкой',

            'amount.required' => 'Сумма не введена',
            'amount.integer' => 'Сумма должна быть целым числом',
            'amount.gt' => 'Сумма должна быть больше 0',
        ];
    }
}
