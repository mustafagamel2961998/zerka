<?php

namespace App\Repositories\Contracts\Size;

use App\Models\Size;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
interface SizeRepositoryInterface
{
    public function all() : Collection;
    public function getPaginated($perPage=null) : LengthAwarePaginator;
    public function store(array $data) : Size;
    public function findById($id) : Size;
    public function update(array $data) : Size;
    public function destroy($id) : bool;
}