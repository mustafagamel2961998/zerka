<?php

namespace App\Actions\Dashboard\V1\Size;
use App\Repositories\Contracts\Size\SizeRepositoryInterface;
use App\DTOs\Dashboard\V1\Size\CreateDTO;
class CreateAction
{
    public function __construct(private SizeRepositoryInterface $size_repository_interface){}

    public function execute(CreateDTO $data)
    {
        return $this->size_repository_interface->store($data->toArray());
    }
}