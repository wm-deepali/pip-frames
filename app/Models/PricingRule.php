<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PricingRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'pages_dragger_required',
        'pages_dragger_dependency',
        'default_quantity',
        'min_quantity',
        'max_quantity',
        'default_pages',
        'min_pages',
        'max_pages',
        'proof_reading_required',
        'delivery_charges_required',
        'centralized_paper_rates',
        'centralized_weight_rates',
    ];

    protected $casts = [
        'pages_dragger_required' => 'boolean',
        'proof_reading_required' => 'boolean',
        'delivery_charges_required' => 'boolean',
        'centralized_weight_rates' => 'boolean',
        'centralized_paper_rates' => 'boolean',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function quantities()
    {
        return $this->hasMany(PricingRuleQuantity::class)->orderBy('created_at');
    }

    public function attributes()
    {
        return $this->hasMany(PricingRuleAttribute::class);
    }
}
