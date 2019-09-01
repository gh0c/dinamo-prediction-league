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
                        <th scope="col">{{ __('models.games.player._attributes.name') }}</th>
                        <th scope="col">{{ __('models.games.player._attributes.team') }}</th>
                        <th class="text-center">@</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($players as $player)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                {{ $player->name }}
                                @if(!$player->is_mod_approved)
                                    <i class="fa fa-fw fa-exclamation-circle text-danger"
                                       title="{{ __('forms.mod.players.is_mod_approved.title') }}"></i>
                                @endif
                            </td>
                            <td class="d-flex align-items-center">
                                @if($player->team)
                                    <span>
                                        @if($player->team->featured_image)
                                            <img src="{{ $player->team->logoThumbnailUrl() }}"
                                                 style="width: 22px; height: 22px; object-fit: contain"
                                                 alt="{{ $player->team->name }}"
                                                 class="img-fluid m-auto">
                                        @endif
                                    </span>
                                    <span class="ml-1">{{ $player->team->name }}</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('mod.players.edit', ['player' => $player->id]) }}"
                                   class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#delete-confirmation-modal" data-player_id="{{ $player->id }}">
                                    <i class="fa fa-times-circle"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div class="row">
                    <div class="col text-center">
                        <a href="{{ route('mod.players.create') }}" class="btn btn-success">
                            {{ __('forms.mod.players._headings.create') }}
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
                    <h5 class="modal-title text-center">{{ __('forms.mod.players._headings.destroy') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'DELETE', 'route' => ['mod.players.destroy', 0] ]) }}
                <div class="modal-body">
                    {{ __('forms.mod.players._headings.delete_confirmation') }}
                    <input type="hidden" name="player_id" id="player_id" value="0">
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
            let playerId = $button.data('player_id');

            $modal.find('.modal-body #player_id').val(playerId);
        });
    </script>

@endsection

