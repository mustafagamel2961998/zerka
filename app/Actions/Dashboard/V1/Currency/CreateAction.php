<?php

namespace App\Actions\Dashboard\V1\Currency;
use App\Repositories\Contracts\Currency\CurrencyRepositoryInterface;
use App\DTOs\Dashboard\V1\Currency\CreateDTO;
class CreateAction
{
    public function __construct(private CurrencyRepositoryInterface $currency_repository_interface){}
    public function execute(CreateDTO $create_dto){
        return $this->currency_repository_interface->store($create_dto->toArray());
    }
}