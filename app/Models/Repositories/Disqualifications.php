<?php

namespace App\Models\Repositories;

use App\Models\Games\Season;
use App\Models\Users\Disqualification;

class Disqualifications
{
    /**
     * @param  Season $season
     * @return Disqualification[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function loadAllDisqualifications($season)
    {
        return Disqualification::with(['season', 'user'])
            ->leftJoin('users', 'users.id', '=', 'disqualifications.user_id')
            ->where('season_id', '=', $season->id)
            ->orderBy('users.username')
            ->select('disqualifications.*')
            ->get();
    }

    /**
     * @return Disqualification[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function loadAllDisqualificationsInActiveSeason()
    {
        return $this->loadAllDisqualifications(Season::active());
    }


}