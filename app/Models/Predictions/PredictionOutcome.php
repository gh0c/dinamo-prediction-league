<?php

namespace App\Models\Predictions;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Predictions\PredictionOutcome
 *
 * @property int $id
 * @property int $user_id
 * @property int $round
 * @property int $points
 * @property int $bonus_points
 * @property int $total_points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome whereBonusPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome whereTotalPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Users\User $user
 * @property int|null $jokers_used
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome whereJokersUsed($value)
 * @property int|null $season_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\PredictionOutcome whereSeasonId($value)
 */
class PredictionOutcome extends Model
{
    protected $fillable = ['user_id', 'round', 'season_id', 'points', 'bonus_points', 'total_points', 'jokers_used',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function predictions()
    {
        return Prediction::where('user_id', '=', $this->user_id)
            ->whereHas('game', function ($query) {
                /** @var Builder $query */
                $query->where('round', '=', $this->round);
            });
    }
}
