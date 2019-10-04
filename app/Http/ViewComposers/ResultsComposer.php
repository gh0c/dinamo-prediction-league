<?php

namespace App\Http\ViewComposers;

use App\Exceptions\SeasonException;
use App\Models\Games\Season;
use App\Models\Repositories\Predictions;
use Illuminate\Contracts\View\View;

/**
 * Class ResultsComposer
 * @package App\Http\ViewComposers
 * @property Predictions $predictions
 */
class ResultsComposer
{
    protected $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;
    }

    /**
     * @param View $view
     * @throws SeasonException
     */
    public function personalStats(View $view)
    {
        $activeSeason = Season::active();
        if (!$activeSeason) {
            throw SeasonException::activeSeasonNotFound();
        }

        $results = $this->predictions->getOverallResults($activeSeason);

        // Find grouped outcomes for user (overall score)
        $overallScore = $results->first(function ($result) {
            /** @var $result \App\Models\Predictions\PredictionOutcome */
            return $result->user_id == \Auth::user()->id;
        });

        if ($overallScore === null) {

            $view->with([
                'personalStats' => [
                    'overallScore'     => $overallScore,
                ],
            ]);

        } else {
            // Find position
            $position = $results->search(function ($result) {
                /** @var $result \App\Models\Predictions\PredictionOutcome */
                return $result->user_id == \Auth::user()->id;
            });

            if ($position !== false) {
                $position++; // collection is 0-indexed
            }

            $view->with([
                'personalStats' => [
                    'overallScore'     => $overallScore,
                    'position'         => $position,
                    'remaining_jokers' => $activeSeason->jokers_available - $overallScore->jokers_used
                ],
            ]);
        }


    }
}