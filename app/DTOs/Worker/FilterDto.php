<?php

namespace App\DTOs\Worker;

use Illuminate\Http\Request;

class FilterDto
{
    private function __construct(
        public array $orderTypeIds,
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            orderTypeIds: $request->order_type_ids ?? []
        );
    }
}
