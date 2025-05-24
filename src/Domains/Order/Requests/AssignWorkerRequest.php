<?php

namespace Domains\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignWorkerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'worker_id' => ['required', 'exists:workers,id'],
            'order_id' => ['required', 'exists:orders,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'worker_id.required' => 'Работник не выбран',
            'worker_id.exists' => 'Такого работника не существует',

            'order_id.required' => 'Заказ не выбран',
            'order_id.exists' => 'Такого заказа не существует',
        ];
    }
}
