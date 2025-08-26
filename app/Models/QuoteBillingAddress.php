<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuoteBillingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'address',
        'country',
        'city',             // Added city
        'postcode',
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
