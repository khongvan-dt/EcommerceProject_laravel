<?php

namespace App\Providers;
use App\Models\Discounts;
use App\Observers\DiscountObserver;
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
        Discounts::observe(DiscountObserver::class);
    }
}
