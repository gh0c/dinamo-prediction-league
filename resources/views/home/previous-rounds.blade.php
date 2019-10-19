@foreach($rounds as $roundDetails)

    <ul class="list-group py-2">

        <li class="list-group-item bg-light text-dark text-center">
            <div class="row align-items-center">
                <div class="col-10">
                    {{ __('pages.dashboard.previous_round.card._label') }}
                    - {{ $roundDetails['round'] }}. {{ mb_strtolower(__('models.games.game._attributes.round')) }}

                    @if($roundDetails['user_prediction_outcome'])
                        <span class="badge badge-success badge-pill d-block">
                            {{ __('pages.home.prediction.total_round_points._label') }}
                            {{ $roundDetails['user_prediction_outcome']->total_points }}
                            @if($roundDetails['user_prediction_outcome']->bonus_points)
                                ({{ $roundDetails['user_prediction_outcome']->points }} +
                                {{ $roundDetails['user_prediction_outcome']->bonus_points }})
                            @endif
                        </span>
                    @endif
                </div>
                <div class="col-2">
                    <a href="{{ route('results.round', ['season' => $season->id, 'round' => $roundDetails['round']]) }}"
                       class="btn btn-sm btn-outline-info" target="_blank">
                        <i class="fa fa-list-ol fa-lg"></i>
                    </a>
                </div>
            </div>
        </li>

        @foreach($roundDetails['games'] as $game)
            <li class="list-group-item py-1">
                <div class="row align-items-center">

                    <div class="col-12 col-lg-2 text-center small">
                        {{ $game->datetime->format('d.m.Y. H:i') }}
                    </div>

                    <div class="col-12 col-lg-6">
                        @include('home.display-partials.game', ['game' => $game])
                    </div>

                    {{-- Prediction --}}
                    <div class="col-12 col-lg-4 pt-1 pt-lg-0 border-top border-top-dashed border-top-lg-0 border-left-lg border-left-lg-dashed">
                        @if(Auth::user()->hasPredictionForGame($game))
                            @include('home.display-partials.old-prediction', ['prediction' => Auth::user()->getPredictionForGame($game), 'game' => $game])
                        @else
                            <div class="row ">
                                <span class="col text-muted m-auto">
                                    {{ __('pages.home.prediction.no_prediction._label') }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

@endforeach