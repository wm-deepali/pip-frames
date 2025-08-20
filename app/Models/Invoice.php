<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id',
        'invoice_number',
        'invoice_date',
        'total_amount',
        'is_paid',
    ];

    // Relationship: Invoice belongs to a Quote
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
