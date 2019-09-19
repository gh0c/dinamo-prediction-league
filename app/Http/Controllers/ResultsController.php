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

    public function showRoundResults(Season $season, $round)
    {
        $results = $this->predictions->getRoundResults($round, $season);

        return view('results.round-results', compact('results', 'round', 'season'));
    }
}