<?php

namespace App\Http\Controllers;

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

        $rounds = $this->predictions->getRoundsWithGamesForSeason($season);

        if (empty($rounds)) {

            // TODO - implement
            return false;

        }

        dd($rounds);

        // Determine and group rounds
        // a) Next round(s)
        // b) current round
        // c) previous round(s)

        // a) - The first game in the round hasn't started yet and predictions for it are still open
        $nextRounds = [];
        // b) - The first game in the round has started or predictions are closed
        // and the last game in the round doesn't have result set yet
        $currentRound = null;
        // c) All games have result set
        $previousRounds = [];

        $round = end($rounds)['round'];
//
//        do {
//
//        } while ($round = prev($));
//
//        while ()



        $kola = [1,2,3,4,5];

        dump(end($kola));
        dump(prev($kola));
        dump(prev($kola));
        dump(prev($kola));
        dump(prev($kola));
        dump(prev($kola));
        dd(prev($kola));

        // Find the last round games exist for
        $lastRound = end($rounds)['round'];

        // Fetch the games for it
        $games = $this->games->loadGamesForRoundForSeason($round, $season);

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
