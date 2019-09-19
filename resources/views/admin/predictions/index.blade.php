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

@section('page_title', __('models.predictions.prediction.collection'))

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-8 offset-md-2">


                <table class="table table-sm table-hover">

                    @foreach($predictions->groupBy('game.round') as $round => $predictionsRound)

                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" colspan="4">
                                {{ $round }}
                                . {{ mb_strtolower(__('models.predictions.prediction._attributes.game.round')) }}
                            </th>
                        </tr>
                        </thead>


                        @foreach($predictionsRound->groupBy('game_id') as $game => $predictionsGame)

                            <thead>
                            <tr>
                                <th scope="col">{{ $predictionsGame->first()->game->game_description }}</th>
                                <th scope="col">
                                    @if($predictionsGame->first()->game->result)
                                        {{ $predictionsGame->first()->game->result->result }}
                                    @endif
                                </th>
                                <th scope="col">
                                    @if($predictionsGame->first()->game->goalScorers->isNotEmpty())
                                        {{ $predictionsGame->first()->game->first_scorer->name }}
                                    @endif
                                </th>
                                <th class="text-center">@</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($predictionsGame as $prediction)
                                <tr>
                                    <td>
                                        {{ $prediction->user->username }}
                                    </td>
                                    <td>
                                        {{ $prediction->predicted_result }}
                                    </td>
                                    <td>
                                        @if($prediction->joker_used)
                                            <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/joker-61-563878.png"
                                                 alt="" style="contain: content; width: 20px;">
                                        @else
                                            @if($prediction->firstScorer)
                                                {{ $prediction->firstScorer->name }}
                                            @endif

                                        @endif
                                    </td>

                                    <td class="text-center">

                                        <a href="{{ route('admin.predictions.edit', ['prediction' => $prediction->id]) }}"
                                           class="btn btn-sm btn-outline-info">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#delete-confirmation-modal"
                                                data-prediction_id="{{ $prediction->id }}">
                                            <i class="fa fa-times-circle"></i>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                        @endforeach

                    @endforeach
                </table>


                <div class="row">
                    <div class="col text-center">
                        <a href="{{ route('admin.predictions.create') }}" class="btn btn-success">
                            {{ __('forms.admin.predictions._headings.create') }}
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="delete-confirmation-modal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">{{ __('forms.admin.predictions._headings.destroy') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.predictions.destroy', 0] ]) }}
                <div class="modal-body">
                    {{ __('forms.admin.predictions._headings.delete_confirmation') }}
                    <input type="hidden" name="prediction_id" id="prediction_id" value="0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('forms._modals.buttons.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('forms._modals.buttons.confirm') }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>

    </div>

    <script>
        $('#delete-confirmation-modal').on('show.bs.modal', function (e) {
            let $modal = $(this);
            let $button = $(e.relatedTarget);
            let predictionId = $button.data('prediction_id');

            $modal.find('.modal-body #predictionId').val(predictionId);
        });
    </script>

@endsection

