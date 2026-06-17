<?php

namespace App\Observers\Warehouse;

use App\Models\Warehouse;
use App\Models\City;

class WarehouseObserver
{
    public function creating(Warehouse $warehouse)
    {
        // 1. بنجيب المدينة والدولة المربوطين بالمخزن
        $city = City::with('country')->find($warehouse->city_id);

        if ($city && $city->country) {
            $countryCode = strtoupper(substr($city->country->translations()->where('locale', 'en')->first()->name, 0, 2)); 
            $cityCode = strtoupper(substr($city->translations()->where('locale', 'en')->first()->name, 0, 3));

            $currentWarehousesCount = Warehouse::where('city_id', $warehouse->city_id)->count();
            $nextSerialNumber = str_pad($currentWarehousesCount + 1, 3, '0', STR_PAD_LEFT);

            $warehouse->code = "{$countryCode}-{$cityCode}-{$nextSerialNumber}";
        }
    }

    /**
     * Handle the Warehouse "created" event.
     */
    public function created(Warehouse $warehouse): void
    {
        //
    }

    /**
     * Handle the Warehouse "updated" event.
     */
    public function updated(Warehouse $warehouse): void
    {
        //
    }

    /**
     * Handle the Warehouse "deleted" event.
     */
    public function deleted(Warehouse $warehouse): void
    {
        //
    }

    /**
     * Handle the Warehouse "restored" event.
     */
    public function restored(Warehouse $warehouse): void
    {
        //
    }

    /**
     * Handle the Warehouse "force deleted" event.
     */
    public function forceDeleted(Warehouse $warehouse): void
    {
        //
    }
}
