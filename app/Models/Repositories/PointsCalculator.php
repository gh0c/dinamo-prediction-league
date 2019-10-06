<?php

namespace App\Models\Repositories;

use App\Models\Games\Game;
use App\Models\Games\Result;
use App\Models\Predictions\Prediction;

class PointsCalculator
{
    /**
     * @param  Prediction $prediction
     * @param  Game $game
     * @return int
     */
    public function calculatePointsForPrediction($prediction, $game)
    {
        // Exact score: 3 PTS
        // Correct outcome: 1 PT
        // Joker:
        // - exact score: 10 PTS
        // - correct outcome: 0
        // - missed outcome: -10 PTS


        // When joker is used, first goal scorer is not taken into account

        if ($prediction->joker_used) {

            if ($this->exactScoreGuessed($prediction, $game->result)) {
                return 10;
            } elseif ($this->outcomeGuessed($prediction, $game->result)) {
                return 0;
            } else {
                return -10;
            }

        } else {

            if ($this->exactScoreGuessed($prediction, $game->result)) {
                $points = 3;
            } elseif ($this->outcomeGuessed($prediction, $game->result)) {
                $points = 1;
            } else {
                $points = 0;
            }

            return $points + $this->calculatePointsForScorer($prediction, $game);
        }

    }

    /**
     * @param  Prediction $prediction
     * @param  Result $result
     * @return bool
     */
    private function outcomeGuessed($prediction, $result)
    {
        if ($result->home_team_score > $result->away_team_score) {
            // Home team won
            if ($prediction->home_team_score > $prediction->away_team_score) {
                return true;
            } else {
                return false;
            }
        } elseif ($result->home_team_score < $result->away_team_score) {
            // Away team won
            if ($prediction->home_team_score < $prediction->away_team_score) {
                return true;
            } else {
                return false;
            }
        } else {
            // Draw
            if ($prediction->home_team_score == $prediction->away_team_score) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @param  Prediction $prediction
     * @param  Result $result
     * @return bool
     */
    private function exactScoreGuessed($prediction, $result)
    {
        return $prediction->home_team_score == $result->home_team_score &&
            $prediction->away_team_score == $result->away_team_score;
    }

    /**
     * @param  Prediction $prediction
     * @param  Game $game
     * @return int
     */
    private function calculatePointsForScorer($prediction, $game)
    {
        // Award 2 points for scorer of the first goal guessed
        // Award 2 points also if exact score 0:0 was guessed
        // Award 1 point if predicted first goal scorer scored later in the game

        if ($prediction->home_team_score == 0 && $prediction->away_team_score == 0) {
            if ($game->home_team_score == 0 && $game->away_team_score == 0) {
                return 2;
            } else {
                return 0;
            }
        } else {
            // Handle situations where first goal scorer was not guessed at all
            if (!$prediction->first_scorer_id) {
                return 0;
            }

            // Handle situations where game ended without scored goals
            if ($game->goalScorers->isEmpty()) {
                return 0;
            }

            if ($prediction->first_scorer_id == $game->first_scorer->id) {
                return 2;
            } elseif ($game->goalScorers->contains('player_id', '=', $prediction->first_scorer_id)) {
                return 1;
            } else {
                return 0;
            }
        }

    }
}