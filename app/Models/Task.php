<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'card_id',
        'parent_id',
        'title',
        'is_complete'
    ];
}
