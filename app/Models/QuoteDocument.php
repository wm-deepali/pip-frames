<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteDocument extends Model
{
    protected $fillable = [
        'quote_id',
        'name',
        'path',
        'type', 
    ];

    // Relationships
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
