<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    // Table name (optional if following Laravel conventions)
    protected $table = 'sliders';

    // Mass assignable attributes
    protected $fillable = [
        'image_path',
        'content',
        'status',
    ];

    // Timestamps enabled by default
}
