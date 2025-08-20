<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuoteItemAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_item_id',
        'attribute_id',
        'value_id',
        'length',
        'width',
        'unit'
    ];

    public function quoteItem()
    {
        return $this->belongsTo(QuoteItem::class);
    }

    // Assuming each attribute row points to an 'Attribute' model
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    // Assuming each row points to a selected value in an 'AttributeValue' model
    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class, 'value_id'); // explicitly use the correct FK
    }

}

