<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueParentImage extends Model
{
    protected $fillable = [
        'attribute_value_id',
        'parent_attribute_id',
        'parent_attribute_value_id',
        'image_path',
        'orientation',
    ];

    // Relations

    /**
     * The attribute value this image belongs to.
     */
    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }

    /**
     * The parent attribute for this image.
     */
    public function parentAttribute()
    {
        return $this->belongsTo(Attribute::class, 'parent_attribute_id');
    }

    /**
     * The parent attribute's specific value linked to this image.
     */
    public function parentAttributeValue()
    {
        return $this->belongsTo(AttributeValue::class, 'parent_attribute_value_id');
    }
}
