<?php

namespace App\Repositories\Eloquent\Country;

use App\Models\Country;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
class CountryEloquentRepository implements CountryRepositoryInterface
{
    public function __construct(){}
    
    public function all() : Collection{
        return Country::latest()->with('currentTranslation:id,country_id,name')->get();
    }
    public function getPaginated($perPage=null) : LengthAwarePaginator{
       return Country::with([
                'currentTranslation:id,country_id,name',
                'currency.currentTranslation:id,currency_id,name',
            ])
            ->withCount('cities')
            ->latest()
            ->paginate($perPage ?? 20);

    }
    

    public function store(array $data) : Country 
    {        
        $country = Country::create($data);
        foreach($data['name'] as $key => $value){
            $country->translations()->create([
                'locale' => $key,
                'name' => $value
            ]);
        }
        return $country;
    }

    public function findById($id) : Country{
        return Country::with([
                'currentTranslation:id,country_id,name',
                'translations:id,country_id,locale,name',
                'currency.currentTranslation:id,currency_id,name',
                'cities.currentTranslation:id,city_id,name',
            ])
            ->findOrFail($id);
    }

    public function update(array $data) : Country{
        $country = $this->findById($data['id']);
        $country->update($data);
        foreach($data['name'] as $key => $value){
            $country->translations()->updateOrCreate([
                'locale' => $key,
            ],[
                'name' => $value
            ]);
        }
        return $country;
    }

    public function destroy($id) : bool{
        $country = $this->findById($id);
        return $country->delete();
    }
}