<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'detail',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'thumbnail',
        'banner',
        'status',
    ];

    /**
     * Access full thumbnail URL if using public disk.
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }

    /**
     * Access full banner URL if using public disk.
     */
    public function getBannerUrlAttribute()
    {
        return $this->banner ? asset('storage/' . $this->banner) : null;
    }

    /**
     * Scope for published blogs.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
