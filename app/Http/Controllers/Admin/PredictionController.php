<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\SeasonException;
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
use App\Models\Repositories\Predictions;
use App\Models\Users\User;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws SeasonException
     */
    public function dashboard()
    {
        $season = Season::active();
        if (!$season) {
            throw SeasonException::activeSeasonNotFound();
        }

        $rounds = $this->predictions->getRoundsWithGamesForSeason($season);

        return view('admin.predictions.dashboard', compact('season', 'rounds'));
    }

    /**
     * Display a listing of the Predictions filtered by season.
     *
     * @param  Season $season
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexForSeason(Season $season)
    {
        $predictions = $this->predictions->loadAllPredictions($season);

        return view('admin.predictions.index', compact('predictions', 'season'));
    }

    /**
     * Display a listing of the Predictions filtered by currently active season.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexForActiveSeason()
    {
        return $this->indexForSeason(Season::active());
    }

    /**
     * Display a listing of the Predictions filtered by round in season.
     *
     * @param  Season $season
     * @param  int|string $round
     * @return \Illuminate\Http\Response
     */
    public function indexForRoundForSeason(Season $season, $round)
    {
        $predictions = $this->predictions->loadPredictionsForRound($round, $season);

        return view('admin.predictions.index-for-round', compact('predictions', 'round', 'season'));
    }

    /**
     * Display a listing of the Predictions filtered by round in currently active season.
     *
     * @param  int|string $round
     * @return \Illuminate\Http\Response
     */
    public function indexForRoundForActiveSeason($round)
    {
        return $this->indexForRoundForSeason(Season::active(), $round);
    }

    /**
     * @param  Season $season
     * @return \Illuminate\Http\Response
     */
    public function createForSeason(Season $season)
    {
        return view('admin.predictions.create', compact('season'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function createForActiveSeason()
    {
        return $this->createForSeason(Season::active());
    }

    /**
     * @param  Season $season
     * @param  int $round
     * @return \Illuminate\Http\Response
     */
    public function createForRoundForSeason(Season $season, $round)
    {
        $games = Game::whereRound($round)
            ->where('season_id', '=', $season->id)
            ->orderBy('datetime')
            ->get();

        return view('admin.predictions.create-for-round', compact('games', 'season', 'round'));
    }

    /**
     * @param  int $round
     * @return \Illuminate\Http\Response
     */
    public function createForRoundForActiveSeason($round)
    {
        return $this->createForRoundForSeason(Season::active(), $round);
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
        return $this->redirectToIndexPageBasedOnGame($game);
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
            $game = Game::find($predictionData['game_id']);

            $prediction = new Prediction($predictionData);
            $prediction->points = null;
            $prediction->save();
        }

        flash()->success(__('requests.admin.prediction.successful_store_for_round', [
            'round' => $round,
            'user'  => $user->username
        ]));
        return $this->redirectToIndexPageBasedOnGame($game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Season $season
     * @param  Prediction $prediction
     * @return \Illuminate\Http\Response
     */
    public function editForSeason(Season $season, Prediction $prediction)
    {
        return view('admin.predictions.edit', compact('season', 'prediction'));
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
        return $this->redirectToIndexPageBasedOnGame($prediction->game);
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
        return $this->redirectToIndexPageBasedOnGame($prediction->game);
    }

    /**
     * @param  Game $game
     * @return \Illuminate\Http\Response
     */
    private function redirectToIndexPageBasedOnGame($game)
    {
//        if ($game->season_id == Season::active()->id) {
//            return redirect()->route('admin.predictions.active-season.rounds.index', ['round' => $game->round]);
//        } else {
//            return redirect()->route('admin.predictions.seasons.rounds.index', ['season' => $game->season_id, 'round' => $game->round]);
//        }
        return redirect()->route('admin.predictions.seasons.rounds.index', ['season' => $game->season_id, 'round' => $game->round]);
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
        $season = Season::active();
        if (!$season) {
            throw SeasonException::activeSeasonNotFound();
        }

        $this->predictions->setPredictionOutcomesForRound($round, $season);
        flash()->success(__('requests.admin.prediction.successful_set_prediction_outcomes_for_round_in_active_season', [
            'round' => $round
        ]));
        return redirect()->route('results.round', ['season' => $season->id, 'round' => $round]);
    }

}