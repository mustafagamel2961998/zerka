<?php

namespace App\Actions\Dashboard\V1\Country;
use App\Repositories\Eloquent\Country\CountryEloquentRepository;

class ActiveAction
{
    public function __construct(protected CountryEloquentRepository $country_eloquent_repository){}

    public function execute(){
        $this->country_eloquent_repository->active();
    }


}