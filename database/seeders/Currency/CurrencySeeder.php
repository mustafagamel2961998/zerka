<?php

namespace Database\Seeders\Currency;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currency = Currency::create([
            'code'=>'EGP',
            'exchange_rate'=>1,
            'decimal_places'=>2,
            'status'=>'active',
        ]);
        $currency->translations()->create([
            'locale'=> 'ar',
            'name'=>'جنيه مصري',
            'symbol'=>'ج.م',
        ]);
        $currency->translations()->create([
            'locale'=> 'en',
            'name'=>'Egyptian Pound',
            'symbol'=>'EGP',
        ]);
    }

}
