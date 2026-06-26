<?php

namespace App\Repositories\Contracts\Order;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Order;
interface OrderRepositoryInterface
{
    public function getPaginated($perPage = null) : LengthAwarePaginator;
    public function findById($id) : Order;
}