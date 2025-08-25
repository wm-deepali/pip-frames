<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = [
        'attribute_id',
        'value',
        'image_path',
        // 'icon_class',
        'description',
        'title',
        // 'custom_input_label',
        // 'is_composite_value',
        // 'fixed_extra_charges'
        'image_portrait_path',
        'image_landscape_path',
        'colour_code'
    ];

    protected $casts = [
        'is_composite_value' => 'boolean',
        'fixed_extra_charges' => 'boolean'
    ];

    /** Value belongs to a parent attribute */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /** Value may be available for specific subcategories */
    public function subcategoryValues()
    {
        return $this->hasMany(SubcategoryAttributeValue::class);
    }

    /** Value may be used in pricing rule modifiers */
    public function pricingRuleAttributes()
    {
        return $this->hasMany(PricingRuleAttribute::class, 'value_id');
    }

    /**
     * If this value is composite, it is made up of these components.
     */
    public function components()
    {
        return $this->belongsToMany(
            self::class,
            'attribute_value_composites',
            'composite_id',  // This value is the composite
            'component_id'   // These are the components it consists of
        );
    }

    /**
     * If this value is a component, it may belong to one or more composites.
     */
    public function composites()
    {
        return $this->belongsToMany(
            self::class,
            'attribute_value_composites',
            'component_id',  // This value is the component
            'composite_id'   // These are the composites it belongs to
        );
    }
}
