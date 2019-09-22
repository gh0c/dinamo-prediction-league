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

@section('page_title', __('models.predictions.prediction.collection_for_round', ['round' => $round]))

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-8 offset-md-2">

                <h3>{{ __('models.predictions.prediction.collection_for_round', ['round' => $round]) }}</h3>

                <table class="table table-sm table-hover">

                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">
                            {{ __('models.predictions.prediction._attributes.user') }}
                        </th>
                        <th scope="col">
                            {{ __('models.predictions.prediction._attributes.points') }}
                        </th>
                        <th scope="col">
                            {{ __('models.predictions.prediction._attributes.bonus_points') }}
                        </th>
                        <th scope="col">
                            {{ __('models.predictions.prediction._attributes.total_points') }}
                        </th>
                        <th scope="col">
                            {{ __('models.predictions.prediction._attributes.jokers_used') }}
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($results as $outcome)

                        <tr>
                            <td>
                                {{ $outcome->user->username }}
                            </td>
                            <td>
                                {{ $outcome->points }}
                            </td>
                            <td>
                                {{ $outcome->bonus_points }}
                            </td>
                            <td>
                                <strong>{{ $outcome->total_points }}</strong>
                            </td>
                            <td>
                                @for($i = 0; $i < $outcome->jokers_used; $i++)
                                    <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/joker-61-563878.png"
                                         alt="" style="contain: content; width: 18px;">
                                @endfor
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>


            </div>

        </div>

    </div>


@endsection
