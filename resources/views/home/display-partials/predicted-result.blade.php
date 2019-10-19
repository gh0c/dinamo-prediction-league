<div class="@if($prediction->joker_used && $prediction->joker_outcome) prediction-with-joker {{ $prediction->joker_outcome }} @endif">
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
            <span class="m-auto">
                @if($prediction->firstScorer->team_id)
                    @if($prediction->firstScorer->team->featured_image)
                        <img src="{{ $prediction->firstScorer->team->logoThumbnailUrl() }}"
                             alt="{{ $prediction->firstScorer->team->name }}" class="player-team-logo">
                    @endif
                @endif
                <span class="small">{{ $prediction->firstScorer->name }}</span>
            </span>
        @elseif($prediction->joker_used)
            <span class="m-auto small">
                <span class="font-weight-bold align-middle">:JOKER:</span>
            </span>
        @endif
    </div>
</div>