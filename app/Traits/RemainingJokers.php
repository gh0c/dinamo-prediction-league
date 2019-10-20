<?php

namespace App\Traits;


use App\Models\Games\Season;
use App\Models\Repositories\Predictions;
use App\Models\Users\User;

/**
 * Trait RemainingJokers
 * @package App\Traits
 * @property Predictions $predictions
 */
trait RemainingJokers
{
    protected $predictions;

    public function __construct()
    {
        $this->predictions = new Predictions();
    }

    /**
     * @param  User $user
     * @return int|mixed
     */
    public function getRemainingJokersForUser(User $user)
    {
        $activeSeason = Season::active();

        $results = $this->predictions->getOverallResults($activeSeason);

        // Find grouped outcomes for authenticated user (overall score)
        $overallScore = $results->first(function ($result) use ($user) {
            /** @var $result \App\Models\Predictions\PredictionOutcome */
            return $result->user_id == $user->id;
        });

        if ($overallScore === null) {
            return $activeSeason->jokers_available;
        }

        return $activeSeason->jokers_available - $overallScore->jokers_used;
    }
}