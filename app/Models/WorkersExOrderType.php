<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkersExOrderType extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'order_type_id',
    ];
}
