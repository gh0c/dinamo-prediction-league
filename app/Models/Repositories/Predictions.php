<?php

namespace App\Models\Repositories;

use App\Models\Games\Game;
use App\Models\Games\Season;
use App\Models\Predictions\Prediction;
use App\Models\Predictions\PredictionOutcome;
use DB;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

/**
 * Class Predictions
 * @package App\Models\Repositories
 * @property PointsCalculator $pointsCalculator
 */
class Predictions
{
    protected $pointsCalculator;

    public function __construct()
    {
        $this->pointsCalculator = new PointsCalculator();
    }

    /**
     * @param  Season $season
     * @return Prediction[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Builder[]|\Illuminate\Support\Collection
     */
    public function loadAllPredictions($season)
    {
        return Prediction::with([
            'user:id,username', 'firstScorer',
            'game.homeTeam', 'game.awayTeam', 'game.goalScorers.player', 'game.result',
        ])
            ->leftJoin('games', 'games.id', '=', 'predictions.game_id')
            ->leftJoin('users', 'users.id', '=', 'predictions.user_id')
            ->where('games.season_id', '=', $season->id)
            ->orderBy('games.round')
            ->orderBy('games.datetime')
            ->orderBy('users.username')
            ->select('predictions.*')
            ->get();
    }

    /**
     * @return Prediction[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Builder[]|\Illuminate\Support\Collection
     */
    public function loadAllPredictionsInActiveSeason()
    {
        return $this->loadAllPredictions(Season::active());
    }

    /**
     * @param  int|string $round
     * @param  Season $season
     * @return Prediction[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Builder[]|\Illuminate\Support\Collection
     */
    public function loadPredictionsForRound($round, $season)
    {
        return Prediction::with([
            'user:id,username', 'firstScorer',
            'game.homeTeam', 'game.awayTeam', 'game.goalScorers.player', 'game.result',
        ])
            ->leftJoin('games', 'games.id', '=', 'predictions.game_id')
            ->leftJoin('users', 'users.id', '=', 'predictions.user_id')
            ->where('games.season_id', '=', $season->id)->where('games.round', '=', $round)
            ->orderBy('games.datetime')
            ->orderBy('users.username')
            ->select('predictions.*')
            ->get();
    }

    /**
     * @param  int|string $round
     * @return Prediction[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Builder[]|\Illuminate\Support\Collection
     */
    public function loadPredictionsForRoundInActiveSeason($round)
    {
        return $this->loadPredictionsForRound($round, Season::active());
    }

    /**
     * @param  int|string $round
     * @param  bool $updateTables
     * @throws \Exception
     */
    public function setPredictionOutcomesForRoundInActiveSeason($round, $updateTables = true)
    {
        $this->setPredictionOutcomesForRound($round, Season::active(), $updateTables);
    }

    /**
     * @param  int|string $round
     * @param  Season $season
     * @return PredictionOutcome[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Builder[]|\Illuminate\Support\Collection
     */
    public function getRoundResults($round, $season)
    {
        $results = PredictionOutcome::whereRound($round)->where('season_id', '=', $season->id)
            ->leftJoin('users', 'prediction_outcomes.user_id', '=', 'users.id')
            ->orderBy('total_points', 'desc')->orderBy('points', 'desc')->orderBy('users.username')
            ->with('user')
            ->get('prediction_outcomes.*');

        return $results;

    }

    /**
     * @param  Season $season
     * @return PredictionOutcome[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Builder[]|\Illuminate\Support\Collection
     */
    public function getOverallResults($season)
    {
        $results = PredictionOutcome::whereSeasonId($season->id)
            // Ignore disqualified users
            ->whereHas('user', function ($query) use ($season) {
                /** @var Builder|\Illuminate\Database\Eloquent\Builder $query */
                $query->whereDoesntHave('disqualifications', function ($query) use ($season) {
                    /** @var Builder|\Illuminate\Database\Eloquent\Builder $query */
                    $query->where('season_id', '=', $season->id);
                });
            })
            ->leftJoin('users', 'prediction_outcomes.user_id', '=', 'users.id')
            ->groupBy(['user_id', 'users.username'])
            ->orderByRaw('SUM(total_points) desc')
//            ->orderByRaw('SUM(points) desc')
            ->orderBy('users.username')
            ->with('user.predictionOutcomes')
            ->get([
                'prediction_outcomes.user_id',
                \DB::raw('sum(prediction_outcomes.points) as points'),
                \DB::raw('sum(prediction_outcomes.bonus_points) as bonus_points'),
                \DB::raw('sum(prediction_outcomes.total_points) as total_points'),
                \DB::raw('sum(prediction_outcomes.jokers_used) as jokers_used'),
            ]);

        return $results;

    }

