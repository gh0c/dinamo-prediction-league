@extends('layouts.app')

@push('stylesheets')
    <style>
        .table > tbody > tr > td {
            vertical-align: middle;
            padding: .1rem;
        }

        .table > tbody > tr > td .btn-sm {
            padding: .1rem .25rem;
        }

        .table > thead > tr > th,
        .table > tbody > tr > th {
            vertical-align: middle;
            padding-left: .1rem;
            padding-right: .1rem;
        }

    </style>
@endpush

@section('page_title', __('models.results.overall'))

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-8 offset-md-2">

                <h3>{{ __('models.results.overall') }}</h3>

                <table class="table table-sm table-hover">


                    <thead class="thead-dark">
                    <tr>
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

                        <tr>
                            <td>
                                {{ $outcomeGrouped->user->username }}
                            </td>
                            @foreach($rounds as $round)
                                <th scope="col">
                                    @if($outcomeGrouped->user->predictionOutcomes->contains('round', $round))
                                       {{ $outcomeGrouped->user->predictionOutcomes->where('round', $round)->first()->total_points }}
                                    @else
                                        -
                                    @endif
                                </th>
                            @endforeach

                            <td>
                                <strong>{{ $outcomeGrouped->total_points }}</strong>
                            </td>
                            <td>
                                {{ $outcomeGrouped->jokers_used }}
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>


            </div>

        </div>

    </div>


@endsection
