<?php

namespace Domains\Worker\Models;

use Database\Factories\WorkersExOrderTypeFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkersExOrderType extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'order_type_id',
    ];

    protected static function newFactory(): WorkersExOrderTypeFactory|Factory
    {
        return WorkersExOrderTypeFactory::new();
    }
}
