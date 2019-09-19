<?php

namespace App\Models\Predictions;

use App\Models\Games\Game;
use App\Models\Games\Player;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Predictions\Prediction
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction query()
 * @mixin \Eloquent
 * @property-read \App\Models\Games\Player $firstScorer
 * @property-read \App\Models\Games\Game $game
 * @property-read \App\Models\Users\User $user
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int|null $first_scorer_id
 * @property int $joker_used
 * @property int|null $home_team_score
 * @property int|null $away_team_score
 * @property int|null $points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction whereAwayTeamScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction whereFirstScorerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction whereHomeTeamScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction whereJokerUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction whereUserId($value)
 * @property-read mixed $predicted_result
 */
class Prediction extends Model
{
    protected $fillable = ['user_id', 'game_id', 'home_team_score', 'away_team_score', 'first_scorer_id', 'joker_used'];

    protected $casts = [
        'joker_used' => 'boolean',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function firstScorer()
    {
        return $this->belongsTo(Player::class);
    }

    public function getPredictedResultAttribute()
    {
        return $this->home_team_score . ':' . $this->away_team_score;
    }
}
