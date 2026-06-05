<?php

namespace Database\Seeders\User;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. إعادة تعيين كاش الصلاحيات (مهم جداً قبل الـ seeding)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            //countries    
           'view-countries',
           'manage-countries',

            //cities 
           'view-cities',
           'manage-cities',  

            //categories    
           'view-categories',
           'manage-categories',

            //products 
           'view-products',
           'manage-products',  
           

            //orders 
           'view-orders',
           'manage-orders',  
           
            //reports 
           'view-reports',
           'manage-reports',  
           ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $superAdminRole = Role::findOrCreate('Super Admin', 'web');

        $superAdminRole->givePermissionTo(Permission::all());

    
        $admin = User::firstOrCreate(
            ['email' => 'admin@zerka.com'], 
            [
                'phone'=>'01000000000',
                'password' => bcrypt('zerka'), 
                'email_verified_at' => now(),
                'status'=>'active',
            ]
        );
        
        $admin->copyMedia(public_path('assets/images/default/avatar.webp'))
              ->toMediaCollection('avatar');

        $country = Country::where('iso2','EG')->sole();
        $city = City::query()->first();
        
        if (!$admin->profile()->exists()) {
            $admin->profile()->create([
                'country_id'=>$country->id,
                'city_id'=>$city->id,
                'user_id'=>$admin->id,
                'first_name'=>'Youssif',
                'last_name'=>'Waleed',
            ]);
        }
        $admin->assignRole($superAdminRole);
    }
}
