<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $fillable = ['name'];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_group_attribute');
    }
    public function subcategoryAssignments()
    {
        return $this->hasMany(AttributeGroupSubcategoryAssignment::class, 'attribute_group_id');
    }


}
