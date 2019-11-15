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

    /**
     * ResultsController constructor.
     * @param  Predictions $predictions
     * @param  Disqualifications $disqualifications
     */
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
        $season = Season::active();
        if (!$season) {
            throw SeasonException::activeSeasonNotFound();
        }
        return $this->showOverallResults($season);
    }

    /**
     * @param  Season $season
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOverallResults(Season $season)
    {
        $results = $this->predictions->getOverallResults($season);
        // Rounds for season
        $rounds = $this->predictions->getRoundsWithOutcomeForSeason($season);
        // Disqualified users for season
        $disqualifications = $this->disqualifications->loadAllDisqualifications($season);

        return view('results.overall-results', compact('results', 'disqualifications', 'season', 'rounds'));
    }

    /**
     * @param  Season $season
     * @param  int|string $round
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRoundResults(Season $season, $round)
    {
        $results = $this->predictions->getRoundResults($round, $season);

        return view('results.round-results', compact('results', 'round', 'season'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws SeasonException
     */
    public function dashboardByRound()
    {
        $season = Season::active();
        if (!$season) {
            throw SeasonException::activeSeasonNotFound();
        }

        $rounds = $this->predictions->getRoundsWithOutcomeForSeason($season);

        return view('results.dashboard', compact('season', 'rounds'));

    }
}
