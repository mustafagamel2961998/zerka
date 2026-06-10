<?php

namespace App\Repositories\Contracts\Category;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function getPaginated($perPage = null) : LengthAwarePaginator;
}