<?php

namespace App\Repositories\Eloquent\City;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\City\CityRepositoryInterface;
use App\Models\City;
class CityEloquentRepository implements CityRepositoryInterface
{
   public function getPaginated($perPage = null) : LengthAwarePaginator{
      return City::with([
            'translation:id,city_id,name',
            'country.translation:id,country_id,name',
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
            'translation:id,city_id,name',
            'country.translation:id,country_id,name',
        ])
        ->findOrFail($id);
   }

   public function update($id, array $data) : City{
      $city = $this->findById($id);
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