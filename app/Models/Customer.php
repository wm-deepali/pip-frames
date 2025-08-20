<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'display_name',
        'email',
        'password',
        'mobile',
        'whatsapp_number',
        'mobile_verified_at',
        'email_verified_at',
        'google_id',
        'profile_pic',
        'customer_id',
        'country',
        'status',
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];


    // In App\Models\Customer.php
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }


    public function countryname()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function billingAddresses()
    {
        return $this->addresses()->where('type', 'billing');
    }

    public function shippingAddresses()
    {
        return $this->addresses()->where('type', 'shipping');
    }
}