<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeCondition extends Model
{
    protected $fillable = [
        'subcategory_id',
        'parent_attribute_id',
        'parent_value_id',
        'affected_attribute_id',
        'affected_value_id',
        'action'
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function parentAttribute()
    {
        return $this->belongsTo(Attribute::class, 'parent_attribute_id');
    }

    public function parentValue()
    {
        return $this->belongsTo(AttributeValue::class, 'parent_value_id');
    }

    public function affectedAttribute()
    {
        return $this->belongsTo(Attribute::class, 'affected_attribute_id');
    }

    public function affectedValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'attribute_condition_values', 'attribute_condition_id', 'attribute_value_id')
            ->withTimestamps();
    }
}

