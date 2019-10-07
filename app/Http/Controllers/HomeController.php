<?php

namespace App\Http\Controllers;

use App\Exceptions\SeasonException;
use App\Models\Games\Game;
use App\Models\Games\Season;
use App\Models\Repositories\Predictions;
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

        dump(\Carbon\Carbon::now()->diffInMinutes($games->first()->datetime));
        dd(\Carbon\Carbon::now()->diffInMinutes($games->first()->datetime) > config('predictions.locking_time'));

//        if (\Carbon\Carbon::now()->diffInMinutes($games->first()->datetime)

        dd($games);


        return view('home');
    }
}
