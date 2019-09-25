<?php

namespace App\Http\Controllers;

use App\Models\Games\Season;
use App\Models\Repositories\Disqualifications;
use App\Models\Repositories\Predictions;

/**
 * Class ResultsController
 * @package App\Http\Controllers
 * @property Predictions $predictions
 * @property Disqualifications $disqualifications
 */
class ResultsController
{
    protected $predictions;
    protected $disqualifications;

    public function __construct(Predictions $predictions, Disqualifications $disqualifications)
    {
        $this->predictions = $predictions;
        $this->disqualifications = $disqualifications;
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
        // Disqualified users for season
        $disqualifications = $this->disqualifications->loadAllDisqualifications($season);

        return view('results.overall-results', compact('results', 'disqualifications', 'season', 'rounds'));
    }

    public function showRoundResults(Season $season, $round)
    {
        $results = $this->predictions->getRoundResults($round, $season);

        return view('results.round-results', compact('results', 'round', 'season'));
    }
}