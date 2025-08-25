<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraOption extends Model
{
    protected $fillable = [
        'title', 'description', 'price', 'code', 'is_active', 'sort_order'
    ];
}
