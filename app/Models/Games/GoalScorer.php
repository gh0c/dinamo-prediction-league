<?php

namespace App\Models\Games;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Games\GoalScorer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\GoalScorer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\GoalScorer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\GoalScorer query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $game_id
 * @property int|null $player_id
 * @property int $is_first_goal
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Games\Game $game
 * @property-read \App\Models\Games\Player|null $player
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\GoalScorer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\GoalScorer whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\GoalScorer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\GoalScorer whereIsFirstGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\GoalScorer whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\GoalScorer wherePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\GoalScorer whereUpdatedAt($value)
 */
class GoalScorer extends Model
{
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
