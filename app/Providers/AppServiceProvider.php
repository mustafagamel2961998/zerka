<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            return [
                Limit::perMinute(2),                        
                Limit::perHour(100)
                ->by($request->input('login') ?: $request->ip())
                ->response(function () {
                        return response()->json([
                            'message' => __('auth.throttle')
                        ], 429);
                    }),
            ];
        });

        
        Paginator::useBootstrapFive();
    }
}
