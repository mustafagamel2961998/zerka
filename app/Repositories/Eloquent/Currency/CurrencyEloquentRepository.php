<?php

namespace App\Repositories\Eloquent\Currency;
use App\Repositories\Contracts\Currency\CurrencyRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Currency;
use Illuminate\Support\Collection;
class CurrencyEloquentRepository implements CurrencyRepositoryInterface
{
    public function __construct()
    {}

    public function index() : Collection{
        return Currency::with('currentTranslation')->latest()->get();
    }
    public function getPaginated($perPage = null) : LengthAwarePaginator{
        return Currency::with('currentTranslation:id,currency_id,name')->latest()->paginate($perPage ?? 20);
    }
}