<?php

namespace App\Http\ViewComposers;

use App\Models\Games\Competition;
use App\Models\Games\Game;
use App\Models\Games\Season;
use App\Models\Repositories\Games;
use App\Models\Team;
use Illuminate\Contracts\View\View;

/**
 * Class GameComposer
 * @package App\Http\ViewComposers
 * @property Games $games
 */
class GameComposer
{
    protected $games;

    public function __construct(Games $games)
    {
        $this->games = $games;
    }

    public function inputScorersForGame(View $view)
    {
        /** @var Game $game */
        $game = request()->route()->parameter('game');

        $view->with([
            'inputScorers' => $this->games->loadPlayersForGame($game),
        ]);
    }

    public function inputGames(View $view)
    {
        $view->with([
            'inputGames' => $this->games->loadGames(),
        ]);
    }

    public function inputScorers(View $view)
    {
        $view->with([
            'inputScorers' => $this->games->loadPlayers()
        ]);
    }

    public function inputSports(View $view)
    {
        $view->with([
            'inputSports' => [
                ''         => 'Sport',
                'football' => __('models.games.sport._values.football'),
                'futsal'   => __('models.games.sport._values.futsal'),
            ],
        ]);
    }

    public function inputCompetitions(View $view)
    {
        $inputCompetitions = ['' => __('forms.mod.games.competition.placeholder')] +
            Competition::orderBy('sport')->orderBy('name')->pluck('name', 'id')->all();

        $view->with([
            'inputCompetitions' => $inputCompetitions
        ]);
    }

    public function inputSeasons(View $view)
    {
        $inputSeasons = ['' => __('forms.mod.games.season.placeholder')] +
            Season::orderBy('name')->pluck('name', 'id')->all();

        $view->with([
            'inputSeasons' => $inputSeasons
        ]);
    }

    public function inputTeams(View $view)
    {
        $inputTeams = ['' => __('forms.mod.players.team.placeholder')] + $this->inputTeamsArray();

        $view->with([
            'inputTeams' => $inputTeams
        ]);
    }

    public function inputHomeTeams(View $view)
    {
        $inputTeams = ['' => __('forms.mod.games.home_team.placeholder')] + $this->inputTeamsArray();

        $view->with([
            'inputHomeTeams' => $inputTeams
        ]);
    }

    public function inputAwayTeams(View $view)
    {
        $inputTeams = ['' => __('forms.mod.games.away_team.placeholder')] + $this->inputTeamsArray();

        $view->with([
            'inputAwayTeams' => $inputTeams
        ]);
    }

    protected function inputTeamsArray()
    {
        return Team::orderBy('sport')->orderBy('name')->pluck('name', 'id')->all();
    }
}