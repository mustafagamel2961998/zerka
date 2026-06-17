<?php

namespace App\Actions\Dashboard\V1\Warehouse;
use App\DTOs\Dashboard\V1\Warehouse\UpdateDTO;
use App\Repositories\Contracts\Warehouse\WarehouseRepositoryInterface;

class UpdateAction
{
    public function __construct(private WarehouseRepositoryInterface $warehouse_repository_interface){}
    public function execute(UpdateDTO $data)
    {
        return $this->warehouse_repository_interface->update($data->toArray());
    }
}