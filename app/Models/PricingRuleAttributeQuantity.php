<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingRuleAttributeQuantity extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricing_rule_attribute_id',
        'quantity_from',
        'quantity_to',
        'price',
    ];

    public function pricingRuleAttribute()
    {
        return $this->belongsTo(PricingRuleAttribute::class);
    }
}
