<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CustomerTemp extends Authenticatable
{
    protected $table = 'customers_temp';
    protected $fillable = [
        'name', 'email','google_id', 'profile_pic'
    ];


    
}
