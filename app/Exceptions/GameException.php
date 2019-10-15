<?php

namespace App\Exceptions;

use Exception;

class GameException extends Exception
{
    public static function noGamesFoundForRound()
    {
        return new self(__('requests.mod.game.games_not_found_for_round'));
    }
}