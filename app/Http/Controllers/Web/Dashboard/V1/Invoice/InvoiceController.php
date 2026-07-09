<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Invoice;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
class InvoiceController extends Controller
{
    public function __construct(private InvoiceRepositoryInterface $invoice_repository_interface){}

    public function index()
    {
        $invoices = $this->invoice_repository_interface->getPaginated();

        return view('dashboard.invoice.index', compact('invoices'));
    }

    public function show($id){
        $invoice = $this->invoice_repository_interface->findById($id);
        return view('dashboard.invoice.show',compact('invoice'));
    }
}
