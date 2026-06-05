<?php

namespace Database\Seeders\Country;

use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getEgyptionCurrency = Currency::where("code","EGP")->sole();
        $country = Country::create([
            'currency_id'=>$getEgyptionCurrency->id,
            'iso2'=>'EG',
            'iso3'=>'EGY',
            'phone_code'=>'+20',
            'timezone'=>'Africa/Cairo',
            'status'=>'active',
        ]);

        $country->translations()->create([
            'locale' => 'ar',
            'name'   => 'مصر',
        ]);

        $country->translations()->create([
            'locale' => 'en',
            'name'   => 'Egypt',
        ]);

        $city = $country->cities()->create([
            'status'=>'active'
        ]);

        $city->translations()->create([
            'locale' => 'ar',
            'name'   => 'القاهرة',
        ]);

        $city->translations()->create([
            'locale' => 'en',
            'name'   => 'Cairo',
        ]);
    }

}
