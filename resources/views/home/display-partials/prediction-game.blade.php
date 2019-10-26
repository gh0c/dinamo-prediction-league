<div class="row align-items-center">
    <div class="col-12 text-center small">
        {{ $game->datetime->format('d.m.Y. H:i') }}
    </div>

    <div class="col-6">
        @if($game->homeTeam)
            @include('home.display-partials.team', ['team' => $game->homeTeam])
        @endif
    </div>

    <div class="col-6">
        @if($game->awayTeam)
            @include('home.display-partials.team', ['team' => $game->awayTeam])
        @endif
    </div>
</div>