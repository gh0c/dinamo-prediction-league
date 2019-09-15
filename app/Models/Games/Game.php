<?php

namespace App\Models\Games;

use App\Models\Predictions\Prediction;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Games\Game
 *
 * @property int $id
 * @property int|null $home_team_id
 * @property int|null $away_team_id
 * @property int|null $season_id
 * @property int|null $competition_id
 * @property int|null $round
 * @property string|null $datetime
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game whereAwayTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game whereDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game whereHomeTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game whereSeasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Game whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Team|null $awayTeam
 * @property-read \App\Models\Games\Competition|null $competition
 * @property-read \App\Models\Team|null $homeTeam
 * @property-read \App\Models\Games\Season|null $season
 * @property-read \App\Models\Games\Result $result
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Games\GoalScorer[] $goalScorers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Predictions\Prediction[] $predictions
 */
class Game extends Model
{

    protected $dates = ['datetime'];

    protected $fillable = [
        'home_team_id', 'away_team_id', 'round', 'competition_id', 'season_id'
    ];

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    public function goalScorers()
    {
        return $this->hasMany(GoalScorer::class);
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

}
