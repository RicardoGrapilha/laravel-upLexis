<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\UserRepositoryInterface',
            'App\Repository\UserRepository'
        );

        $this->app->bind(
            'App\Repository\SintegraRepositoryInterface',
            'App\Repository\SintegraRepository'
        );
    }
}