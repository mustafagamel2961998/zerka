<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Front\V1\Auth\AuthController;
use App\Http\Controllers\Web\Front\V1\Home\HomeController;
use App\Http\Controllers\Web\Front\V1\Product\ProductController;
use App\Http\Controllers\Web\Front\V1\Cart\CartController;
use App\Http\Controllers\Web\Front\V1\Checkout\CheckoutController;
use App\Http\Controllers\Web\Front\V1\Profile\ProfileController;
    ////////////////////////////////////////////////////////////////////////////////////////////


    // Unauthenticated Routes
    //****************************************-:START:-****************************************/
    //------------------------------------------------------------------------------------------ 
    //-Auth Routes 
    Route::get('login',[AuthController::class,'loginView'])->name('login');
    //------------------------------------------------------------------------------------------ 
    //-Home Routes 
    Route::get('/',[HomeController::class,'index'])->name('home');
    //------------------------------------------------------------------------------------------ 
    //-Product Routes 
    Route::get('products/show/{id}/{slug}',[ProductController::class,'show'])->name('products.show');
    //------------------------------------------------------------------------------------------ 
    Route::middleware(['auth'])->group(function(){
    //------------------------------------------------------------------------------------------ 
        //-Cart Routes 
        Route::post('/cart/add',[CartController::class,'store'])->name('carts.store');
        Route::delete('cart/item/destroy/{item}',[CartController::class,'destroy'])->name('carts.destroy');
    //------------------------------------------------------------------------------------------ 
        //-Checkout Routes
        Route::get('checkout/index',[CheckoutController::class,'index'])->name('checkout.index');
    //------------------------------------------------------------------------------------------ 
        //-Profile Routes
        Route::get('profile',[ProfileController::class,'index'])->name('profile.index');
    });


    
    //****************************************-:END:-****************************************/





    // Authenticated Routes
    //****************************************-:START:-****************************************/
    Route::middleware(['auth'])->group(function(){

    //****************************************-:START:-****************************************/
    //------------------------------------------------------------------------------------------ 
    //-Profile Routes 
   
    
    });
    //****************************************-:END:-****************************************/



    ////////////////////////////////////////////////////////////////////////////////////////////

