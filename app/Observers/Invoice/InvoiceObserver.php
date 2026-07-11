<?php

namespace App\Observers\Invoice;

use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
class InvoiceObserver
{
    public function creating(Invoice $invoice): void
    {
        $invoice->invoice_number = 'INV-'.InvoiceObserver::getNextOrderNumber();
    }

    private static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;

        $lastInvoiceNumber = Invoice::whereYear('created_at', $year)
            ->max('invoice_number');

        if ($lastInvoiceNumber) {
            // استخرج الجزء الرقمي بعد الشرطة (مثال: "2026-0007" -> 7)
            $lastSequence = (int) Str::afterLast($lastInvoiceNumber, '-');
            $nextSequence = $lastSequence + 1;
        } else {
            $nextSequence = 1;
        }

        return $year . '-' . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);
    }
}
