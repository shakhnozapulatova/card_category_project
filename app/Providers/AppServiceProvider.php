<?php

namespace App\Providers;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Admin\ProductsController as AdminProductsController;
use App\Queries\Product\ProductQuery;
use App\Queries\Product\EloquentProductQueries;
use Illuminate\Support\Facades\Schema;
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
        $this->app->when([ProductsController::class, AdminProductsController::class])
            ->needs(ProductQuery::class)
            ->give(function() {
                $with = \request()->get('with', []);

                return new EloquentProductQueries((array) $with);
            });;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
