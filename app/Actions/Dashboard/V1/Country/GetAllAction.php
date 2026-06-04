<?php

namespace App\Actions\Dashboard\V1\Country;

use App\Repositories\Contracts\Country\CountryRepositoryInterface;

class GetAllAction
{
    public function __construct(protected CountryRepositoryInterface $country_repository_interface){}

    public function execute(){
        return $this->country_repository_interface->index();
        
    }
}