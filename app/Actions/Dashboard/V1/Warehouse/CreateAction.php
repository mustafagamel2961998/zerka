<?php

namespace App\Actions\Dashboard\V1\Warehouse;
use App\DTOs\Dashboard\V1\Warehouse\CreateDTO;
use App\Repositories\Contracts\Warehouse\WarehouseRepositoryInterface;

class CreateAction
{
    public function __construct(private WarehouseRepositoryInterface $warehouse_repository_interface)
    {
        //
    }

    public function execute(CreateDTO $data)
    {
        return $this->warehouse_repository_interface->store($data->toArray());
    }
}