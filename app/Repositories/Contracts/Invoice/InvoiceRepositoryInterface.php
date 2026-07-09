<?php

namespace App\Repositories\Contracts\Invoice;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Invoice;

interface InvoiceRepositoryInterface
{
    public function getPaginated($perPage = null) : LengthAwarePaginator;
    public function findById(int $id) : Invoice;

}