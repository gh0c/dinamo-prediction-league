<?php

namespace App\Http\Controllers;

use App\Exceptions\SeasonException;
use App\Models\Games\Game;
use App\Models\Games\Season;
use App\Models\Repositories\Predictions;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @property Predictions $predictions
 */
class HomeController extends Controller
{
    protected $predictions;

    public function __construct(Predictions $predictions)
    {
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

        $rounds = $this->predictions->getRoundsWithGamesForSeason($season);

        if (empty($rounds)) {

            // TODO - implement
            return false;

        }

        // Find the last round games exist for
        $lastRound = end($rounds)['round'];

        // Fetch the games for it
        $games = Game::whereSeasonId($season->id)->where('round', $lastRound)
            ->with(['homeTeam', 'awayTeam', 'season', 'competition'])
            ->orderBy('datetime')
            ->get();

        /** @var Game $firstGame ordered by datetime */
        $firstGame = $games->first();

        // If there's less than N (e.g. 60) minutes between now and the first game of the round, predictions are not allowed
        $predictionsForLastRoundEnabled = Carbon::now()->diffInMinutes($firstGame->datetime, false) > config('predictions.locking_time');

        if ($predictionsForLastRoundEnabled) {
            $nextRound = ['round' => $lastRound, 'games' => $games];

            return view('home', compact('nextRound', 'predictionsForLastRoundEnabled'));
        }

//        if (\Carbon\Carbon::now()->diffInMinutes($games->first()->datetime)

        dd($games);


        return view('home');
    }
}
