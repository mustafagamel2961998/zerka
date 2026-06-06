<?php

namespace App\Repositories\Contracts\Currency;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
interface CurrencyRepositoryInterface
{
    public function index() : Collection;
    public function getPaginated($perPage = null) : LengthAwarePaginator;
}