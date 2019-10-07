<?php

namespace App\Http\ViewComposers;

use App\Exceptions\SeasonException;
use App\Models\Games\Season;
use App\Models\Repositories\Predictions;
use App\Models\Users\Disqualification;
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

        list($overallScore, $position) = $this->predictions->getOverallScoreAndPositionForUser(\Auth::user(), $activeSeason);

        if ($overallScore === null) {

            // Check if user is disqualified
            $disqualification = Disqualification::whereSeasonId($activeSeason->id)
                ->where('user_id', \Auth::user()->id)->first();

            $view->with([
                'personalStats' => [
                    'overallScore'     => $overallScore,
                    'disqualification' => $disqualification
                ],
            ]);

        } else {

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