<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteAttribute extends Model
{
    protected $fillable = [
        'quote_id',
        'attribute_id',
        'value',         // e.g., "Gloss", "A4"
        'field_values',  // e.g., {"Width": 210, "Height": 297}
        'extra_data',    // Optional metadata like icon/image if needed
    ];

    protected $casts = [
        'field_values' => 'array',
        'extra_data' => 'array',
    ];

    /** Belongs to the quote */
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    /** Refers to the attribute (e.g., Paper Type, Size) */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
