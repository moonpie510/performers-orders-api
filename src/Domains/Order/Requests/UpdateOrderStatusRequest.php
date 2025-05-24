<?php

namespace Domains\Order\Requests;

use Domains\Order\Enums\OrderStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(array_column(OrderStatusEnum::cases(), 'value'))],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Тип заказа не выбран',
            'status.in' => 'Неизвестный тип статуса заказа',
        ];
    }
}
