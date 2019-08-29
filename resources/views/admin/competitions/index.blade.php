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

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center"></th>
                        <th scope="col">{{ __('models.games.competition._attributes.name') }}</th>
                        <th scope="col">{{ __('models.games.competition._attributes.sport') }}</th>
                        <th class="text-center">@</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($competitions as $competition)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="text-center p-0 ">
                                @if($competition->featured_image)
                                    <span class="img-thumbnail rounded-circle d-flex align-items-center"
                                          style="width: 32px; height: 32px; box-sizing: content-box;">
                                        <img src="{{ $competition->logoThumbnailUrl() }}" alt="{{ $competition->name }}"
                                             class="img-fluid m-auto">
                                    </span>
                                @endif
                            </td>
                            <td>{{ $competition->name }}</td>
                            <td>{{ $competition->sportName() }}</td>

                            <td class="text-center">
                                <a href="{{ route('admin.competitions.edit', ['competition' => $competition->id]) }}"
                                   class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#delete-confirmation-modal" data-competition_id="{{ $competition->id }}">
                                    <i class="fa fa-times-circle"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div class="row">
                    <div class="col text-center">
                        <a href="{{ route('admin.competitions.create') }}" class="btn btn-success">
                            {{ __('forms.admin.competitions._headings.create') }}
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
                    <h5 class="modal-title text-center">{{ __('forms.admin.competitions._headings.destroy') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.competitions.destroy', 0] ]) }}
                <div class="modal-body">
                    {{ __('forms.admin.competitions._headings.delete_confirmation') }}
                    <input type="hidden" name="competition_id" id="competition_id" value="0">
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
            let competitionId = $button.data('competition_id');

            $modal.find('.modal-body #competition_id').val(competitionId);
        });
    </script>

@endsection

