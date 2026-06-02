<?php

namespace Database\Seeders\Country;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Country::create([
            'name'=>[
                        'ar' => 'مصر',
                        'en' => 'Egypt',
                    ],
            'status'=>'active',
        ]);
        City::create([
            'country_id'=>$country->id,
            'name'=>[
                        'ar' => 'مصر',
                        'en' => 'Egypt',
                    ],
            'status'=>'active',
        ]);

        
    }
}
