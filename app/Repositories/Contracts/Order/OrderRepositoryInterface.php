<?php

namespace App\Repositories\Contracts\Order;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;
interface OrderRepositoryInterface
{
    public function getPaginated($perPage = null) : LengthAwarePaginator;
    public function findById($id) : Order;
}