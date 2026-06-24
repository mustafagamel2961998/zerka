<?php

namespace App\Providers;

use App\Repositories\Contracts\Auth\AuthRepositoryInterface;
use App\Repositories\Eloquent\Auth\AuthEloquentRepository;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\Repositories\Eloquent\Country\CountryEloquentRepository;
use App\Repositories\Contracts\Currency\CurrencyRepositoryInterface;
use App\Repositories\Eloquent\Currency\CurrencyEloquentRepository;
use App\Repositories\Contracts\City\CityRepositoryInterface;
use App\Repositories\Eloquent\City\CityEloquentRepository;
use App\Repositories\Contracts\Category\CategoryRepositoryInterface;
use App\Repositories\Eloquent\Category\CategoryEloquentRepository;
use App\Repositories\Contracts\Color\ColorRepositoryInterface;
use App\Repositories\Eloquent\Color\ColorEloquentRepository;
use App\Repositories\Contracts\Size\SizeRepositoryInterface;
use App\Repositories\Eloquent\Size\SizeEloquentRepository;
use App\Repositories\Contracts\Warehouse\WarehouseRepositoryInterface;
use App\Repositories\Eloquent\Warehouse\WarehouseEloquentRepository;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use App\Repositories\Eloquent\Product\ProductEloquentRepository;
use App\Repositories\Contracts\Variant\VariantRepositoryInterface;
use App\Repositories\Eloquent\Variant\VariantEloquentRepository;
use App\Repositories\Contracts\Order\OrderRepositoryInterface;
use App\Repositories\Eloquent\Order\OrderEloquentRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Observers\Warehouse\WarehouseObserver;
use App\Observers\Product\ProductObserver;
use App\Models\Warehouse;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class,AuthEloquentRepository::class);
        $this->app->bind(CountryRepositoryInterface::class,CountryEloquentRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class,CurrencyEloquentRepository::class);
        $this->app->bind(CityRepositoryInterface::class,CityEloquentRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryEloquentRepository::class);
        $this->app->bind(ColorRepositoryInterface::class,ColorEloquentRepository::class);
        $this->app->bind(SizeRepositoryInterface::class,SizeEloquentRepository::class);
        $this->app->bind(WarehouseRepositoryInterface::class,WarehouseEloquentRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductEloquentRepository::class);
        $this->app->bind(VariantRepositoryInterface::class,VariantEloquentRepository::class);
        $this->app->bind(OrderRepositoryInterface::class,OrderEloquentRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            return [
                Limit::perMinute(5),                        
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

        // observe
        Warehouse::observe(WarehouseObserver::class);
        Product::observe(ProductObserver::class);
    }
}
