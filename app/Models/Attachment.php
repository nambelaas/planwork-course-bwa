<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'userId',
        'cardId',
        'file',
        'link',
        'name'
    ];
}
