<?php

namespace Domains\Partnership\Models;

use Database\Factories\PartnershipFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected static function newFactory(): Factory|PartnershipFactory
    {
        return PartnershipFactory::new();
    }
}
