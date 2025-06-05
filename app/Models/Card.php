<?php

namespace App\Models;

use App\Enums\CardPriority;
use App\Enums\CardStatus;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'user_id',
        'workspace_id',
        'title',
        'description',
        'deadline',
        'order',
        'status',
        'priority'
    ];

    protected function casts(): array
    {
        return [
            'status'=>CardStatus::class,
            'priority'=>CardPriority::class
        ];
    }
}
