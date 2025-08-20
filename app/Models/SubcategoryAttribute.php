<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubcategoryAttribute extends Model
{
    protected $fillable = ['subcategory_id', 'attribute_id', 'is_required', 'sort_order'];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function subcategoryAttributeValues()
    {
        return $this->hasMany(SubcategoryAttributeValue::class, 'subcategory_id', 'subcategory_id')
            ->whereColumn('attribute_id', 'attribute_id');
    }

    

}

