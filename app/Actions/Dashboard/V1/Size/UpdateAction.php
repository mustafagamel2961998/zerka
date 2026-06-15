<?php

namespace App\Actions\Dashboard\V1\Color;
use App\Repositories\Contracts\Size\SizeRepositoryInterface;
use App\DTOs\Dashboard\V1\Size\UpdateDTO;
class UpdateAction
{
    public function __construct(private SizeRepositoryInterface $size_repository_interface){}
   
    public function execute(UpdateDTO $dto)
    {
        return $this->size_repository_interface->update($dto->toArray());
    }
}