<div class="row align-items-center">

    <div class="col-3 col-xl-3 text-center px-0">
        <span class="text-muted small d-none d-sm-inline-block d-lg-none d-xl-inline-block">{{ __('pages.home.prediction.prediction._label') }}</span>
        <i class="fa fa-fw text-muted fa-ticket d-inline-block d-sm-none d-lg-inline-block d-xl-none"></i>
    </div>

    <div class="col-6 col-xl-5">
        @include('home.display-partials.predicted-result')
    </div>

    <div class="col-3 col-xl-4 px-0">
        @if($prediction->points !== null)
            <div class="d-inline-block text-center">
                <span class="text-muted small">{{ __('pages.home.prediction.points._label') }}</span>
                <br>
                <span>{{ $prediction->points}}</span>
            </div>
        @endif
    </div>

</div>
