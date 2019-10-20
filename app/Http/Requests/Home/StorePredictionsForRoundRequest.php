<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\BasicPostRequest;
use App\Models\Games\Game;
use App\Models\Games\Player;
use App\Models\Games\Season;
use App\Models\Repositories\Predictions;
use App\Traits\RemainingJokers;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

/**
 * Class StorePredictionsForRoundRequest
 * @package App\Http\Requests\Home
 */
class StorePredictionsForRoundRequest extends BasicPostRequest
{
    use RemainingJokers;

    protected $defaultMessageLangKey = 'requests.home.predictions.store_for_round.default_message';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'predictions.*.game_id'         => [
                'required',
                'exists:games,id',
                Rule::unique('predictions', 'game_id')->where(function ($query) {
                    /** @var $query Builder */
                    $query->where('user_id', Auth::user()->id);
                }),
            ],
            'predictions.*.home_team_score' => [
                'required',
                'integer',
                'min:0',
            ],
            'predictions.*.away_team_score' => [
                'required',
                'integer',
                'min:0',
            ],

        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            /** @var \Illuminate\Validation\Validator $validator */

            $this->checkIfNumberOfJokersIsExceeded($validator);

            $this->checkValidScorers($validator);

            if ($this->predictionsLocked()) {
                $validator->errors()->add('field', __('requests.home.predictions.store_for_round.predictions_locked'));
            }

        });
    }

    /**
     * @param  \Illuminate\Validation\Validator $validator
     */
    private function checkIfNumberOfJokersIsExceeded($validator)
    {
        $remainingJokers = $this->getRemainingJokersForUser(Auth::user());

        // Number of jokers used in this round
        $jokersUsed = 0;
        // If necessary, display error message next to the last prediction where joker is used
        $predictionIndex = 0;

        foreach ($this->input('predictions') as $index => $predictionData) {
            if ($predictionData['joker_used']) {
                $jokersUsed++;
                $predictionIndex = $index;
            }
        }

        if ($jokersUsed > $remainingJokers) {
            $validator->errors()->add('predictions.' . $predictionIndex . '.joker_used',
                __('requests.home.predictions.store_for_round.number_of_jokers_exceeded')
            );
        }

    }

    /**
     * @param  \Illuminate\Validation\Validator $validator
     */
    private function checkValidScorers($validator)
    {
        foreach ($this->input('predictions') as $index => $predictionData) {
            // Make sure:
            // a) Scorer is not selected when joker is used
            // b) Scorer is not selected if predicted result is 0:0
            // c) Scorer is not selected from the team predicted as scoreless

            if ($predictionData['first_scorer_id']) {

                // a)
                if ($predictionData['joker_used']) {

                    $validator->errors()->add('predictions.' . $index . '.first_scorer_id',
                        __('requests.home.predictions.store_for_round.scorer_for_game_with_joker_exists')
                    );
                    continue;
                }

                // b)
                if ($predictionData['home_team_score'] == 0 && $predictionData['away_team_score'] == 0) {

                    $validator->errors()->add('predictions.' . $index . '.first_scorer_id',
                        __('requests.home.predictions.store_for_round.scorer_for_scoreless_game_exists')
                    );
                    continue;
                }

                // c)
                if ($predictionData['home_team_score'] == 0 || $predictionData['away_team_score'] == 0) {
                    // If scorer is known and score for one of the teams is "0", make sure the scorer does not belong to that team
                    $player = Player::find($predictionData['first_scorer_id']);
                    $game = Game::find($predictionData['game_id']);

                    if (($predictionData['home_team_score'] == 0 && $game->home_team_id == $player->team_id) ||
                        ($predictionData['away_team_score'] == 0 && $game->away_team_id == $player->team_id)
                    ) {
                        $validator->errors()->add('predictions.' . $index . '.first_scorer_id',
                            __('requests.home.predictions.store_for_round.scorer_from_scoreless_team_exists')
                        );
                    }

                }

            }


        }
    }

    private function predictionsLocked()
    {
        foreach ($this->input('predictions') as $predictionData) {
            $game = Game::find($predictionData['game_id']);
            $predictionsOpen = Carbon::now()->diffInMinutes($game->datetime, false) > config('predictions.locking_time');
            if (!$predictionsOpen) {
                return true;
            }
        }

        return false;
    }

}
