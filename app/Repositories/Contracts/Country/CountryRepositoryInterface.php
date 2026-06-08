<?php

namespace App\Repositories\Contracts\Country;

use Illuminate\Pagination\LengthAwarePaginator;
interface CountryRepositoryInterface
{
    public function getPaginated($perPage=null) : LengthAwarePaginator;
    public function getCount() : Object;
    public function store(array $data) ;
}