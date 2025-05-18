<?php

namespace App\Models;

use App\QueryBuilders\WorkerQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/** @method static WorkerQueryBuilder query() */
class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'second_name',
        'surname',
        'phone',
    ];

    public function newEloquentBuilder($query): WorkerQueryBuilder
    {
        return new WorkerQueryBuilder($query);
    }

    public function excludedOrderTypes(): BelongsToMany
    {
        return $this->belongsToMany(OrderType::class, 'workers_ex_order_types');
    }
}
