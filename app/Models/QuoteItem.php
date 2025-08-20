<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    protected $fillable = [
        'quote_id',
        'subcategory_id',
        'quantity',
        'pages',
        'sub_total',
        'composite_pages',
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
        return $this->hasMany(QuoteItemAttribute::class); // adjust model/class name if needed
    }

}
