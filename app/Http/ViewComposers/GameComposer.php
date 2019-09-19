<?php

namespace App\Http\ViewComposers;

use App\Models\Games\Game;
use App\Models\Repositories\Games;
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

}