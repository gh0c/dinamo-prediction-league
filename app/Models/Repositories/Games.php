<?php

namespace App\Models\Repositories;

use App\Models\Games\Game;
use App\Models\Games\Player;
use Illuminate\Support\Collection;

class Games
{

    /**
     * @return array
     */
    public function loadGames()
    {
        $games = Game::with(['homeTeam', 'awayTeam'])
            ->orderBy('round')->orderBy('datetime')
            ->get();

        $inputGames = [];

        foreach ($games as $game) {
            /** @var Game $game */
            $round = $game->round . '. ' . mb_strtolower(__('models.games.game._attributes.round'));
            if (!isset($inputGames[$round])) {
                $inputGames[$round] = [];
            }
            $inputGames[$round][$game->id] = $game->game_description;
        }

        $inputGames = ['' => __('forms.admin.predictions.game.placeholder')] + $inputGames;

        return $inputGames;
    }

    /**
     * @return array
     */
    public function loadPlayers()
    {
        $players = Player::realPlayers()
            ->with('team')
            ->orderBy('name')->get();

        $inputPlayers = $this->composePlayersForOutput($players);

        return $inputPlayers;
    }

    /**
     * @param  Game $game
     * @return array
     */
    public function loadPlayersForGame(Game $game)
    {
        $players = Player::realPlayers()
            ->with('team')
            ->whereIn('team_id', [$game->home_team_id, $game->away_team_id])
            ->orderBy('name')
            ->get();

        $inputPlayers = $this->composePlayersForOutput($players);

        return $inputPlayers;
    }

    /**
     * @param Collection|Player[] $players
     * @return array
     */
    private function composePlayersForOutput($players)
    {
        $inputPlayers = [];

        // Group by team
        foreach ($players as $inputPlayer) {
            if (!isset($inputPlayers[$inputPlayer->team->name])) {
                $inputPlayers[$inputPlayer->team->name] = [];
            }
            $inputPlayers[$inputPlayer->team->name][$inputPlayer->id] = $inputPlayer->name;
        }

        // Add own goal scorer to the bottom
        $ownGoalScorer = Player::ownGoalScorer();
        $inputPlayers['-'][$ownGoalScorer->id] = $ownGoalScorer->name;

        $inputPlayers = ['' => __('forms.mod.games.goal_scorer.placeholder')] + $inputPlayers;

        return $inputPlayers;
    }

}