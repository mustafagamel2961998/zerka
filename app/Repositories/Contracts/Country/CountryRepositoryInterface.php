<?php

namespace App\Repositories\Contracts\Country;

use Illuminate\Database\Eloquent\Collection;

interface CountryRepositoryInterface
{
    public function index() : Collection;
}