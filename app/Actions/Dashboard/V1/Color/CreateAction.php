<?php

namespace App\Actions\Dashboard\V1\Color;
use App\Repositories\Contracts\Color\ColorRepositoryInterface;
use App\DTOs\Dashboard\V1\Color\CreateDTO;
class CreateAction
{
    public function __construct(protected ColorRepositoryInterface $color_repository_interface){}

    public function execute(CreateDTO $data)
    {
        return $this->color_repository_interface->store($data->toArray());
    }
}