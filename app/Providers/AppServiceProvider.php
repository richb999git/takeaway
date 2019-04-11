<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;  // I added this in to fix error: 1071 Specified key was too long; max key length is 767 bytes
use Illuminate\Support\Facades\URL; // I added this based on https://dev.to/connor11528/deploy-a-laravel-5-app-to-heroku

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
        // I added this in to fix error: 1071 Specified key was too long; max key length is 767 bytes
        Schema::defaultStringLength(191);

        // not sure if the below is correct or in the correct method
        // I added this based on https://dev.to/connor11528/deploy-a-laravel-5-app-to-heroku
        // Force SSL in production
        if ($this->app->environment() == 'production') {
            URL::forceScheme('https');
        }

    }
}
