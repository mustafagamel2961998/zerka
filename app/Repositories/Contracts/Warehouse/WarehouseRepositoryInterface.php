<?php

namespace App\Repositories\Contracts\Warehouse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Warehouse;

interface WarehouseRepositoryInterface
{
    public function all() : Collection;
    public function getPaginated($perPage = null) : LengthAwarePaginator;
    public function store(array $data) : Warehouse;
    public function findById($id) : Warehouse;
    public function update(array $data) : Warehouse;
    // public function destroy($id);
}