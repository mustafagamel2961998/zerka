<?php

use App\Http\Controllers\Dashboard\v1\About\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Dashboard\V1\Auth\AuthController;
use App\Http\Controllers\Web\Dashboard\V1\Home\HomeController;
use App\Http\Controllers\Web\Dashboard\V1\Currency\CurrencyController;
use App\Http\Controllers\Web\Dashboard\V1\Country\CountryController;
use App\Http\Controllers\Web\Dashboard\V1\City\CityController;
use App\Http\Controllers\Web\Dashboard\V1\Category\CategoryController;
use App\Http\Controllers\Web\Dashboard\V1\Color\ColorController;
use App\Http\Controllers\Web\Dashboard\V1\Product\ProductController;
use App\Http\Controllers\Web\Dashboard\V1\Size\SizeController;
use App\Http\Controllers\Web\Dashboard\V1\Warehouse\WarehouseController;
use App\Http\Controllers\Web\Dashboard\V1\Order\OrderController;
use App\Http\Controllers\Web\Dashboard\V1\Setting\SettingController;
use App\Http\Controllers\Web\Dashboard\V1\Invoice\InvoiceController;
use App\Http\Controllers\Web\Dashboard\V1\User\UserController;
use App\Http\Controllers\Web\Dashboard\V1\Refund\RefundController;
Route::prefix("dashboard/v1")->as("dashboard.v1.")->group(function () {
    ////////////////////////////////////////////////////////////////////////////////////////////


    // Unauthenticated Routes
    //****************************************-:START:-****************************************/
    //------------------------------------------------------------------------------------------ 
    //-Auth Routes 
    Route::get('login',[AuthController::class,'index'])->name('login');
    Route::post('login/action',[AuthController::class,'login'])
            ->name('login.action')
            ->middleware('throttle:login');
    //------------------------------------------------------------------------------------------ 




    
    //****************************************-:END:-****************************************/





    // Authenticated Routes
    //****************************************-:START:-****************************************/
    Route::middleware(['checkRole','auth'])->group(function(){

    //****************************************-:START:-****************************************/
    //------------------------------------------------------------------------------------------ 
    //-Home Routes 
    Route::get('home',[HomeController::class,'index'])->name('home');
    Route::get('sales-chart',[HomeController::class,'getChartData'])->name('sales.chart');

    
    //------------------------------------------------------------------------------------------ 
    //-Currancy Routes 
    Route::resource('currencies',CurrencyController::class);
    //------------------------------------------------------------------------------------------ 
    //-Country Routes 
    Route::resource('countries',CountryController::class);
    //------------------------------------------------------------------------------------------ 
    //-City Routes 
    Route::resource('cities',CityController::class);
    //------------------------------------------------------------------------------------------ 
    //-Category Routes 
    Route::resource('categories',CategoryController::class);
    //------------------------------------------------------------------------------------------ 
    //-Color Routes 
    Route::resource('colors',ColorController::class);
    //------------------------------------------------------------------------------------------ 
    //-Size Routes 
    Route::resource('sizes',SizeController::class);
    //------------------------------------------------------------------------------------------ 
    //-Warehouse Routes 
    Route::resource('warehouses',WarehouseController::class);
    //------------------------------------------------------------------------------------------ 
    //-Product Routes 
    Route::delete('products/media/destroy/{media}',[ProductController::class,'destroyMedia'])->name('products.destroy.media');
    Route::resource('products',ProductController::class);
    //------------------------------------------------------------------------------------------ 
    //-Order Routes 
    Route::resource('orders',OrderController::class);
    //------------------------------------------------------------------------------------------ 
    //-Refund Routes
    Route::get('refund/request',[RefundController::class,'refund_request'])->name('refund.request');
    Route::put('refund/update/{id}',[RefundController::class,'update'])->name('refund.update');
    //------------------------------------------------------------------------------------------ 
    //-Invoice Routes 
    Route::resource('invoices',InvoiceController::class);
    //------------------------------------------------------------------------------------------ 
    //-User Routes 
    Route::get('customers/index',[UserController::class,'customers'])->name('customers.index');
    Route::get('managers/index',[UserController::class,'managers'])->name('managers.index');
    Route::get('users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::put('users/{user}',[UserController::class,'update'])->name('users.update');
    //------------------------------------------------------------------------------------------ 
    //-Setting Routes 
    Route::get('about-us',[AboutController::class,'edit'])->name('about-us.index');
    Route::put('about-us/update/{id}',[AboutController::class,'update'])->name('about-us.update');
    Route::resource('settings',SettingController::class);
    //------------------------------------------------------------------------------------------ 
    //-Logout Routes
    Route::get('logout',[AuthController::class,'logout'])->name('logout'); 
    });
    //****************************************-:END:-****************************************/



    ////////////////////////////////////////////////////////////////////////////////////////////
});
