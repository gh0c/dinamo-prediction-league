<?php

namespace App\Models\Predictions;

use App\Models\Games\Game;
use App\Models\Games\Player;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Predictions\Prediction
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Predictions\Prediction query()
 * @mixin \Eloquent
 * @property-read \App\Models\Games\Player $firstScorer
 * @property-read \App\Models\Games\Game $game
 * @property-read \App\Models\Users\User $user
 */
class Prediction extends Model
{
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function firstScorer()
    {
        return $this->belongsTo(Player::class);
    }
}
