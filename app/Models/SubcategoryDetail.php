<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategoryDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'subcategory_id',
        'information',
        'available_sizes',
        'binding_options',
        'paper_types',
    ];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
