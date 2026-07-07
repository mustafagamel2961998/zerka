<?php

namespace App\Actions\Front\V1\Address;
use App\Repositories\Contracts\Address\AddressRepositoryInterface;
use App\DTOs\Front\V1\Address\UpdateDTO;
class UpdateAction
{
    public function __construct(private AddressRepositoryInterface $address_repository_interface)
    {
        //
    }

    public function execute(UpdateDTO $create_dto)
    {
        return $this->address_repository_interface->update($create_dto->toArray());
    }
}