<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    // Table name (optional if following Laravel conventions)
    protected $table = 'testimonials';

    // Mass assignable attributes
    protected $fillable = [
        'author_name',
        'author_image',
        'location',
        'feedback',
        'status',
    ];

    // Optionally: cast 'status' as string, timestamps enabled by default
}
