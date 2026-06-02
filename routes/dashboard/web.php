<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\V1\Auth\AuthController;
Route::prefix("v1/dashboard")->as("dashboard.")->group(function () {
    ////////////////////////////////////////////////////////////////////////////////////////////


    // Unauthenticated Routes
    //****************************************-:START:-****************************************/
    //-Auth Routes 
    Route::get('login/index',[AuthController::class,'index'])->name('login.index');
    Route::post('login',[AuthController::class,'login'])->name('login');
    //------------------------------------------------------------------------------------------ 




    
    //****************************************-:END:-****************************************/





    // Authenticated Routes
    //****************************************-:START:-****************************************/
    Route::get('dashboard/home',function(){
        return view('dashboard.home.index');
    });
    //****************************************-:END:-****************************************/



    ////////////////////////////////////////////////////////////////////////////////////////////
});
