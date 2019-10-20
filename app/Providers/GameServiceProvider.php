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
        view()->composer('admin.competitions.form', 'App\Http\ViewComposers\GameComposer@inputSports');

        view()->composer('admin.disqualifications.form', 'App\Http\ViewComposers\UserComposer@inputUsers');
        view()->composer('admin.disqualifications.form', 'App\Http\ViewComposers\GameComposer@inputSeasons');
        view()->composer('admin.disqualifications.form', 'App\Http\ViewComposers\UserComposer@inputDisqualificationReasons');

        view()->composer('admin.predictions.form', 'App\Http\ViewComposers\UserComposer@inputUsers');
        view()->composer('admin.predictions.form', 'App\Http\ViewComposers\GameComposer@inputGamesForSeason');
        view()->composer('admin.predictions.form', 'App\Http\ViewComposers\GameComposer@inputScorers');

        view()->composer('admin.predictions.create-for-round', 'App\Http\ViewComposers\UserComposer@inputUsers');
        view()->composer('admin.predictions.create-for-round', 'App\Http\ViewComposers\GameComposer@inputGamesForSeason');
        view()->composer('admin.predictions.create-for-round', 'App\Http\ViewComposers\GameComposer@inputScorers');

        view()->composer('home.predictions.create-for-round', 'App\Http\ViewComposers\GameComposer@inputGamesForSeason');
        view()->composer('home.predictions.create-for-round', 'App\Http\ViewComposers\GameComposer@inputScorers');



        view()->composer('mod.games.form', 'App\Http\ViewComposers\GameComposer@inputCompetitions');
        view()->composer('mod.games.form', 'App\Http\ViewComposers\GameComposer@inputSeasons');
        view()->composer('mod.games.form', 'App\Http\ViewComposers\GameComposer@inputHomeTeams');
        view()->composer('mod.games.form', 'App\Http\ViewComposers\GameComposer@inputAwayTeams');

        view()->composer('mod.players.form', 'App\Http\ViewComposers\GameComposer@inputTeams');

        view()->composer('mod.games.result.edit', 'App\Http\ViewComposers\GameComposer@inputScorersForGame');

        view()->composer('mod.teams.form', 'App\Http\ViewComposers\GameComposer@inputSports');
    }
}
