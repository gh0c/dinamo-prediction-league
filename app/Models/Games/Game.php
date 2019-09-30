<?php

namespace App\Models\Games;

use App\Models\Predictions\Prediction;
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
 * @property \Illuminate\Support\Carbon|string|null $datetime
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
 * @property-read \App\Models\Games\Team|null $awayTeam
 * @property-read \App\Models\Games\Competition|null $competition
 * @property-read \App\Models\Games\Team|null $homeTeam
 * @property-read \App\Models\Games\Season|null $season
 * @property-read \App\Models\Games\Result $result
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Games\GoalScorer[] $goalScorers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Predictions\Prediction[] $predictions
 * @property-read mixed $datetime_date
 * @property-read mixed $datetime_time
 * @property-read mixed $game_description
 * @property-read mixed|Player|null $first_scorer
 * @property-read mixed $away_team_score
 * @property-read mixed $home_team_score
 * @property-read int|null $goal_scorers_count
 * @property-read int|null $predictions_count
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

    public function getHomeTeamScoreAttribute()
    {
        if ($this->result) {
            return $this->result->home_team_score;
        }
        return null;
    }

    public function getAwayTeamScoreAttribute()
    {
        if ($this->result) {
            return $this->result->away_team_score;
        }
        return null;
    }

    public function goalScorers()
    {
        return $this->hasMany(GoalScorer::class);
    }

    public function getFirstScorerAttribute()
    {
        if ($this->goalScorers->isNotEmpty()) {
            return $this->goalScorers->where('is_first_goal', '=', true)->first()->player;
        }
        return null;
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public function getDatetimeDateAttribute()
    {
        return $this->datetime->format('Y-m-d');
    }

    public function getDatetimeTimeAttribute()
    {
        return $this->datetime->format('H:i');
    }

    public function getGameDescriptionAttribute()
    {
        return $this->datetime->format('d.m.Y. H:i') . ' ' . $this->homeTeam->name . ' - ' . $this->awayTeam->name;
    }

}
