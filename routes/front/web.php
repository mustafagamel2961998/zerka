<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Front\V1\Auth\AuthController;
use App\Http\Controllers\Web\Front\V1\Home\HomeController;
use App\Http\Controllers\Web\Front\V1\Product\ProductController;
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
    //-Cart Routes 
    Route::post('/cart/add',function(){
      return response()->json([
        "success"=> true,
        "message"=> "تمت الإضافة إلى السلة",
        "cart"=> [
            "count"=> 3,
            "subtotal_formatted"=> "EGP 675.00",
            "items"=> [

                     [
                        "id" => 101,
                        "product_name" => "Oversized Hoodie",
                        "product_image" => "https://site.com/storage/hoodie.jpg",
                        "size" => "L",
                        "color" => ["code" => "#000000", "name" => "Black"],
                        "quantity" => 2,
                        "line_total_formatted" => "EGP 450.00",
                    ],
                ]
              ]
            ]);
    })->name('carts.store');


    
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

