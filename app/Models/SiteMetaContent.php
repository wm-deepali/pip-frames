<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMetaContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'keywords',
        'description',
        'canonical_link',
        'og_locale',
        'og_type',
        'og_title',
        'og_image',
        'og_description',
        'og_site_name',
        'twitter_card',
        'twitter_description',
        'twitter_title',
        'twitter_site',
        'twitter_creator',
        'twitter_image',
        'publisher',
        'og_tag',
        'twitter_tag_url',
    ];
}
