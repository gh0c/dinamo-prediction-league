<div class="row text-center">
    @if($team->featured_image)
        <img src="{{ $team->logoUrl() }}"
             style="width: 60px; height: 60px; object-fit: contain"
             alt="{{ $team->name }}"
             class="img-fluid m-auto">
    @endif
</div>

<div class="row text-center">
    <span class="font-weight-bold m-auto">{{ $team->name }}</span>
</div>