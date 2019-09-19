<?php

namespace App\Models\Games;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Games\Result
 *
 * @property int $id
 * @property int $game_id
 * @property int|null $home_team_score
 * @property int|null $away_team_score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Result newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Result newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Result query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Result whereAwayTeamScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Result whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Result whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Result whereHomeTeamScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Result whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Result whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Games\Game $game
 * @property-read mixed $result
 */
class Result extends Model
{
    protected $fillable = ['home_team_score', 'away_team_score'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function getResultAttribute()
    {
        return $this->home_team_score . ':' . $this->away_team_score;
    }
}
