<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CentralizedAttributePricing extends Model
{
    use HasFactory;

    protected $fillable = ['attribute_id', 'value_id', 'price'];

    public function dependencies()
    {
        return $this->hasMany(CentralizedAttributeDependency::class, 'centralized_pricing_id');
    }

    public function quantityRanges()
    {
        return $this->hasMany(CentralizedAttributeQuantityRange::class, 'centralized_pricing_id');
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function value()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
