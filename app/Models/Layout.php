<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Layout extends Model
{
    use Notifiable;
    protected $table = 'layout_content';
    protected $guarded = [];
}
