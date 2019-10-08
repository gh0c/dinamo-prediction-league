<div class="card">
    <div class="card-header text-center">
        {{ __('pages.dashboard.next_round.card._label') }}
        - {{ $round['round'] }}. {{ mb_strtolower(__('models.games.game._attributes.round')) }}
    </div>

    <div class="card-body">
        <table class="table table-sm">
            <tbody>

            @foreach($round['games'] as $game)
                <tr>
                    <td>{{ $game->datetime->format('d.m.Y. H:i') }}</td>

                    <td>
                        @if($game->homeTeam)
                            <span>
                                @if($game->homeTeam->featured_image)
                                    <img src="{{ $game->homeTeam->logoThumbnailUrl() }}"
                                         style="width: 22px; height: 22px; object-fit: contain"
                                         alt="{{ $game->homeTeam->name }}"
                                         class="img-fluid m-auto">
                                @endif
                            </span>
                            <span class="ml-1">{{ $game->homeTeam->name }}</span>
                        @endif
                    </td>

                    <td>
                        @if($game->awayTeam)
                            <span>
                                @if($game->awayTeam->featured_image)
                                    <img src="{{ $game->awayTeam->logoThumbnailUrl() }}"
                                         style="width: 22px; height: 22px; object-fit: contain"
                                         alt="{{ $game->awayTeam->name }}"
                                         class="img-fluid m-auto">
                                @endif
                            </span>
                            <span class="ml-1">{{ $game->awayTeam->name }}</span>
                        @endif
                    </td>

                    <td>
                        @if($game->result)
                            @if(!is_null($game->result->home_team_score) && !is_null($game->result->away_team_score))
                                <span>{{ $game->result->home_team_score }}:{{ $game->result->away_team_score }}</span>
                            @endif
                        @endif
                    </td>

                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
</div>