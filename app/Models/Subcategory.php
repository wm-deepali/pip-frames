<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Subcategory extends Model
{
    use HasFactory, HasSlug;

    protected $table = "subcategories";

    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'gallery',
        'is_premium',
        'status',
        'calculator_required'
    ];

    protected $casts = [
        'gallery' => 'array',
        'calculator_required' => 'boolean'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    // 🔄 Many-to-many relationship with categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_subcategory');
    }

    public function details()
    {
        return $this->hasOne(SubcategoryDetail::class);
    }

    public function groupAssignments() // ✅ Uses the new model-based table
    {
        return $this->hasMany(AttributeGroupSubcategoryAssignment::class);
    }

}
