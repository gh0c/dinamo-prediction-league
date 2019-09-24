<?php

namespace App\Http\Controllers;

use App\Models\Games\Season;
use App\Repositories\Predictions;

/**
 * Class ResultsController
 * @package App\Http\Controllers
 * @property Predictions $predictions
 */
class ResultsController
{
    protected $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;
    }

    public function showOverallResultsForActiveSeason()
    {
        return $this->showOverallResults(Season::active());
    }

    public function showOverallResults(Season $season)
    {
        $results = $this->predictions->getOverallResults($season);
        // Rounds for season
        $rounds = $this->predictions->getRoundsForSeason($season);

        return view('results.overall-results', compact('results', 'season', 'rounds'));
    }

    public function showRoundResults(Season $season, $round)
    {
        $results = $this->predictions->getRoundResults($round, $season);

        return view('results.round-results', compact('results', 'round', 'season'));
    }
}