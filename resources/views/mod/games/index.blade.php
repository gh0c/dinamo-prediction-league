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

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-8 offset-md-2">


                <table class="table table-sm table-hover">

                    @foreach($games->groupBy('round') as $round => $gamesRound)

                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">{{ $round }}. {{ mb_strtolower(__('models.games.game._attributes.round')) }}</th>
                            <th scope="col">{{ __('models.games.game._attributes.home_team') }}</th>
                            <th scope="col">{{ __('models.games.game._attributes.away_team') }}</th>
                            <th scope="col">{{ __('models.games.game._attributes.competition') }}</th>
                            <th class="text-center">@</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($gamesRound as $game)
                            <tr>
                                <td>{{ $game->datetime->format('d.m.Y. H:i') }}</td>
                                <td>
                                    @if($game->homeTeam)
                                        <span>
                                            @if($game->homeTeam->featured_image)
                                                <img src="{{ $game->homeTeam->logoThumbnailUrl() }}"
                                                     style="width: 22px; height: 22px; object-fit: contain"
                                                     alt="{{ $game->homeTeam->name }}"
                                                     class="img-fluid m-auto">
                                            @endif
                                        </span>
                                        <span class="ml-1">{{ $game->homeTeam->name }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($game->awayTeam)
                                        <span>
                                            @if($game->awayTeam->featured_image)
                                                <img src="{{ $game->awayTeam->logoThumbnailUrl() }}"
                                                     style="width: 22px; height: 22px; object-fit: contain"
                                                     alt="{{ $game->awayTeam->name }}"
                                                     class="img-fluid m-auto">
                                            @endif
                                        </span>
                                        <span class="ml-1">{{ $game->awayTeam->name }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($game->competition)
                                        @if($game->competition)
                                            <span>
                                                @if($game->competition->featured_image)
                                                    <img src="{{ $game->competition->logoThumbnailUrl() }}"
                                                         style="width: 18px; height: 18px; object-fit: contain"
                                                         alt="{{ $game->competition->name }}"
                                                         class="img-fluid m-auto">
                                                @endif
                                            </span>
                                            <span class="ml-1">{{ $game->competition->name }}</span>
                                        @endif
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('mod.games.edit', ['game' => $game->id]) }}"
                                       class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#delete-confirmation-modal" data-game_id="{{ $game->id }}">
                                        <i class="fa fa-times-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    @endforeach
                </table>


                <div class="row">
                    <div class="col text-center">
                        <a href="{{ route('mod.games.create') }}" class="btn btn-success">
                            {{ __('forms.mod.games._headings.create') }}
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
                    <h5 class="modal-title text-center">{{ __('forms.mod.games._headings.destroy') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'DELETE', 'route' => ['mod.games.destroy', 0] ]) }}
                <div class="modal-body">
                    {{ __('forms.mod.games._headings.delete_confirmation') }}
                    <input type="hidden" name="game_id" id="game_id" value="0">
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
            let gameId = $button.data('game_id');

            $modal.find('.modal-body #game_id').val(gameId);
        });
    </script>

@endsection

