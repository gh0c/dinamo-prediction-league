<?php

namespace App\Exceptions;

use Exception;

class SeasonException extends Exception
{
    public static function activeSeasonNotFound()
    {
        return new self(__('requests.admin.season.active_season_not_found'));
    }
}
