@extends('layouts.app')

@push('stylesheets')
    <style>
        .table > tbody > tr > td {
            vertical-align: middle;
        }
        .table > tbody > tr > th {
            vertical-align: middle;
        }
    </style>
@endpush

@section('page_title', __('models.predictions.disqualification.collection'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8 offset-md-2">

                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('models.predictions.disqualification._attributes.season') }}</th>
                        <th scope="col">{{ __('models.predictions.disqualification._attributes.user') }}</th>
                        <th scope="col">{{ __('models.predictions.disqualification._attributes.reason') }}</th>
                        <th class="text-center">@</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($disqualifications as $disqualification)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>

                            <td>{{ $disqualification->season->name }}</td>
                            <td>{{ $disqualification->user->username}}</td>
                            <td>{{ __('models.predictions.disqualification_reason._values.' . $disqualification->reason) }}</td>

                            <td class="text-center">
                                <a href="{{ route('admin.disqualifications.edit', ['disqualification' => $disqualification->id]) }}"
                                   class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#delete-confirmation-modal" data-disqualification_id="{{ $disqualification->id }}">
                                    <i class="fa fa-times-circle"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div class="row">
                    <div class="col text-center">
                        <a href="{{ route('admin.disqualifications.create') }}" class="btn btn-success">
                            {{ __('forms.admin.disqualifications._headings.create') }}
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
                    <h5 class="modal-title text-center">{{ __('forms.admin.disqualifications._headings.destroy') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.disqualifications.destroy', 0] ]) }}
                <div class="modal-body">
                    {{ __('forms.admin.disqualifications._headings.delete_confirmation') }}
                    <input type="hidden" name="disqualification_id" id="disqualification_id" value="0">
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
            let disqualificationId = $button.data('disqualification_id');

            $modal.find('.modal-body #disqualification_id').val(disqualificationId);
        });
    </script>

@endsection

