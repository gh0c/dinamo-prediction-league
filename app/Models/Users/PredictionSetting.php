<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Users\PredictionSetting
 *
 * @property int $id
 * @property int $user_id
 * @property int $is_prediction_league_super_admin
 * @property int $is_prediction_league_admin
 * @property int $is_prediction_league_moderator
 * @property int $is_disqualified_from_prediction_league
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting whereIsDisqualifiedFromPredictionLeague($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting whereIsPredictionLeagueAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting whereIsPredictionLeagueModerator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting whereIsPredictionLeagueSuperAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\PredictionSetting whereUserId($value)
 * @mixin \Eloquent
 * @property-read User $user
 */
class PredictionSetting extends Model
{
    protected $table = 'user_prediction_settings';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
