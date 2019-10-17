@extends('layouts.app')

@push('stylesheets')
    <style>
        .table > tbody > tr > * {
            padding: .1rem;
        }
    </style>
@endpush

@section('page_title', __('models.predictions.prediction.collection_for_round', ['round' => $round]))

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-8 offset-md-2">

                <h3>{{ __('models.predictions.prediction.collection_for_round', ['round' => $round]) }}</h3>

                <table class="table table-sm table-hover table-middle-aligned-cells">

                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
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

                        <tr @if(Auth::user() && Auth::user()->id == $outcome->user->id) class="bg-primary text-white" @endif>
                            <td>{{ $loop->iteration }}.</td>
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
                                    {!! Html::image('/img/jester_32.png', 'Joker', ['style' => 'contain: content; width: 18px;']) !!}
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
