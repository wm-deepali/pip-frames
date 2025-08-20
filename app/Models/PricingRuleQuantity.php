<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PricingRuleQuantity extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricing_rule_id',
        'quantity_from',
        'quantity_to',
        'base_price',
    ];

    public function rule()
    {
        return $this->belongsTo(PricingRule::class, 'pricing_rule_id');
    }
}
