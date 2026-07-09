<?php

namespace Database\Seeders\Setting;

use Illuminate\Database\Seeder;
use App\Models\Currency;
use App\Models\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getEgyptionCurrency = Currency::where("code","EGP")->sole();
        $setting = Setting::create([
            'currency_id'=>$getEgyptionCurrency->id,
            'phone'=>'01000000000',
            'email'=>'z7b0X@example.com',
            'tax_percentage'=>'14',
            'shipping_amount'=>'70',
            'timezone'=>'Africa/Cairo',
        ]);

        $setting->translations()->create([
            'locale' => 'ar',
            'name'   => 'زيركا',
        ]);

        $setting->translations()->create([
            'locale' => 'en',
            'name'   => 'ZERKA',
        ]);

        $setting->copyMedia(public_path('assets/images/dashboard/logo.png'))->toMediaCollection('logo');

    }
}
