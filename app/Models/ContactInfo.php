<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
   protected $fillable = [
    'contact_number',
    'show_on_header',
    'show_on_footer',
    'mobile_number',
    'show_on_header_mobile',
    'show_on_footer_mobile',
    'email',
    'show_on_header_email',
    'show_on_footer_email',
    'full_address',
    'location_map',
    'website_url',
];

}
