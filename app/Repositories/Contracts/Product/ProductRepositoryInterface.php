<?php

namespace App\Repositories\Contracts\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Product;

interface ProductRepositoryInterface
{
    // public function all() : Collection;
    public function getPaginated($perPage = null) : LengthAwarePaginator;
    public function store(array $data) ;
    public function findById($id) : Product;
    public function update(array $data) : Product;
    // public function destroy($id);
}