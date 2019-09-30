@extends('layouts.app')

@section('page_title', __('models.predictions.prediction.collection'))

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-12 col-l-8 offset-l-2 col-xl-10 offset-xl-1">

                <h3>{{ $season->name }}</h3>

                <div class="row">
                    @foreach($rounds as $round)
                        <div class="col-6 col-md-4 col-xl-3 mb-1">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $round['round'] }}. {{ mb_strtolower(__('models.predictions.prediction._attributes.game.round')) }}
                                    </h5>
                                    <p class="card-text">{{ __('models.games.game.count') }}: {{ $round['games_per_round'] }}</p>
                                    <a href="{{ route('admin.predictions.seasons.rounds.index', ['season' => $season->id, 'round' => $round['round']]) }}"
                                       class="btn btn-primary">
                                        {{ __('models.predictions.prediction.collection') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>

        </div>

        <div class="row">
            <div class="col text-center">
                <a href="{{ route('admin.predictions.seasons.create', ['season' => $season->id]) }}" class="btn btn-success" tabindex="1">
                    {{ __('forms.admin.predictions._headings.create') }}
                </a>
            </div>
        </div>

    </div>


@endsection

