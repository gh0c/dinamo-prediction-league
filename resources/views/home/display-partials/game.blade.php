<div class="row align-items-center">

    <div class="col-4">
        @if($game->homeTeam)
            @include('home.display-partials.team', ['team' => $game->homeTeam])
        @endif
    </div>
    <div class="col-2 text-right game-result-col">
        @if($game->result && $game->result->result_is_set)
            <h5 class="font-weight-bold m-auto">{{ $game->result->home_team_score }}</h5>
        @endif
    </div>
    <div class="col-2 text-left game-result-col">
        @if($game->result && $game->result->result_is_set)
            <h5 class="font-weight-bold m-auto">{{ $game->result->away_team_score }}</h5>
        @endif
    </div>
    <div class="col-4">
        @if($game->awayTeam)
            @include('home.display-partials.team', ['team' => $game->awayTeam])
        @endif
    </div>

</div>