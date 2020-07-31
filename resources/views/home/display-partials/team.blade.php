<div class="row text-center">
    @if($team->featured_image)
        <div class="col-6 offset-3 p-0">
            <img src="{{ $team->logoUrl() }}" alt="{{ $team->name }}" class="game-team-logo">
        </div>
    @endif
</div>

<div class="row text-center">
    <span class="font-weight-bold m-auto">{{ $team->name }}</span>
</div>