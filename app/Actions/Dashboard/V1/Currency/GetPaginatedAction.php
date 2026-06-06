<?php

namespace App\Actions\Dashboard\V1\Currency;
use App\Repositories\Contracts\Country\CurrencyRepositoryInterface;
class GetPaginatedAction
{
    public function __construct(protected CurrencyRepositoryInterface $currency_repository_interface){}

    public function execute(){
        return $this->currency_repository_interface->getPaginated();
    }
}