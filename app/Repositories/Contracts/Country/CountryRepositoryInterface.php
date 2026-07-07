<?php

namespace App\Repositories\Contracts\Country;

use App\Models\Country;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
interface CountryRepositoryInterface
{
    public function baseQuery() : Builder;
    public function all() : Collection;
    public function getPaginated($perPage=null) : LengthAwarePaginator;
    public function store(array $data) : Country;
    public function findById($id) : Country;
    public function update(array $data) : Country;
    public function destroy($id) : bool;
}