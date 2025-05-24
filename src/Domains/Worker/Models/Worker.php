<?php

namespace Domains\Worker\Models;

use Database\Factories\WorkerFactory;
use Domains\Order\Models\OrderType;
use Domains\Worker\QueryBuilders\WorkerQueryBuilder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/** @method static WorkerQueryBuilder query() */
class Worker extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

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

    protected static function newFactory(): Factory|WorkerFactory
    {
        return WorkerFactory::new();
    }

    public function excludedOrderTypes(): BelongsToMany
    {
        return $this->belongsToMany(OrderType::class, 'workers_ex_order_types');
    }
}
