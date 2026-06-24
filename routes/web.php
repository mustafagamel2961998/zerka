<?php
use Illuminate\Support\Facades\Route;


Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('errors/fallback',function(){
    return view('error.fallback');
})->name('errors.fallback.index');

Route::get('errors/too-many-request',function(){
    return view('error.too-many-request');
})->name('errors.too-many-request.index');



// Dashboard Routes
require __DIR__ . '/dashboard/web.php';

// Front Routes
require __DIR__ . '/front/web.php';
