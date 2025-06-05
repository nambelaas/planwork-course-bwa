<?php

namespace App\Enums;

enum CardPriority: string
{
    case URGENT = 'Urgent';
    case HIGH = 'High';
    case Medium = 'Medium';
    case LOW = 'Low';
    case UNKNOWN = 'Unknown';

    public static function option(): array
    {
        return collect(self::cases())->map(fn($item) => [
            'value' => $item->value,
            'label' => $item->name
        ])->values()->toArray();
    }
}
