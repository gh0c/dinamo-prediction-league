<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\BasicPostRequest;
use App\Models\Games\Game;
use App\Models\Games\Player;
use App\Models\Predictions\Prediction;
use App\Traits\RemainingJokers;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

/**
 * Class UpdatePredictionRequest
 * @package App\Http\Requests\Admin
 * @property Prediction $prediction
 */
class UpdatePredictionRequest extends BasicPostRequest
{
    use RemainingJokers;

    protected $defaultMessageLangKey = 'requests.home.predictions.update.default_message';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_id'         => [
                'required',
                'exists:games,id',
                Rule::unique('predictions', 'game_id')->where(function ($query) {
                    /** @var $query Builder */
                    $query->where('user_id', Auth::user()->id);
                })->ignore($this->prediction->id),
            ],
            'home_team_score' => [
                'required',
                'integer',
                'min:0',
            ],
            'away_team_score' => [
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
                $validator->errors()->add('field', __('requests.home.predictions.update.predictions_locked'));
            }

        });
    }

    /**
     * @param  \Illuminate\Validation\Validator $validator
     */
    private function checkIfNumberOfJokersIsExceeded($validator)
    {
        $remainingJokers = $this->getRemainingJokersForUser(Auth::user());

        if ($remainingJokers > 0) {
            return;
        }

        if ($this->input('joker_used')) {
            $validator->errors()->add('joker_used',
                __('requests.home.predictions.update.number_of_jokers_exceeded')
            );
        }
    }

    /**
     * @param  \Illuminate\Validation\Validator $validator
     */
    private function checkValidScorers($validator)
    {
        // Make sure:
        // a) Scorer is not selected when joker is used
        // b) Scorer is not selected if predicted result is 0:0
        // c) Scorer is not selected from the team predicted as scoreless

        if ($this->input('first_scorer_id')) {

            // a)
            if ($this->input('joker_used')) {
                $validator->errors()->add('first_scorer_id',
                    __('requests.home.predictions.update.scorer_for_game_with_joker_exists')
                );
                return;
            }

            // b)
            if ($this->input('home_team_score') == 0 && $this->input('away_team_score') == 0) {
                $validator->errors()->add('first_scorer_id',
                    __('requests.home.predictions.update.scorer_for_scoreless_game_exists')
                );
                return;
            }

            // c)
            if ($this->input('home_team_score') == 0 || $this->input('away_team_score') == 0) {
                // If scorer is known and score for one of the teams is "0", make sure the scorer does not belong to that team
                $player = Player::find($this->input('first_scorer_id'));
                $game = Game::find($this->input('game_id'));

                if (($this->input('home_team_score') == 0 && $game->home_team_id == $player->team_id) ||
                    ($this->input('away_team_score') == 0 && $game->away_team_id == $player->team_id)
                ) {
                    $validator->errors()->add('first_scorer_id',
                        __('requests.home.predictions.update.scorer_from_scoreless_team_exists')
                    );
                }
            }

        }
    }

    private function predictionsLocked()
    {
        $game = Game::find($this->input('game_id'));
        $predictionsOpen = Carbon::now()->diffInMinutes($game->datetime, false) > config('predictions.locking_time');
        if (!$predictionsOpen) {
            return true;
        }
        return false;
    }

    public function messages()
    {
        return [
            'game_id.unique' => __('requests.home.predictions.update.duplicate_prediction')
        ];
    }
}
