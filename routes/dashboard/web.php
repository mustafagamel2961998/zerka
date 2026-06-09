<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Dashboard\V1\Auth\AuthController;
use App\Http\Controllers\Web\Dashboard\V1\Currency\CurrencyController;
use App\Http\Controllers\Web\Dashboard\V1\Country\CountryController;
use App\Http\Controllers\Web\Dashboard\V1\City\CityController;
use App\Http\Controllers\Web\Dashboard\V1\Home\HomeController;

Route::prefix("dashboard/v1")->as("dashboard.v1.")->group(function () {
    ////////////////////////////////////////////////////////////////////////////////////////////


    // Unauthenticated Routes
    //****************************************-:START:-****************************************/
    //------------------------------------------------------------------------------------------ 
    //-Auth Routes 
    Route::get('login',[AuthController::class,'index'])->name('login');
    Route::post('login',[AuthController::class,'login'])
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
    //------------------------------------------------------------------------------------------ 
    //-Currancy Routes 
    Route::resource('currencies',CurrencyController::class);
    //------------------------------------------------------------------------------------------ 
    //-Country Routes 
    Route::resource('countries',CountryController::class);
    //------------------------------------------------------------------------------------------ 
    //-City Routes 
    Route::resource('cities',CityController::class);
    
    });
    //****************************************-:END:-****************************************/



    ////////////////////////////////////////////////////////////////////////////////////////////
});
