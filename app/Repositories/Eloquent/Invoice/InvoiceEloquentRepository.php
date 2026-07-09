<?php

namespace App\Repositories\Eloquent\Invoice;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Models\Invoice;
class InvoiceEloquentRepository implements InvoiceRepositoryInterface
{
   public function getPaginated($perPage = null) : LengthAwarePaginator{
       return Invoice::latest()->with('order.user.profile')->paginate($perPage ?? 20);
   }


   public function findById(int $id) : Invoice{
     return Invoice::with('order.user.profile','order.items')->findOrFail($id);
   }

  
}