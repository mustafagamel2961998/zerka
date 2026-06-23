<?php

namespace App\Repositories\Eloquent\Warehouse;
use App\Repositories\Contracts\Warehouse\WarehouseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Warehouse;
use Illuminate\Support\Collection;
class WarehouseEloquentRepository implements WarehouseRepositoryInterface
{
    public function __construct()
    {
        //
    }
    public function all() : Collection {
        return Warehouse::where('status','active')->with([
            'currentTranslation:id,warehouse_id,locale,name',
            'country.currentTranslation:id,country_id,name',
            'city.currentTranslation:id,city_id,name',
        ])->get();
    }
    public function getPaginated($perPage = null) : LengthAwarePaginator {

        return Warehouse::with([
            'translations:id,warehouse_id,locale,name,description',
            'country.currentTranslation:id,country_id,name',
            'city.currentTranslation:id,city_id,name',
        ])->withCount('inventories')->paginate($perPage ?? 20);
    }

    public function store(array $data) : Warehouse {
    
        $warehouse = Warehouse::create($data);
        foreach($data['name'] as $key => $value){
            $warehouse->translations()->create([
                'locale' => $key,
                'name' => $value,
                'description' => $data['description'][$key],
            ]);
        }
        return $warehouse;
    }
    public function findById($id) : Warehouse {
        return Warehouse::with([
            'currentTranslation:id,warehouse_id,name',
            'translations:id,warehouse_id,locale,name,description',
            'country.currentTranslation:id,country_id,name',
            'city.currentTranslation:id,city_id,name',
        ])->withCount('inventories')->findOrFail($id);
    }

    public function update(array $data) : Warehouse {
        $warehouse = $this->findById($data['id']);
        $warehouse->update($data);
        foreach($data['name'] as $key => $value){
            $warehouse->translations()->updateOrCreate([
                'locale' => $key,
            ],[
                'name' => $value,
                'description' => $data['description'][$key],
            ]);
        }
        return $warehouse;
    }
}