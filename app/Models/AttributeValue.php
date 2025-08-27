<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = [
        'attribute_id',
        'value',
        'image_path',
        'description',
        'title',
        'icon_class',
        'custom_input_label',
        'is_composite_value',
        'fixed_extra_charges',
        'image_portrait_path',
        'image_landscape_path',
        'colour_code',
        'required_file_uploads',  // Added to fillable
    ];

    protected $casts = [
        'is_composite_value' => 'boolean',
        'fixed_extra_charges' => 'boolean',
    ];

    // Relationships

    /** Attribute this value belongs to */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /** Possible subcategory values */
    public function subcategoryValues()
    {
        return $this->hasMany(Subcategory::class, 'attribute_value_id');
    }

    /** Pricing modifiers */
    public function pricingRuleAttributes()
    {
        return $this->hasMany(PricingRuleAttribute::class, 'value_id');
    }

    /** Components if this is a composite value */
    public function components()
    {
        return $this->belongsToMany(
            self::class,
            'attribute_value_composites',
            'composite_id',   // This value is composite
            'component_id'    // Components
        );
    }

    /** Composites this value belongs to */
    public function composites()
    {
        return $this->belongsToMany(
            self::class,
            'attribute_value_composites',
            'component_id',  // This value is component
            'composite_id'   // Composites
        );
    }

    // You may also consider adding the relationship for parent images
    public function parentImages()
    {
        return $this->hasMany(AttributeValueParentImage::class);
    }
}
