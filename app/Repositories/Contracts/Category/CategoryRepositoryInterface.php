<?php

namespace App\Repositories\Contracts\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
interface CategoryRepositoryInterface
{
    public function baseQuery() : Builder;
    public function all() : Collection;
    public function getPaginated($perPage = null) : LengthAwarePaginator;
    public function store(array $data) : Category;
    public function findById($id) : Category;
    public function update($id, array $data) : Category;
    public function destroy($id) : bool;
}