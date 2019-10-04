<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Users\UserSetting
 *
 * @property int $id
 * @property int $user_id
 * @property int $is_super_admin
 * @property int $is_admin
 * @property int $is_moderator
 * @property int $is_disqualified_from_prediction_league
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting whereIsDisqualifiedFromPredictionLeague($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting whereIsModerator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting whereIsSuperAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\UserSetting whereUserId($value)
 * @mixin \Eloquent
 * @property-read User $user
 */
class UserSetting extends Model
{
    protected $fillable = ['is_admin', 'is_moderator'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
