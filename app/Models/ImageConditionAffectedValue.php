<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageConditionAffectedValue extends Model
{
    protected $fillable = [
        'image_condition_id',
        'value_id',
        'image',
    ];

    // 🔗 Belongs to Condition
    public function condition()
    {
        return $this->belongsTo(ImageCondition::class, 'image_condition_id');
    }

    // 🔗 Belongs to Value
    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'value_id');
    }
}
