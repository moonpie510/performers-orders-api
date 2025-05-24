<?php

namespace Domains\Order\Models;

use Database\Factories\OrderWorkerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderWorker extends Model
{
    use HasFactory;


    protected $table = 'order_worker';
    protected $fillable = [
        'order_id',
        'worker_id',
        'amount',
    ];

    protected static function newFactory(): OrderWorkerFactory|Factory
    {
        return OrderWorkerFactory::new();
    }
}
