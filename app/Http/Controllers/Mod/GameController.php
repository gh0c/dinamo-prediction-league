<?php

namespace App\Http\Controllers\Mod;

use App\Http\Requests\Mod\StoreGameRequest;
use App\Models\Games\Competition;
use App\Models\Games\Game;
use App\Models\Games\Season;
use App\Models\Team;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::with(['homeTeam', 'awayTeam', 'season', 'competition'])->orderBy('round')->orderBy('datetime')->get();
        return view('mod.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mod.games.create', [
            'inputTeams'        => Team::orderBy('sport')->orderBy('name')->pluck('name', 'id')->all(),
            'inputCompetitions' => Competition::orderBy('sport')->orderBy('name')->pluck('name', 'id')->all(),
            'inputSeasons'      => Season::orderBy('name')->pluck('name', 'id')->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreGameRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameRequest $request)
    {
        $game = new Game($request->all());

        $date = $request->input('datetime_date');
        $time = $request->input('datetime_time');
        $dateTime = Carbon::createFromFormat('Y-m-dH:i', $date . $time);
        $game->datetime = $dateTime;

        $game->save();

        flash()->success(__('requests.mod.game.successful_store', [
            'home_team' => $game->homeTeam->name,
            'away_team' => $game->awayTeam->name,
        ]));
        return redirect()->route('mod.games.index');
    }
}
