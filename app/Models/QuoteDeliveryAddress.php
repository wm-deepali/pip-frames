<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuoteDeliveryAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id',
        'first_name',
        'last_name',
        'mobile',
        'address',
        'country',
        'delivery_instructions',
        'plain_packaging',
        'same_as_billing',
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    
}
