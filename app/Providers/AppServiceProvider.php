<?php

namespace App\Providers;

use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\Repositories\Eloquent\Country\CountryEloquentRepository;
use App\Repositories\Contracts\Currency\CurrencyRepositoryInterface;
use App\Repositories\Eloquent\Currency\CurrencyEloquentRepository;
use App\Repositories\Eloquent\City\CityEloquentRepository;
use App\Repositories\Contracts\City\CityRepositoryInterface;
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
        $this->app->bind(CountryRepositoryInterface::class,CountryEloquentRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class,CurrencyEloquentRepository::class);
        $this->app->bind(CityRepositoryInterface::class,CityEloquentRepository::class);

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
