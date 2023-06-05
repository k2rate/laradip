<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Models\Product;
use App\View\Components\ProductCard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $productsInBucketCount = basket_count();
            $bucket = basket_full();

            $view->with('bucket', $bucket)->with('productsInBucketCount', $productsInBucketCount);
        });

        Blade::component('product-card', ProductCard::class);

        // View::share('bucket', $bucket);
        // View::share('isAdmin', false);      
    }
}