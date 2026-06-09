<?php

namespace App\Repositories\Contracts\Country;

use App\Models\Country;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
interface CountryRepositoryInterface
{
    public function all() : Collection;
    public function getPaginated($perPage=null) : LengthAwarePaginator;
    public function store(array $data) : Country;
    public function findById($id) : Country;
    public function update($id, array $data) : Country;
    public function destroy($id) : bool;
}