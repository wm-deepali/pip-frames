<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_number',
        'order_number',
        'status',
        'customer_id',
        'vat_amount',
        'vat_percentage',
        'grand_total',
        'proof_type',
        'proof_price',
        'delivery_price',
        'delivery_date',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(QuoteBillingAddress::class);
    }

    public function deliveryAddress()
    {
        return $this->hasOne(QuoteDeliveryAddress::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function documents()
    {
        return $this->hasMany(QuoteDocument::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_quote')
            ->withPivot('notes')
            ->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

}
