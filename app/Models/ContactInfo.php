<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'contact_number',
        'show_on_header',
        'mobile_number',
        'email',
        'full_address',
        'location_map',
        'website_url',
    ];
}
