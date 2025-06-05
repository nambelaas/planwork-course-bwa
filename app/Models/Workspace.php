<?php

namespace App\Models;

use App\Enums\WorkspaceVisibility;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'cover',
        'logo',
        'visibility'
    ];

    protected function casts():array
    {
        return [
            'visibility'=>WorkspaceVisibility::class
        ];
    }
}
