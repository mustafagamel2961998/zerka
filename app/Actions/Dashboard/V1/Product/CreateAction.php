<?php

namespace App\Actions\Dashboard\V1\Product;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use App\DTOs\Dashboard\V1\Product\CreateDTO;
use App\Services\Dashboard\Media\MediaService;
class CreateAction
{
    public function __construct(private ProductRepositoryInterface $product_repository_interface){}
    public function execute(CreateDTO $dto)
    {
        $product =  $this->product_repository_interface->store($dto->toArray());
        MediaService::multipleFileUpload($product, 'images', $dto->images);
    }
}