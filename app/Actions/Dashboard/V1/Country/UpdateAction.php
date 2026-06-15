<?php

namespace App\Actions\Dashboard\V1\Country;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\DTOs\Dashboard\V1\Country\UpdateDTO;
class UpdateAction
{
    public function __construct(protected CountryRepositoryInterface $country_repository_interface){}

    public function execute(string $id, UpdateDTO $data)
    {
        return $this->country_repository_interface->update($id, $data->toArray());
    }
}