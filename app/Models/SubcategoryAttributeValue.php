<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubcategoryAttributeValue extends Model
{
    protected $fillable = ['subcategory_id', 'attribute_id', 'attribute_value_id', 'is_default'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }
}
