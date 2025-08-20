<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];


    public function quotes()
    {
        return $this->belongsToMany(Quote::class, 'department_quote')
            ->withPivot('notes')
            ->withTimestamps();
    }

}
