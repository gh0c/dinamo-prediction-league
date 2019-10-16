@foreach($rounds as $roundDetails)

    <ul class="list-group py-2">

        <li class="list-group-item active text-center">
            {{ __('pages.dashboard.previous_round.card._label') }}
            - {{ $roundDetails['round'] }}. {{ mb_strtolower(__('models.games.game._attributes.round')) }}
        </li>

        @foreach($roundDetails['games'] as $game)
            <li class="list-group-item px-0">

                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-xl-4 text-center">
                            {{ $game->datetime->format('d.m.Y. H:i') }}
                        </div>
                        <div class="col-4 col-xl-4">
                            @if($game->homeTeam)
                                @include('home.display-partials.team', ['team' => $game->homeTeam])
                            @endif
                        </div>
                        <div class="col-2 text-right game-result-col">
                            @if($game->result)
                                <h5 class="font-weight-bold m-auto">{{ $game->result->home_team_score }}</h5>
                            @endif
                        </div>
                        <div class="col-2 text-left game-result-col">
                            @if($game->result)
                                <h5 class="font-weight-bold m-auto">{{ $game->result->away_team_score }}</h5>
                            @endif
                        </div>
                        <div class="col-4 col-xl-4">
                            @if($game->awayTeam)
                                @include('home.display-partials.team', ['team' => $game->awayTeam])
                            @endif
                        </div>
                    </div>
                </div>

            </li>
        @endforeach
    </ul>

@endforeach