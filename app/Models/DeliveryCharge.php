<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'details',
        'no_of_days',
        'title',
        'is_default'
    ];

      protected $casts = [
        'is_default' => 'boolean'
    ];
}
