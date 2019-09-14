<?php

namespace App\Http\ViewComposers;

use App\Models\Games\Game;
use App\Models\Games\Player;
use Illuminate\Contracts\View\View;

class GameComposer
{
    public function inputPlayersForGame(View $view)
    {
        /** @var Game $game */
        $game = request()->route()->parameter('game');

        $inputPlayers = [];

        $players = Player::with('team')
            ->whereIn('team_id', [$game->home_team_id, $game->away_team_id])
            ->orderBy('name')
            ->get();

        foreach ($players as $inputPlayer) {
            if (!isset($inputPlayers[$inputPlayer->team->name])) {
                $inputPlayers[$inputPlayer->team->name] = [];
            }
            $inputPlayers[$inputPlayer->team->name][$inputPlayer->id] = $inputPlayer->name;
        }

        $inputPlayers = ['' => __('forms.mod.games.goal_scorer.placeholder')] + $inputPlayers;

        $view->with([
            'inputPlayers' => $inputPlayers,
        ]);
    }
}