<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingRuleAttributeDependency extends Model
{
    protected $fillable = [
        'pricing_rule_attribute_id',
        'parent_attribute_id',
        'parent_value_id',
    ];

    public function pricingRuleAttribute()
    {
        return $this->belongsTo(PricingRuleAttribute::class);
    }

    public function parentAttribute()
    {
        return $this->belongsTo(Attribute::class, 'parent_attribute_id');
    }

    public function parentValue()
    {
        return $this->belongsTo(AttributeValue::class, 'parent_value_id');
    }

}
