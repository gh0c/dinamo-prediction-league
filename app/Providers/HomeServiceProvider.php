<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HomeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('home.predictions.form', 'App\Http\ViewComposers\GameComposer@inputScorers');
    }
}
