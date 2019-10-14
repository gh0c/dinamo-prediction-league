<?php

namespace App\Models\Repositories;

use App\Models\Games\Game;
use App\Models\Games\Player;
use App\Models\Games\Season;
use Illuminate\Support\Collection;

class Games
{

    /**
     * @param  Season $season
     * @return array
     */
    public function loadGamesForSeason(Season $season)
    {
        $games = Game::with(['homeTeam', 'awayTeam'])
            ->where('season_id', '=', $season->id)
            ->orderBy('round')->orderBy('datetime')
            ->get();

        return $this->composeGamesGroupedByRound($games);
    }

    /**
     * @return array
     */
    public function loadGamesForActiveSeasons()
    {
        return $this->loadGamesForSeason(Season::active());
    }

    /**
     * @param  int|string $round
     * @param  Season $season
     * @return Game[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection
     */
    public function loadGamesForRoundForSeason($round, $season)
    {
        return Game::whereSeasonId($season->id)->where('round', $round)
            ->with(['homeTeam', 'awayTeam', 'season', 'competition'])
            ->orderBy('datetime')->orderBy('competition_id')
            ->get();
    }

    /**
     * @return array
     */
    public function loadPlayers()
    {
        $players = Player::realPlayers()
            ->with('team')
            ->orderBy('name')->get();

        return $this->composePlayersForOutput($players);
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
     * @param  Collection|Games[] $games
     * @return array
     */
    private function composeGamesGroupedByRound($games)
    {
        $inputGames = [];

        foreach ($games as $game) {
            /** @var Game $game */
            $round = $game->round . '. ' . mb_strtolower(__('models.games.game._attributes.round'));
            if (!isset($inputGames[$round])) {
                $inputGames[$round] = [];
            }
            $inputGames[$round][$game->id] = $game->game_description;
        }

        return $inputGames;
    }

    /**
     * @param  Collection|Player[] $players
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