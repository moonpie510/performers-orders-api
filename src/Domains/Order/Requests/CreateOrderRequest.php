<?php

namespace Domains\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
