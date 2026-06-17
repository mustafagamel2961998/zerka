<?php

namespace App\Actions\Dashboard\V1\City;
use App\Repositories\Contracts\City\CityRepositoryInterface;
use App\DTOs\Dashboard\V1\City\UpdateDTO;
class UpdateAction
{

    public function __construct(protected CityRepositoryInterface $city_repository_interface)
    {}
    public function execute(UpdateDTO $data)
    {
        return $this->city_repository_interface->update($data->toArray());
    }
}