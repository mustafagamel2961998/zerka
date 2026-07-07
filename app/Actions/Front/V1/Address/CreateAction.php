<?php

namespace App\Actions\Front\V1\Address;
use App\Repositories\Contracts\Address\AddressRepositoryInterface;
use App\DTOs\Front\V1\Address\CreateDTO;
class CreateAction
{
    public function __construct(private AddressRepositoryInterface $address_repository_interface)
    {
        //
    }

    public function execute(CreateDTO $create_dto)
    {
        return $this->address_repository_interface->store($create_dto->toArray());
    }
}