    /**
     * @param  Season $season
     * @return PredictionOutcome[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Builder[]|\Illuminate\Support\Collection
     */
    public function getRoundsWithOutcomeForSeason($season)
    {
        return PredictionOutcome::whereSeasonId($season->id)
            ->orderBy('round')
            ->select('round')
            ->distinct()
            ->pluck('round');
    }

    /**
     * @param  Season $season
     * @return array
     */
    public function getRoundsWithGamesForSeason($season)
    {
        return Game::whereSeasonId($season->id)
            ->groupBy('round')
            ->orderBy('round')
            ->select(['round', \DB::raw('COUNT(*) as games_per_round')])
            ->get()->toArray();
    }

    /**
     * @return array
     */
    public function getRoundsWithGamesForActiveSeason()
    {
        return $this->getRoundsWithGamesForSeason(Season::active());
    }

    /**
     * @param  int|string $round
     * @param  Season $season
     * @param  bool $updateTables
     * @throws Exception
     */
    public function setPredictionOutcomesForRound($round, $season, $updateTables = true)
    {
        DB::beginTransaction();
        try {

            if ($updateTables == true) {
                $this->clearPredictionOutcomesForRound($round, $season);
            }

            // Find all games for the given round
            // Find all predictions for all the games
            // Determine outcome of each prediction


            $predictions = Prediction::whereHas('game', function ($query) use ($round) {
                /** @var Builder|\Illuminate\Database\Eloquent\Builder $query */
                $query->where('round', '=', $round)->whereHas('result');
            })->with(['game.goalScorers.player', 'game.result'])->get();

            if ($predictions->isEmpty()) {
                return;
            }

            // Store user points for the given round
            // User(s) with the most points will receive extra bonus points
            $userPoints = [];

            $gamesInRound = $predictions->groupBy('game_id')->count();
            if ($gamesInRound == 1) {
                $bonus = 0;
            } elseif ($gamesInRound == 2) {
                $bonus = 2;
            } elseif ($gamesInRound == 3) {
                $bonus = 4;
            } elseif ($gamesInRound > 3) {
                $bonus = 5;
            } else {
                $bonus = 0;
            }

            // Store number of jokers used per user
            $userJokers = [];

            foreach ($predictions->groupBy('game_id') as $gameId => $gamePredictions) {
                /** @var Collection|Prediction[] $gamePredictions */
                $game = $gamePredictions->first()->game; // Game::find($gameId);

                if ($game->result) {

                    foreach ($gamePredictions as $prediction) {
                        /** @var Prediction $prediction */

                        $points = $this->pointsCalculator->calculatePointsForPrediction($prediction, $game);

                        if ($updateTables == true) {
                            $prediction->points = $points;
                            $prediction->save();
                        }

                        if (!array_key_exists($prediction->user_id, $userPoints)) {
                            $userPoints[$prediction->user_id] = $points;
                        } else {
                            $userPoints[$prediction->user_id] += $points;
                        }

                        // Initialize user jokers
                        if (!array_key_exists($prediction->user_id, $userJokers)) {
                            $userJokers[$prediction->user_id] = 0;
                        }
                        if ($prediction->joker_used) {
                            $userJokers[$prediction->user_id] += 1;
                        }

                    }
                }
            }

            $maxPoints = max($userPoints);


            if ($updateTables) {
                // Store round prediction outcomes

                foreach ($userPoints as $userId => $points) {

                    // Award user(s) who scored max points with bonus points
                    $bonusPoints = ($points == $maxPoints) ? $bonus : 0;

                    $outcome = new PredictionOutcome([
                        'user_id'      => $userId,
                        'round'        => $round,
                        'points'       => $points,
                        'bonus_points' => $bonusPoints,
                        'total_points' => $points + $bonusPoints,
                        'jokers_used'  => $userJokers [$userId],
                        'season_id'    => $season->id,
                    ]);
                    $outcome->save();
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param  int|string $round
     * @param  Season $season
     */
    private function clearPredictionOutcomesForRound($round, $season)
    {
        // Clear points from predictions belonging to games which took place in round $round
        Prediction::whereHas('game', function ($query) use ($round, $season) {
            /** @var Builder $query */
            $query->where('round', '=', $round)->where('season_id', '=', $season->id);
        })->update([
            'points' => null
        ]);

        // Delete prediction outcomes
        PredictionOutcome::where('round', '=', $round)->where('season_id', '=', $season->id)->delete();
    }

}
