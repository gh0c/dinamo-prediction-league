<?php

namespace App\Http\Controllers\Mod;

use App\Http\Requests\Mod\DeleteGameRequest;
use App\Http\Requests\Mod\StoreGameRequest;
use App\Http\Requests\Mod\UpdateGameResultRequest;
use App\Http\Requests\Mod\UpdateGameRequest;
use App\Models\Games\Game;
use App\Models\Games\GoalScorer;
use App\Models\Games\Result;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        return view('mod.games.create');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Game $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view('mod.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateGameRequest $request
     * @param  Game $game
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        $game->fill($request->all());

        $date = $request->input('datetime_date');
        $time = $request->input('datetime_time');
        $dateTime = Carbon::createFromFormat('Y-m-dH:i', $date . $time);
        $game->datetime = $dateTime;

        $game->save();

        flash()->success(__('requests.mod.game.successful_update', [
            'home_team' => $game->homeTeam->name,
            'away_team' => $game->awayTeam->name,
        ]));
        return redirect()->route('mod.games.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteGameRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DeleteGameRequest $request)
    {
        $game = Game::find($request->input('game_id'));
        $game->delete();

        flash()->success(__('requests.mod.game.successful_destroy', [
            'home_team' => $game->homeTeam->name,
            'away_team' => $game->awayTeam->name,
        ]));
        return redirect()->route('mod.games.index');
    }

    /**
     * @param  Game $game
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editResult(Game $game)
    {
        if (!$game->result) {
            $game->result()->save(new Result());
        }
        $game->load('goalScorers');

        return view('mod.games.result.edit', [
            'game' => $game,
        ]);
    }

    /**
     * @param  UpdateGameResultRequest $request
     * @param  Game $game
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateResult(UpdateGameResultRequest $request, Game $game)
    {
        $game->result->update($request->input('result'));

        // If this is an update of an existing game result, delete existing goal scorers first...
        if ($game->goalScorers->isNotEmpty()) {
            GoalScorer::whereIn('id', $game->goalScorers->pluck('id'))->delete();
        }
        // ... they will be added anew - both existing or newly added
        $this->saveGoalScorers($game, $request);

        flash()->success(__('requests.mod.game.result.successful_update', [
            'home_team' => $game->homeTeam->name,
            'away_team' => $game->awayTeam->name,
        ]));
        return redirect()->route('mod.games.index');
    }

    /**
     * @param  Game $game
     * @param  Request $request
     */
    protected function saveGoalScorers($game, $request)
    {
        $counter = 0;
        $firstScorerIdx = $request->input('first_goal');
        foreach ($request->input('goalScorers') as $index => $scorerData) {
            if ($index === 'x') {
                continue;
            }

            $goalScorer = new GoalScorer();
            $goalScorer->order = ++$counter;
            $goalScorer->player_id = $scorerData['player_id'];
            $goalScorer->is_first_goal = $firstScorerIdx == $index;

            $game->goalScorers()->save($goalScorer);
        }
    }

}
