@extends('layouts.app')

@section('page_title', __('models.games.team.collection'))

@section('content')

    <div class="container">

        <div class="row">

            @foreach($teams->groupBy('sport') as $teamsBySport)

                <div class="col-12 col-lg-6">

                    <table class="table table-sm table-hover table-middle-aligned-cells">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="text-center"></th>
                            <th scope="col">{{ __('models.games.team._attributes.name') }}</th>
                            <th scope="col">{{ __('models.games.team._attributes.sport') }}</th>
                            <th class="text-center">@</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($teamsBySport as $team)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td class="text-center p-0 ">
                                    @if($team->featured_image)
                                        <span class="img-thumbnail rounded-circle d-flex align-items-center"
                                              style="width: 32px; height: 32px; box-sizing: content-box;">
                                            <img src="{{ $team->logoThumbnailUrl() }}" alt="{{ $team->name }}"
                                                 class="img-fluid m-auto">
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $team->name }}</td>
                                <td>{{ __('models.games.sport._values.' . $team->sport) }}</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.teams.edit', ['team' => $team->id]) }}"
                                       class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#delete-confirmation-modal" data-team_id="{{ $team->id }}">
                                        <i class="fa fa-times-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>

            @endforeach

        </div>

        <div class="row">
            <div class="col text-center">
                <a href="{{ route('admin.teams.create') }}" class="btn btn-success" tabindex="1">
                    {{ __('forms.admin.teams._headings.create') }}
                </a>
            </div>
        </div>

    </div>

    <div class="modal fade" id="delete-confirmation-modal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">{{ __('forms.admin.teams._headings.destroy') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.teams.destroy', 0] ]) }}
                <div class="modal-body">
                    {{ __('forms.admin.teams._headings.delete_confirmation') }}
                    <input type="hidden" name="team_id" id="team_id" value="0">
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
            let teamId = $button.data('team_id');

            $modal.find('.modal-body #team_id').val(teamId);
        });
    </script>

@endsection

