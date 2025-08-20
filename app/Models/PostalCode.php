<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;

    protected $fillable = ['continent','pincode', 'country', 'city', 'state', 'delivery_charge', 'is_serviceable'];


}
