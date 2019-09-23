<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
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
        view()->composer('mod.games.result.edit', 'App\Http\ViewComposers\GameComposer@inputScorersForGame');

        view()->composer('admin.predictions.form', 'App\Http\ViewComposers\UserComposer@inputUsers');
        view()->composer('admin.predictions.form', 'App\Http\ViewComposers\GameComposer@inputGames');
        view()->composer('admin.predictions.form', 'App\Http\ViewComposers\GameComposer@inputScorers');

        view()->composer('admin.predictions.create-for-round', 'App\Http\ViewComposers\UserComposer@inputUsers');
        view()->composer('admin.predictions.create-for-round', 'App\Http\ViewComposers\GameComposer@inputGames');
        view()->composer('admin.predictions.create-for-round', 'App\Http\ViewComposers\GameComposer@inputScorers');

    }
}
