<?php

namespace App\Actions\Dashboard\V1\City;
use App\Repositories\Contracts\City\CityRepositoryInterface;
use App\DTOs\Dashboard\V1\City\CreateDTO;
class CreateAction
{
    public function __construct(protected CityRepositoryInterface $city_repository_interface)
    {}

    public function execute(CreateDTO $data)
    {
        return $this->city_repository_interface->store($data->toArray());
    }
}