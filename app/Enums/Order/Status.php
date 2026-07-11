<?php

namespace App\Enums\Order;
enum Status: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case PACKED = 'packed';
    case SHIPPED = 'shipped';
    case DELIVERING = 'delivering';
    case RECEIVED = 'received';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
    case REFUND_REQUEST     = 'refund_request';
    case REFUNDED = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => trans('enum.pending'),
            self::PROCESSING => trans('enum.processing'),
            self::PACKED => trans('enum.packed'),
            self::SHIPPED => trans('enum.shipped'),
            self::DELIVERING => trans('enum.delivering'),
            self::RECEIVED => trans('enum.received'),
            self::CANCELLED => trans('enum.cancelled'),
            self::COMPLETED =>trans('enum.completed'),
            self::REFUND_REQUEST =>trans('enum.refund_request'),
            self::REFUNDED =>trans('enum.refunded'),
        };
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
