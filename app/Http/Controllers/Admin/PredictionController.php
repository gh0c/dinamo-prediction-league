<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeletePredictionRequest;
use App\Http\Requests\Admin\FilterScorersByGameRequest;
use App\Http\Requests\Admin\StorePredictionRequest;
use App\Http\Requests\Admin\StorePredictionsForRoundRequest;
use App\Http\Requests\Admin\UpdatePredictionRequest;
use App\Models\Games\Game;
use App\Models\Games\Season;
use App\Models\Predictions\Prediction;
use App\Models\Repositories\Games;
use App\Models\Users\User;
use App\Repositories\Predictions;

/**
 * Class PredictionController
 * @package App\Http\Controllers\Admin
 * @property Games $games
 * @property Predictions $predictions
 */
class PredictionController extends Controller
{
    protected $games;
    protected $predictions;

    public function __construct(Games $games, Predictions $predictions)
    {
        $this->games = $games;
        $this->predictions = $predictions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $predictions = $this->predictions->loadAllPredictionsInActiveSeason();

        return view('admin.predictions.index', compact('predictions'));
    }

    /**
     * Display a listing of the resource filtered by round.
     *
     * @param  int|string $round
     * @return \Illuminate\Http\Response
     */
    public function indexForRound($round)
    {
        $predictions = $this->predictions->loadPredictionsForRoundInActiveSeason($round);

        return view('admin.predictions.index-for-round', compact('predictions', 'round'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.predictions.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $round
     * @return \Illuminate\Http\Response
     */
    public function createForRound($round)
    {
        $games = Game::whereRound($round)
            ->where('season_id', '=', Season::active()->id)
            ->orderBy('datetime')
            ->get();

        return view('admin.predictions.create-for-round', compact('games', 'round'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePredictionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePredictionRequest $request)
    {
        $game = Game::find($request->input('game_id'));
        $user = User::find($request->input('user_id'));

        $prediction = new Prediction($request->all());
        $prediction->points = null;
        $prediction->save();

        flash()->success(__('requests.admin.prediction.successful_store', [
            'home_team' => $game->homeTeam->name,
            'away_team' => $game->awayTeam->name,
            'user'      => $user->username
        ]));
        return redirect()->route('admin.predictions.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePredictionsForRoundRequest $request
     * @param  int $round
     * @return \Illuminate\Http\Response
     */
    public function storeForRound(StorePredictionsForRoundRequest $request, $round)
    {
        $user = User::find($request->input('user_id'));

        foreach ($request->input('predictions') as $predictionData) {
            $predictionData['user_id'] = $user->id;

            $prediction = new Prediction($predictionData);
            $prediction->points = null;
            $prediction->save();
        }

        flash()->success(__('requests.admin.prediction.successful_store_for_round', [
            'round' => $round,
            'user'  => $user->username
        ]));
        return redirect()->route('admin.predictions.index-for-round', ['round' => $round]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Prediction $prediction
     * @return \Illuminate\Http\Response
     */
    public function edit(Prediction $prediction)
    {
        return view('admin.predictions.edit', compact('prediction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePredictionRequest $request
     * @param  Prediction $prediction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePredictionRequest $request, Prediction $prediction)
    {
        $game = Game::find($request->input('game_id'));
        $user = User::find($request->input('user_id'));

        $prediction->fill($request->all());
        $prediction->points = null;
        $prediction->save();

        flash()->success(__('requests.admin.prediction.successful_update', [
            'home_team' => $game->homeTeam->name,
            'away_team' => $game->awayTeam->name,
            'user'      => $user->username
        ]));
        return redirect()->route('admin.predictions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeletePredictionRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DeletePredictionRequest $request)
    {
        $prediction = Prediction::find($request->input('prediction_id'));
        $prediction->delete();

        flash()->success(__('requests.admin.prediction.successful_destroy', [
            'home_team' => $prediction->game->homeTeam->name,
            'away_team' => $prediction->game->awayTeam->name,
            'user'      => $prediction->user->username
        ]));
        return redirect()->route('admin.predictions.index');
    }

    /**
     * @param  FilterScorersByGameRequest $request
     * @return array|string
     * @throws \Throwable
     */
    public function filterScorersByGame(FilterScorersByGameRequest $request)
    {
        $game = Game::find($request->input('game_id'));

        if ($game) {
            $inputPlayers = $this->games->loadPlayersForGame($game);
        } else {
            $inputPlayers = $this->games->loadPlayers();
        }

        return view('admin.predictions._scorers', ['inputScorers' => $inputPlayers])->render();
    }

    /**
     * @param  int $round
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function setPredictionOutcomesForRoundInActiveSeason($round)
    {
        $this->predictions->setPredictionOutcomesForRoundInActiveSeason($round);
        flash()->success(__('requests.admin.prediction.successful_set_prediction_outcomes_for_round_in_active_season', [
            'round' => $round
        ]));
        return redirect()->route('results.round', ['season' => Season::active()->id, 'round' => $round]);
    }

}