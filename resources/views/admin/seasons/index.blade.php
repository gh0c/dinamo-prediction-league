@extends('layouts.app')

@section('page_title', __('models.games.season.collection'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('models.games.season._attributes.name') }}</th>
                        <th scope="col" class="text-center">{{ __('models.games.season._attributes.is_active') }}</th>
                        <th class="text-center">@</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($seasons as $season)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $season->name }}</td>
                            <td class="text-center">
                                @if($season->is_active)
                                    <i class="fa fa-fw fa-check-circle"></i>
                                @else
                                    <i class="fa fa-fw fa-circle-o"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.seasons.edit', ['season' => $season->id]) }}"
                                   class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-edit"></i>
                                </a>

                                @if(Auth::user()->is_super_admin)
                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#delete-confirmation-modal" data-season_id="{{ $season->id }}">
                                        <i class="fa fa-times-circle"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

        </div>

        <div class="row">
            <div class="col text-center">
                <a href="{{ route('admin.seasons.create') }}" class="btn btn-success" tabindex="1">
                    {{ __('forms.admin.seasons._headings.create') }}
                </a>
            </div>
        </div>

    </div>

    <div class="modal fade" id="delete-confirmation-modal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">{{ __('forms.admin.seasons._headings.destroy') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.seasons.destroy', 0] ]) }}
                <div class="modal-body">
                    {{ __('forms.admin.seasons._headings.delete_confirmation') }}
                    <input type="hidden" name="season_id" id="season_id" value="0">
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
            let seasonId = $button.data('season_id');

            $modal.find('.modal-body #season_id').val(seasonId);
        });
    </script>

@endsection

