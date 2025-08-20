<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroupSubcategoryAssignment extends Model
{
    protected $fillable = [
        'attribute_group_id',
        'subcategory_id',
        'sort_order',
        'is_toggleable',
    ];

    public function group()
    {
        return $this->belongsTo(AttributeGroup::class, 'attribute_group_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
}