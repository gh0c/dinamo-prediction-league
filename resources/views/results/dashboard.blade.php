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
                                        {{ $round }}. {{ mb_strtolower(__('models.results.round')) }}
                                    </h5>
                                    <a href="{{ route('results.round', ['season' => $season->id, 'round' => $round]) }}"
                                       class="btn btn-primary">
                                        {{ __('models.results.collection_for_round', ['round' => $round]) }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>


@endsection

