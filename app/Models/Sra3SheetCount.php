<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sra3SheetCount extends Model
{
    protected $fillable = ['attribute_value_id', 'sheet_count'];

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
