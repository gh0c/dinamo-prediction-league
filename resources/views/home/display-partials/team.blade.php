<div class="row text-center">
    @if($team->featured_image)
        <div class="col-6 offset-3 p-0">
            <img src="{{ $team->logoUrl() }}"
                 style="max-width: 100%; height: 50px; object-fit: contain"
                 alt="{{ $team->name }}"
                 class="img-fluid m-auto">
        </div>
    @endif
</div>

<div class="row text-center">
    <span class="font-weight-bold m-auto">{{ $team->name }}</span>
</div>