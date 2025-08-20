<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentralizedAttributeDependency extends Model
{
    protected $fillable = ['centralized_pricing_id', 'attribute_id', 'value_id'];

    public function pricing()
    {
        return $this->belongsTo(CentralizedAttributePricing::class, 'centralized_pricing_id');
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'value_id');
    }
}
