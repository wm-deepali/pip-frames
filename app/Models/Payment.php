<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'quote_id',
        'invoice_id',
        'payment_type',
        'payment_method',
        'amount_received',
        'payment_date',
        'reference_number',
        'remarks',
        'payment_proof',
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}

