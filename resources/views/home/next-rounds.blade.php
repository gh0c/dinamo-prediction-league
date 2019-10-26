@foreach($rounds as $roundDetails)

    <ul class="list-group py-2">

        <li class="list-group-item bg-primary text-white text-center">
            <div class="row align-items-center">
                <div class="col-10">
                    {{ __('pages.dashboard.next_round.card._label') }}
                    - {{ $roundDetails['round'] }}. {{ mb_strtolower(__('models.games.game._attributes.round')) }}
                </div>
                @if($roundDetails['user_has_no_predictions_for_round'] == true)
                    <div class="col-2">
                        <a href="{{ route('home.predictions.active-season.rounds.create', ['round' => $roundDetails['round']]) }}"
                           class="btn btn-sm btn-light"
                           title="{{ __('pages.dashboard.next_round.button.add_predictions_for_round._title', ['round' => $roundDetails['round']]) }}">
                            <i class="fa fa-plus-square fa-lg"></i>
                        </a>
                    </div>
                @endif
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
                            @include('home.display-partials.new-prediction', ['prediction' => Auth::user()->getPredictionForGame($game), 'game' => $game])
                        @else
                            <div class="row align-items-center">
                                <span class="col-9 col-xl-8 text-muted m-auto">
                                    {{ __('pages.home.prediction.no_prediction._label') }}
                                </span>
                                <div class="col-3 col-xl-4 px-0 text-right">
                                    <a href="{{ route('home.predictions.active-season.create', ['game' => $game->id]) }}"
                                       class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

@endforeach