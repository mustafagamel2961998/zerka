<?php

namespace App\Repositories\Eloquent\Country;

use App\Models\Country;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CountryEloquentRepository implements CountryRepositoryInterface
{
    public function __construct(){}
    
    public function index() : Collection{
        return Country::latest()->get();
    }

    public function active() : Collection{
        return Country::active()->latest()->get();
    }
}