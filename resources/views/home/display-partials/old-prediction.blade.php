<div class="row align-items-center">

    <div class="col-4 text-right">
        <span class="text-muted small d-lg-none d-xl-inline-block">{{ __('pages.home.prediction.prediction._label') }}</span>
        <i class="fa fa-fw text-muted fa-ticket d-none d-lg-inline-block d-xl-none"></i>
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