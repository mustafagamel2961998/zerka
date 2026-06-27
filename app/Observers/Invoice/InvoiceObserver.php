<?php

namespace App\Observers\Invoice;

use App\Models\Invoice;
use Illuminate\Support\Carbon;

class InvoiceObserver
{
    public function creating(Invoice $invoice): void
    {
        $invoice->invoice_number = 'INV-'.InvoiceObserver::getNextOrderNumber();
    }

    private static function getNextOrderNumber(){
        $year = Carbon::now()->year;

        $invoiceNumber = Invoice::whereYear('created_at', $year)->max('invoice_number');
        if($invoiceNumber){
            return $invoiceNumber +1;
        }   

        return $year .'-'. '0001';
    }
}
