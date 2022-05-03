<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Observers\ProductImageObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

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
        ProductImage::observe(ProductImageObserver::class);
        Product::observe(ProductObserver::class);
    }
}
