<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Front\V1\Auth\AuthController;
use App\Http\Controllers\Web\Front\V1\Home\HomeController;
use App\Http\Controllers\Web\Front\V1\Product\ProductController;
use App\Http\Controllers\Web\Front\V1\Cart\CartController;
use App\Http\Controllers\Web\Front\V1\Checkout\CheckoutController;
use App\Http\Controllers\Web\Front\V1\Country\CountryController;
use App\Http\Controllers\Web\Front\V1\Profile\ProfileController;
use App\Http\Controllers\Web\Front\V1\Address\AddressController;
use App\Http\Controllers\Web\Front\V1\Order\OrderController;
use App\Http\Controllers\Web\Front\V1\Refund\RefundController;
use App\Http\Controllers\Web\Front\V1\Category\CategoryController;
    ////////////////////////////////////////////////////////////////////////////////////////////


    // Unauthenticated Routes
    //****************************************-:START:-****************************************/
    //------------------------------------------------------------------------------------------ 
    //-Auth Routes 
    Route::get('login',[AuthController::class,'loginView'])->name('login');
    Route::post('login/action',[AuthController::class,'login'])
            ->name('login.action')
            ->middleware('throttle:login');
    Route::get('register',[AuthController::class,'registerView'])->name('register');
    Route::post('register/action',[AuthController::class,'register'])->name('register.action');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    //------------------------------------------------------------------------------------------ 
    //-Home Routes 
    Route::get('/',[HomeController::class,'index'])->name('home');
    //------------------------------------------------------------------------------------------ 
    //-Product Routes 
    Route::get('products/show/{id}/{slug}',[ProductController::class,'show'])->name('products.show');
    //------------------------------------------------------------------------------------------ 
    //-Category Routes
    Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/{id}/{slug}/products', [CategoryController::class, 'products'])->name('categories.products');
    // Authenticated Routes
    //****************************************-:START:-****************************************/
    //------------------------------------------------------------------------------------------ 
    Route::middleware(['auth'])->group(function(){
        //------------------------------------------------------------------------------------------ 
        //-Cart Routes 
        Route::post('/cart/add',[CartController::class,'store'])->name('carts.store');
        Route::delete('cart/item/destroy/{item}',[CartController::class,'destroy'])->name('carts.destroy');
        //------------------------------------------------------------------------------------------ 
        //-Checkout Routes
        Route::get('checkout/index',[CheckoutController::class,'index'])->name('checkout.index');
        Route::post('checkout/store',[CheckoutController::class,'store'])->name('checkout.store');
        //------------------------------------------------------------------------------------------ 
        //-Profile Routes
        Route::put('profile/update',[ProfileController::class,'update'])->name('profile.update');
        Route::get('profile',[ProfileController::class,'index'])->name('profile.index');
        //------------------------------------------------------------------------------------------ 
        //-Order Routes
        Route::get('orders/show/{id}',[OrderController::class,'show'])->name('orders.show');
        Route::post('refunds', [RefundController::class, 'store'])->name('refunds.store');
        //------------------------------------------------------------------------------------------ 
        //-Country Routes
        Route::get('countries/show/{id}',[CountryController::class,'show'])->name('countries.show');
        //------------------------------------------------------------------------------------------ 
        //-Address Routes
        Route::resource('addresses',AddressController::class);
    });
    //****************************************-:END:-****************************************/


    
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

