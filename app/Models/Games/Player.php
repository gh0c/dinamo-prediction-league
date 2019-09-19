<?php

namespace App\Models\Games;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Games\Player
 *
 * @property int $id
 * @property string $name
 * @property int|null $team_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Team|null $team
 * @property int $is_mod_approved
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player whereIsModApproved($value)
 * @property int|null $is_own_goal_scorer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player whereIsOwnGoalScorer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player ownGoalScorer()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Player realPlayers()
 */
class Player extends Model
{
    protected $fillable = [
        'name', 'team_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Scope a query to only include real players (no -own goal "player").
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRealPlayers($query)
    {
        return $query->where('is_own_goal_scorer', false);
    }

    /**
     * Scope a query to fetch only own goal scorer "player"
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOwnGoalScorer($query)
    {
        return $query->where('is_own_goal_scorer', true)->first();
    }
}
