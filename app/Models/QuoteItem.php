<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuoteItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id',
        'subcategory_id',
        'quantity',
        'sub_total',
        'pet_name',
        'pet_birthdate',
        'personal_text',
        'note',
        'photos',
        'extra_options',
    ];

    protected $casts = [
        'photos' => 'array',          // Automatically cast JSON to array
        'extra_options' => 'array',   // Automatically cast JSON to array
        'pet_birthdate' => 'date',    // Cast date string to Carbon instance
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function attributes()
    {
        return $this->hasMany(QuoteItemAttribute::class); // adjust if needed
    }
}
