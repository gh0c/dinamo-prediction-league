<?php

namespace App\Http\Controllers;

use App\Http\Requests\Filters\FilterScorersByGameRequest;
use App\Models\Games\Game;
use App\Models\Repositories\Games;

/**
 * Class FilteringController
 * @package App\Http\Controllers
 * @property Games $games
 */
class FilteringController
{
    protected $games;

    public function __construct(Games $games)
    {
        $this->games = $games;
    }


    /**
     * @param  FilterScorersByGameRequest $request
     * @return array|string
     * @throws \Throwable
     */
    public function filterScorersByGame(FilterScorersByGameRequest $request)
    {
        $game = Game::find($request->input('game_id'));

        if ($game) {
            $inputPlayers = $this->games->loadPlayersForGame($game);
        } else {
            $inputPlayers = $this->games->loadPlayers();
        }

        return view('filters.filter.scorers-by-game._scorers', ['inputScorers' => $inputPlayers])->render();
    }
}