<?php

namespace App\Repositories\Contracts\Order;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
interface OrderRepositoryInterface
{
    public function baseQuery() : Builder;
    public function getPaginated($perPage = null) : LengthAwarePaginator;
    public function findById($id) : Order;
    public function update(array $data) ;
}