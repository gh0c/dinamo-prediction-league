<div class="row align-items-center">

    <div class="col-4 col-lg-3 text-right">
        <span class="text-muted small d-lg-none d-xl-inline-block">{{ __('pages.home.prediction.prediction._label') }}</span>
        <i class="fa fa-fw text-muted fa-ticket d-none d-lg-inline-block d-xl-none"></i>
    </div>

    <div class="col-4 col-lg-5">
        @include('home.display-partials.predicted-result')
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
