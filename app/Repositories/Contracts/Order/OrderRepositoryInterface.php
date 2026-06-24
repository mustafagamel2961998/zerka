<?php

namespace App\Repositories\Contracts\Order;

use Illuminate\Pagination\LengthAwarePaginator;
interface OrderRepositoryInterface
{
    public function getPaginated($perPage = null) : LengthAwarePaginator;
}