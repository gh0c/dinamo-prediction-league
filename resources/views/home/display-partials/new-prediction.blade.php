<div class="row align-items-center">

    <div class="col-3 col-xl-3 text-center px-0">
        <span class="text-muted small d-none d-sm-inline-block d-lg-none d-xl-inline-block">{{ __('pages.home.prediction.prediction._label') }}</span>
        <i class="fa fa-fw text-muted fa-ticket d-inline-block d-sm-none d-lg-inline-block d-xl-none"></i>
    </div>

    <div class="col-6 col-xl-5">
        @include('home.display-partials.predicted-result')
    </div>

    <div class="col-3 col-xl-4 px-0">
        <a href="{{ route('home.predictions.edit', ['prediction' => $prediction->id]) }}"
           class="btn btn-sm btn-outline-info">
            <i class="fa fa-edit"></i>
        </a>

        <button class="btn btn-xs btn-danger" data-toggle="modal"
                data-target="#delete-prediction-confirmation-modal"
                data-prediction_id="{{ $prediction->id }}">
            <i class="fa fa-times-circle"></i>
        </button>
    </div>

</div>
