<?php

namespace App\Repositories\Eloquent\City;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\City\CityRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\City;
class CityEloquentRepository implements CityRepositoryInterface
{
   public function all() : Collection{
      return City::active()->with('currentTranslation')->get();
   } 
   public function getPaginated($perPage = null) : LengthAwarePaginator{
      return City::with([
            'currentTranslation:id,city_id,name',
            'country.currentTranslation:id,country_id,name',
        ])
        ->latest()
        ->paginate($perPage ?? 20);
   }

   public function store(array $data) : City{
      $city = City::create($data);
       foreach($data['name'] as $key => $value){
            $city->translations()->create([
                'locale' => $key,
                'name' => $value
            ]);
        }
      return $city;
   }

   public function findById(int $id) : City{
      return City::with([
            'translations:id,city_id,locale,name',
            'currentTranslation:id,city_id,name',
            'country.currentTranslation:id,country_id,name',
        ])
        ->findOrFail($id);
   }

   public function update(array $data) : City{
      $city = $this->findById($data['id']);
      $city->update($data);
      foreach($data['name'] as $key => $value){
            $city->translations()->updateOrCreate([
                'locale' => $key,
            ],[
                'name' => $value
            ]);
        }
      return $city;
   }

   public function destroy($id) : bool{
      $city = $this->findById($id);
      return $city->delete();
   }
}