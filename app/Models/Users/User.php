<?php

namespace App\Models\Users;

use App\Models\Predictions\Prediction;
use App\Models\Predictions\PredictionOutcome;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Users\User
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read UserSetting $userSetting
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereUsername($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Predictions\Prediction[] $predictions
 * @property-read int|null $notifications_count
 * @property-read int|null $predictions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Predictions\PredictionOutcome[] $predictionOutcomes
 * @property-read int|null $prediction_outcomes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Users\Disqualification[] $disqualifications
 * @property-read int|null $disqualifications_count
 * @property-read mixed $is_admin
 * @property-read mixed $is_mod
 * @property-read mixed $is_super_admin
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
//        'email_verified_at' => 'datetime',
    ];

    public function userSetting()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public function predictionOutcomes()
    {
        return $this->hasMany(PredictionOutcome::class)->orderBy('round');
    }

    public function disqualifications()
    {
        return $this->hasMany(Disqualification::class);
    }

    public function getIsSuperAdminAttribute()
    {
        return $this->userSetting && $this->userSetting->is_super_admin;
    }

    public function getIsAdminAttribute()
    {
        return $this->userSetting && $this->userSetting->is_admin;
    }

    public function getIsModAttribute()
    {
        return $this->userSetting && $this->userSetting->is_moderator;
    }
}
