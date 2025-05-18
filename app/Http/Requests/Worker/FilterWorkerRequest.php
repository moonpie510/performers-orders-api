<?php

namespace App\Http\Requests\Worker;

use Illuminate\Foundation\Http\FormRequest;

class FilterWorkerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_type_ids' => ['nullable', 'array'],
            'order_type_ids.*' => ['integer', 'exists:order_types,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'order_type_ids.array' => 'order_type_ids должно быть массивом',
            'order_type_ids.*.integer' => 'Каждый элемент в order_type_ids должен быть целым числом',
            'order_type_ids.*.exists' => 'Переданный тип заказа не существуют',
        ];
    }
}
