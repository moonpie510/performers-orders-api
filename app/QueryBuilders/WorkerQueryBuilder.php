<?php

namespace App\QueryBuilders;

use App\DTOs\Worker\FilterDto;
use Illuminate\Database\Eloquent\Builder;

class WorkerQueryBuilder extends Builder
{
    public function filtered(?FilterDto $filterDto = null): self
    {
        if (is_null($filterDto)) {
            return $this;
        }

        if (!empty($filterDto->orderTypeIds)) {
            // id исполнителей которые исключили все типы указанных заказов
            $query = clone $this;
            $excludeWorkersIds = $query->whereHas('excludedOrderTypes', function($q) use ($filterDto) {
                $q->whereIn('order_type_id', $filterDto->orderTypeIds);
            }, '>=', count($filterDto->orderTypeIds))
                ->pluck('id');

            $this->whereNotIn('id', $excludeWorkersIds);
        }

        return $this;
    }
}
