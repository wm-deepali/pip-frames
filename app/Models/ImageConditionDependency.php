<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageConditionDependency extends Model
{
    protected $fillable = [
        'image_condition_id',
        'attribute_id',
        'value_id',
    ];

    // 🔗 Belongs to Condition
    public function condition()
    {
        return $this->belongsTo(ImageCondition::class, 'image_condition_id');
    }

    // 🔗 Belongs to Attribute
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    // 🔗 Belongs to Value
    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'value_id');
    }
}
