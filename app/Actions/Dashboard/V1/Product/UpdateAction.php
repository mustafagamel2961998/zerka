<?php

namespace App\Actions\Dashboard\V1\Product;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use App\DTOs\Dashboard\V1\Product\UpdateDTO;
use App\Services\Dashboard\Media\MediaService;

class UpdateAction
{
    public function __construct(private ProductRepositoryInterface $product_repository_interface){}
    public function execute(UpdateDTO $dto)
    {
        $product = $this->product_repository_interface->update($dto->toArray());
        MediaService::multipleFileUpload($product, 'images', $dto->images ?? []);
        return $product;
    }
}