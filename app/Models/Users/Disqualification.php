<?php

namespace App\Models\Users;

use App\Models\Games\Season;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Users\Disqualification
 *
 * @property int $id
 * @property int $user_id
 * @property int $season_id
 * @property string $reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Disqualification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Disqualification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Disqualification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Disqualification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Disqualification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Disqualification whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Disqualification whereSeasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Disqualification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Disqualification whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Games\Season $season
 * @property-read \App\Models\Users\User $user
 */
class Disqualification extends Model
{
    protected $fillable = ['user_id', 'season_id', 'reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
