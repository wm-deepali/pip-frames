<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['customer_id', 'type', 'address_line1', 'address_line2', 'city', 'state', 'postal_code', 'country', 'is_default', 'address_tag'];

    public function user()
    {
        return $this->belongsTo(Customer::class);
    }


    public function cityname()
    {
        return $this->hasOne(City::class, 'id', 'city');
    }
    public function statename()
    {
        return $this->hasOne(State::class, 'id', 'state');
    }
    public function countryname()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }

}