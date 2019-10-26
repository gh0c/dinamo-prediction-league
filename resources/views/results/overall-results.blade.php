@extends('layouts.app')

@push('stylesheets')
    <style>
        .table > tbody > tr > * {
            padding: .1rem;
        }
    </style>
@endpush

@section('page_title', __('models.results.overall'))

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-8 offset-md-2">

                <h3>{{ __('models.results.overall') }}</h3>

                <div class="table-responsive">
                    <table class="table table-sm table-hover table-middle-aligned-cells">

                        <thead class="thead-dark">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">
                                {{ __('models.predictions.prediction._attributes.user') }}
                            </th>
                            @foreach($rounds as $round)
                                <th scope="col">
                                    {{ $round }}.
                                </th>
                            @endforeach
                            <th scope="col">
                                {{ __('models.predictions.prediction._attributes.total_points') }}
                            </th>
                            <th scope="col">
                                {{ __('models.predictions.prediction._attributes.jokers_used') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($results as $outcomeGrouped)

                            <tr @if(Auth::user() && Auth::user()->id == $outcomeGrouped->user->id) class="bg-primary text-white" @endif>
                                <td>{{ $loop->iteration }}.</td>
                                <td>
                                    {{ $outcomeGrouped->user->username }}
                                </td>
                                @foreach($rounds as $round)
                                    <td>
                                        @if($outcomeGrouped->user->predictionOutcomes->contains('round', $round))
                                            {{ $outcomeGrouped->user->predictionOutcomes->where('round', $round)->first()->total_points }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endforeach

                                <td>
                                    <strong>{{ $outcomeGrouped->total_points }}</strong>
                                </td>
                                <td>
                                    {{ $outcomeGrouped->jokers_used }}
                                </td>

                            </tr>
                        @endforeach

                        @foreach($disqualifications as $disqualification)
                            <tr class="text-muted">
                                <td>-</td>
                                <td>
                                    {{ $disqualification->user->username }}
                                </td>
                                <td colspan="{{ $rounds->count() + 2 }}">
                                    {{ __('models.predictions.disqualification.name') }} -
                                    {{ __('models.predictions.disqualification_reason._values.' . $disqualification->reason) }}
                                </td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>


            </div>

        </div>

    </div>


@endsection
