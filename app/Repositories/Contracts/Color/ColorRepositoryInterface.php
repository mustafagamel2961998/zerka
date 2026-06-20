<?php

namespace App\Repositories\Contracts\Color;

use App\Models\Color;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
interface ColorRepositoryInterface
{
    public function all() : Collection;
    public function getPaginated($perPage=null) : LengthAwarePaginator;
    public function store(array $data) : Color;
    public function findById($id) : Color;
    public function update(array $data) : Color;
    public function destroy($id) : bool;
}