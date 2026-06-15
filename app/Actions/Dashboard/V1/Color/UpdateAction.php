<?php

namespace App\Actions\Dashboard\V1\Color;
use App\Repositories\Contracts\Color\ColorRepositoryInterface;
use App\DTOs\Dashboard\V1\Color\UpdateDTO;
class UpdateAction
{
    public function __construct(protected ColorRepositoryInterface $color_repository_interface){}
   
    public function execute(UpdateDTO $dto)
    {
        return $this->color_repository_interface->update($dto->toArray());
    }
}