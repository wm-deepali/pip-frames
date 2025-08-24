<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageCondition extends Model
{
    protected $fillable = [
        'subcategory_id',
        'affected_attribute_id',
    ];

    // 🔗 Condition has many dependencies
    public function dependencies()
    {
        return $this->hasMany(ImageConditionDependency::class);
    }

    // 🔗 Condition has many affected values
    public function affectedValues()
    {
        return $this->hasMany(ImageConditionAffectedValue::class);
    }

    // 🔗 Belongs to Subcategory
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // 🔗 Affected Attribute
    public function affectedAttribute()
    {
        return $this->belongsTo(Attribute::class, 'affected_attribute_id');
    }
}
