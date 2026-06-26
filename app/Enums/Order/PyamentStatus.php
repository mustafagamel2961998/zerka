<?php

namespace App\Enums\Order;
enum PyamentStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case FAILED = 'failed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => trans('enum.pending'),
            self::PAID => trans('enum.paid'),
            self::FAILED => trans('enum.failed'),
        };
    }
    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
