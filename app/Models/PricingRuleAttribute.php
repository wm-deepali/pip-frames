<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PricingRuleAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricing_rule_id',
        'attribute_id',
        'value_id',
        'price_modifier_type',
        'price_modifier_value',
        'base_charges_type',
        // 'extra_copy_charge',
        // 'extra_copy_charge_type',
        // 'flat_rate_per_page',
        'is_default',
        'max_width',
        'max_height',
        'min_width',
        'min_height'
    ];

    public function rule()
    {
        return $this->belongsTo(PricingRule::class, 'pricing_rule_id');
    }


    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'value_id');
    }

    public function quantityRanges()
    {
        return $this->hasMany(PricingRuleAttributeQuantity::class)->orderBy('created_at');
    }

    public function dependencies()
    {
        return $this->hasMany(PricingRuleAttributeDependency::class);
    }


}

