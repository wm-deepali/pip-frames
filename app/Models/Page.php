<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'page_name',
        'slug',
        'title',
        'detail',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status'
    ];
}
