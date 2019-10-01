<?php

namespace App\Http\Controllers;

use App\Exceptions\SeasonException;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Exceptions\SeasonException
     */
    public function showOverallResultsForActiveSeason()
    {
        return $this->showOverallResults(Season::active());
    }

    /**
     * @param Season $season
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Exceptions\SeasonException
     */
    public function showOverallResults(Season $season)
    {
        if (!$season) {
            throw SeasonException::activeSeasonNotFound();
        }
        $results = $this->predictions->getOverallResults($season);
        // Rounds for season
        $rounds = $this->predictions->getRoundsWithOutcomeForSeason($season);
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
