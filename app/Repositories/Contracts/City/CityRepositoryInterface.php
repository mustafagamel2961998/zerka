<?php

namespace App\Repositories\Contracts\City;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\City;
use Illuminate\Support\Collection;
interface CityRepositoryInterface
{
    public function all() : Collection;
    public function getPaginated($perPage = null) : LengthAwarePaginator;
    public function store(array $data) : City;
    public function findById(int $id) : City;
    public function update(array $data) : City;
    public function destroy($id) : bool;
}