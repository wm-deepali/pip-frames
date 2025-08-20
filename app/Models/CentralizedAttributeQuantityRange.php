<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentralizedAttributeQuantityRange extends Model
{
    protected $fillable = ['centralized_pricing_id', 'quantity_from', 'quantity_to', 'price'];

    public function pricing()
    {
        return $this->belongsTo(CentralizedAttributePricing::class, 'centralized_pricing_id');
    }
}
