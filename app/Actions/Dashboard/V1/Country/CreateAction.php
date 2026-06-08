<?php

namespace App\Actions\Dashboard\V1\Country;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\DTOs\Dashboard\V1\Country\CreateDTO;
class CreateAction
{
    public function __construct(protected CountryRepositoryInterface $country_repository_interface){}

    public function execute(CreateDTO $data)
    {
        return $this->country_repository_interface->store($data->toArray());
    }
}