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
 */
class Player extends Model
{
    protected $fillable = [
        'name', 'team_id',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
