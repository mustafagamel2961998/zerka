<?php

namespace App\Actions\Dashboard\V1\City;
use App\Repositories\Contracts\City\CityRepositoryInterface;
use App\DTOs\Dashboard\V1\City\UpdadteDTO;
class UpdateAction
{

    public function __construct(protected CityRepositoryInterface $city_repository_interface)
    {}
    public function execute($id,UpdadteDTO $data)
    {
        return $this->city_repository_interface->update($id,$data->toArray());
    }
}