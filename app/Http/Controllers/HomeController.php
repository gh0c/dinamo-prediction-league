<?php

namespace App\Http\Controllers;

use App\Exceptions\GameException;
use App\Exceptions\SeasonException;
use App\Models\Games\Game;
use App\Models\Games\Season;
use App\Models\Repositories\Games;
use App\Models\Repositories\Predictions;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @property Games $games
 * @property Predictions $predictions
 */
class HomeController extends Controller
{
    protected $games;
    protected $predictions;

    public function __construct(Games $games, Predictions $predictions)
    {
        $this->games = $games;
        $this->predictions = $predictions;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws SeasonException
     * @throws \Exception
     */
    public function index()
    {
        $season = Season::active();
        if (!$season) {
            throw SeasonException::activeSeasonNotFound();
        }

        // Determine and group rounds
        // a) Next round(s)
        // b) Current round(s)
        // c) Previous round(s)

        // a) - The first game in the round hasn't started yet and predictions for it are still open
        $nextRounds = [];
        // b) - The first game in the round has started or predictions are closed
        // and the last game in the round doesn't have a result set yet
        $currentRounds = [];
        // c) All games have result set
        $previousRounds = [];


        $rounds = $this->predictions->getRoundsWithGamesForSeason($season);

        if (empty($rounds)) {
            // Return the "home" view right away
            return view('home', compact('nextRounds', 'currentRounds', 'previousRounds', 'season'));
        }

        // Eager load user predictions with scorers
        \Auth::user()->load('predictions.firstScorer.team');

        // User prediction outcomes for rounds
        $predictionOutcomes = \Auth::user()->predictionOutcomes()
            ->whereIn('round', collect($rounds)->pluck('round'))
            ->where('season_id', '=', $season->id)
            ->orderBy('round')
            ->get();


        // Iterate through all the rounds as long as the number of rounds flagged as "previous" is not >=2

        // Round info will be an array structure like:

        // array:2 [
        //  "round" => 12
        //  "games_per_round" => 3
        //]

        $roundInfo = end($rounds);

        do {
            $round = $roundInfo['round'];

            // Fetch the games for the round
            $games = $this->games->loadGamesForRoundForSeason($round, $season);

            // Compose round details
            $roundDetails = [
                'round'                   => $round,
                'games'                   => $games,
                'user_prediction_outcome' => $predictionOutcomes->where('round', '=', $round)->first()
            ];

            // Games are ordered by the datetime

            /** @var Game $firstGame */
            $firstGame = $games->first();
            /** @var Game $lastGame */
            $lastGame = $games->last();

            // Check if predictions for the round are still open
            // If there's less than 60 minutes between now and the first game of the round, predictions are not allowed

            // Pass "false" as the 2nd argument to diffInMinutes() method not to get absolute values
            $predictionsOpen = Carbon::now()->diffInMinutes($firstGame->datetime, false) > config('predictions.locking_time');

            if ($predictionsOpen) {
                // Additional attribute for next round
                // If user has no predictions for the round, display a link to the form for adding all round predictions
                $noUserPredictionsForRound = true;
                foreach ($games as $game) {
                    if (\Auth::user()->hasPredictionForGame($game)) {
                        $noUserPredictionsForRound = false;
                        break;
                    }
                }
                $roundDetails['user_has_no_predictions_for_round'] = $noUserPredictionsForRound;
                $nextRounds[] = $roundDetails;
            } else {
                if (!$lastGame->result || !$lastGame->result->result_is_set) {
                    $currentRounds[] = $roundDetails;
                } else {
                    $previousRounds[] = $roundDetails;
                }
            }

            // Rules: Show 2 previous rounds only if there are no next rounds or no current round
        } while (($roundInfo = prev($rounds)) !== false && (
            sizeof($previousRounds) < 1 ||
            (sizeof($previousRounds) < 2 && (sizeof($currentRounds) == 0 || sizeof($nextRounds) == 0))
        ));

        // Expected output looks like:

        // Rounds

        // Next round:      12
        // Next round:      13
        // Active round:    11
        // Previous round:  10
        // Previous round:  9

        // To achieve this, reverse the order of next rounds

        if (!empty($nextRounds)) {
            $nextRounds = array_reverse($nextRounds);
        }

        return view('home', compact('nextRounds', 'currentRounds', 'previousRounds', 'season'));

    }

    /**
     * @param  Season $season
     * @param  int $round
     * @return \Illuminate\Http\RedirectResponse
     * @throws GameException
     */
    public function createPredictionsForRoundForSeason(Season $season, $round)
    {
        $games = $this->games->loadGamesForRoundForSeason($round, $season);

        if ($games->isEmpty()) {
            throw GameException::noGamesFoundForRound();
        }

        /** @var Game $firstGame */
        $firstGame = $games->first();

        // Pass "false" as the 2nd argument to diffInMinutes() method not to get absolute values
        $predictionsOpen = Carbon::now()->diffInMinutes($firstGame->datetime, false) > config('predictions.locking_time');

        if (!$predictionsOpen) {
            flash()->error(__('requests.home.predictions.create.predictions_locked', ['round' => $round]))->important();
            return redirect()->route('home.index');
        }

        return view('home.predictions.create-for-round', compact('games', 'season', 'round'));
        dump('ii');

    }
}
