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
    public function findById($id) : Currency{
        return Currency::with('translations:id,currency_id,name,symbol,locale')->findOrFail($id);
    }
    public function store(array $data) : Currency{
        $currency = Currency::create($data);
        foreach($data['name'] as $key => $value){
            $currency->translations()->create([
                'locale' => $key,
                'name' => $value,
                'symbol' => $data['symbol'][$key],
            ]);
        }
        return $currency;
    }
    public function destroy($id) : bool{
        $currency = $this->findById($id);
        return $currency->delete();
    }
}