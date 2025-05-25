<?php

namespace Domains\Order\Models;

use Database\Factories\OrderFactory;
use Domains\Order\Enums\OrderStatusEnum;
use Domains\Order\States\OrderStatus;
use Domains\Worker\Models\Worker;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property OrderStatus $status
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'partnership_id',
        'user_id',
        'description',
        'date',
        'address',
        'amount',
        'status',
    ];

    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(Worker::class);
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => OrderStatusEnum::from($value)->createOrderStatus($this)
        );
    }

    protected static function newFactory(): OrderFactory|Factory
    {
        return OrderFactory::new();
    }
}
