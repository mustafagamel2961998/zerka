<?php

namespace App\Repositories\Eloquent\Country;

use App\Models\Country;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Enums\Status;
use Illuminate\Pagination\LengthAwarePaginator;
use Override;

class CountryEloquentRepository implements CountryRepositoryInterface
{
    public function __construct(){}
    
    public function getPaginated($perPage=null) : LengthAwarePaginator{
       return Country::with([
                'translation:id,country_id,name',
                'currency.translation:id,currency_id,name',
                'cities',
            ])
            ->latest()
            ->paginate($perPage ?? 20);
        

    }
    public function getCount() : object{
        return Country::selectRaw("
            count(*) as total,
            sum(case when status = '" . Status::ACTIVE->value . "' then 1 else 0 end) as active_count,
            sum(case when status = '" . Status::INACTIVE->value . "' then 1 else 0 end) as inactive_count
        ")->first();
    }

    public function store(array $data)  
    {
        return $data;
        
        $country = Country::create($data);
        foreach($data['name'] as $key => $value){
            $country->translations()->create([
                'locale' => $key,
                'name' => $value
            ]);
        }
        return $country;
    }

}