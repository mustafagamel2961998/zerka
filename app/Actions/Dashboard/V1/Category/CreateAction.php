<?php

namespace App\Actions\Dashboard\V1\Category;
use App\DTOs\Dashboard\V1\Category\CreateDTO;
use App\Repositories\Contracts\Category\CategoryRepositoryInterface;
use App\Services\Dashboard\Media\MediaService;

class CreateAction
{
    public function __construct(protected CategoryRepositoryInterface $category_repository_interface){}

    public function execute(CreateDTO $data)
    {
      
        $category = $this->category_repository_interface->store($data->toArray());
        MediaService::singleFileUpload($category, 'cover', $data->cover);
        return $category;
    }
}