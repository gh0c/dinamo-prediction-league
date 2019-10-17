@foreach($rounds as $roundDetails)

    <ul class="list-group py-2">

        <li class="list-group-item bg-light text-dark text-center">
            {{ __('pages.dashboard.previous_round.card._label') }}
            - {{ $roundDetails['round'] }}. {{ mb_strtolower(__('models.games.game._attributes.round')) }}
        </li>

        @foreach($roundDetails['games'] as $game)
            <li class="list-group-item py-1">
                <div class="row align-items-center">

                    <div class="col-12 col-lg-2 text-center small">
                        {{ $game->datetime->format('d.m.Y. H:i') }}
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="row align-items-center">

                            <div class="col-4 col-xl-4">
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
                            <div class="col-4 col-xl-4">
                                @if($game->awayTeam)
                                    @include('home.display-partials.team', ['team' => $game->awayTeam])
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Prediction --}}
                    @if(Auth::user()->hasPredictionForGame($game) && $prediction = Auth::user()->getPredictionForGame($game))
                        <div class="col-12 col-lg-4 pt-1 pt-lg-0 border-top border-top-dashed border-top-lg-0 border-left-lg border-left-lg-dashed">
                            <div class="row align-items-center">

                                <div class="col-4 text-right">
                                    <span class="text-muted small">{{ __('pages.home.prediction.prediction._label') }}</span>
                                    <br>
                                </div>

                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-6 text-right game-result-col">
                                            <h5 class="font-weight-bold m-auto">{{ $prediction->home_team_score }}</h5>
                                        </div>
                                        <div class="col-6 text-left game-result-col">
                                            <h5 class="font-weight-bold m-auto">{{ $prediction->away_team_score }}</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if($prediction->firstScorer)
                                            <span class="m-auto small">{{ $prediction->firstScorer->name }}</span>
                                        @elseif($prediction->joker_used)
                                            <span class="m-auto small">
                                                @if($prediction->points !== null)
                                                    @if($prediction->points == 0)
                                                        {!! Html::image('/img/jester_32_neutral.png', 'Joker', ['style' => 'contain: content; width: 18px;']) !!}
                                                    @elseif($prediction->points < 0)
                                                        {!! Html::image('/img/jester_32_danger.png', 'Joker', ['style' => 'contain: content; width: 18px;']) !!}
                                                    @else
                                                        {!! Html::image('/img/jester_32_success.png', 'Joker', ['style' => 'contain: content; width: 18px;']) !!}
                                                    @endif
                                                @else
                                                    {!! Html::image('/img/jester_32.png', 'Joker', ['style' => 'contain: content; width: 18px;']) !!}
                                                @endif
                                                <span class="font-weight-bold align-middle">:JOKER:</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-4">
                                    @if($prediction->points !== null)
                                        <div class="d-inline-block text-center">
                                            <span class="text-muted small">{{ __('pages.home.prediction.points._label') }}</span>
                                            <br>
                                            <span>{{ $prediction->points}}</span>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endif

                </div>
            </li>
        @endforeach
    </ul>

@endforeach