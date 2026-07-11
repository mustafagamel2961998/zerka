<?php

namespace App\Enums\Refund;

enum RefundStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    //-----------------------------------------------------------------------------//

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('global.pending'),
            self::APPROVED => __('global.approved'),
            self::REJECTED => __('global.rejected'),
        };
    }

    //-----------------------------------------------------------------------------//

    public function badgeClass(): string
    {
        return match ($this) {
            self::PENDING => 'border', // custom inline color هنستخدمها في الـ blade
            self::APPROVED => 'border border-success text-success',
            self::REJECTED => 'border border-danger text-danger',
        };
    }

    //-----------------------------------------------------------------------------//

    public function icon(): string
    {
        return match ($this) {
            self::PENDING => 'solar:clock-circle-broken',
            self::APPROVED => 'solar:check-circle-broken',
            self::REJECTED => 'solar:close-circle-broken',
        };
    }

    //-----------------------------------------------------------------------------//

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}