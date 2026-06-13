<?php

namespace App\Actions\Dashboard\V1\Category;
use App\DTOs\Dashboard\V1\Category\UpdadteDTO;
use App\Repositories\Contracts\Category\CategoryRepositoryInterface;
use App\Services\Dashboard\Media\MediaService;
class UpdateAction
{
    public function __construct(protected CategoryRepositoryInterface $category_repository_interface){}

    public function execute($id,UpdadteDTO $data)
    {
        $category = $this->category_repository_interface->update($id,$data->toArray());
        MediaService::singleFileUpload($category, 'cover', $data->cover,true);
        return $category;
    }
}