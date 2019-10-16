@foreach($rounds as $roundDetails)
    <div class="card">
        <div class="card-header text-center">
            {{ __('pages.dashboard.next_round.card._label') }}
            - {{ $roundDetails['round'] }}. {{ mb_strtolower(__('models.games.game._attributes.round')) }}
        </div>

        <div class="card-body">

            <ul class="list-group">
                @foreach($roundDetails['games'] as $game)
                    <li class="list-group-item">

                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-12 col-xl-4 text-center">
                                    {{ $game->datetime->format('d.m.Y. H:i') }}
                                </div>
                                <div class="col-5 col-xl-4">
                                    @if($game->homeTeam)
                                        @include('home.display-partials.team', ['team' => $game->homeTeam])
                                    @endif
                                </div>
                                <div class="col-1">
                                    @if($game->result)
                                        <span>{{ $game->result->home_team_score }}</span>
                                    @endif
                                </div>
                                <div class="col-1">
                                    @if($game->result)
                                        <span>{{ $game->result->away_team_score }}</span>
                                    @endif
                                </div>
                                <div class="col-5 col-xl-4">
                                    @if($game->awayTeam)
                                        @include('home.display-partials.team', ['team' => $game->awayTeam])
                                    @endif
                                </div>
                            </div>
                        </div>

                    </li>
                @endforeach
            </ul>

        </div>
    </div>
@endforeach