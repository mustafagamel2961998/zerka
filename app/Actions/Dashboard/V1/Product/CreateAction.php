<?php

namespace App\Actions\Dashboard\V1\Product;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use App\DTOs\Dashboard\V1\Product\CreateDTO;
class CreateAction
{
    public function __construct(private ProductRepositoryInterface $product_repository_interface){}
    public function execute(CreateDTO $dto)
    {
        return $this->product_repository_interface->store($dto->toArray());
    }
}