<?php

namespace App\Enums\Order;
enum Status: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => trans('enum.pending'),
            self::PROCESSING => trans('enum.processing'),
            self::SHIPPED => trans('enum.shipped'),
            self::DELIVERED => trans('enum.delivered'),
            self::CANCELLED => trans('enum.cancelled'),
            self::COMPLETED => trans('enum.completed'),

        };
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
