<?php

namespace App\Enums\Transaction;
enum Status: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => trans('enum.pending'),
            self::SUCCESS => trans('enum.success'),
            self::FAILED => trans('enum.failed'),
            self::REFUNDED => trans('enum.refunded'),
        };
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
