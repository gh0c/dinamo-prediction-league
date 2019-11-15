@extends('layouts.dashboard')

@section('page_title', __('forms.home.predictions._headings.store_for_round', ['round' => $round]))

@section('dashboard-content')

    <div class="container-fluid py-1">

        {!! Form::open(['route' => [
            'home.predictions.rounds.store', 'round' => $round
        ], 'class' => 'was-validated']) !!}


        <div class="row">
            <div class="col-12 text-center">

                <h3>{{ __('forms.home.predictions._headings.store_for_round', ['round' => $round]) }}</h3>

            </div>
        </div>


        <div class="row justify-content-center">

            @foreach($games as $index => $game)

                <div class="col-12 col-md-6 col-xxl-4 text-center">

                    {{-- Game display --}}
                    <div class="form-row border-top pt-2">
                        <div class="form-group col-12">

                            {!! Form::hidden('predictions[' . $index . '][game_id]', $game->id) !!}

                            @include('home.display-partials.prediction-game')

                            @include('forms.input-error', ['name' => 'predictions[' . $index . '][game_id]'])
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-6">
                            <label for="predictions[{{ $index }}][home_team_score]">{{ __('forms.admin.predictions.home_team.label') }}</label>
                            {!! Form::number('predictions[' . $index . '][home_team_score]', null, [
                                'class' => 'form-control text-center form-control-lg',
                                'required' => true,
                                'min' => 0,
                            ]) !!}
                            @include('forms.input-error', ['name' => 'predictions[' . $index . '][home_team_score]'])
                        </div>

                        <div class="form-group col-6">
                            <label for="predictions[{{ $index }}][away_team_score]">{{ __('forms.admin.predictions.away_team.label') }}</label>
                            {!! Form::number('predictions[' . $index . '][away_team_score]', null, [
                                'class' => 'form-control text-center form-control-lg',
                                'required' => true,
                                'min' => 0,
                            ]) !!}
                            @include('forms.input-error', ['name' => 'predictions[' . $index . '][away_team_score]'])
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <div class="form-check">
                                <input type="hidden" name="predictions[{{ $index }}][joker_used]" value="0">
                                {!! Form::checkbox('predictions[' . $index . '][joker_used]', 1, null, [
                                    'id' => 'predictions[' . $index . '][joker_used-input]', 'class' => 'form-check-input'
                                    ]) !!}
                                <label class="form-check-label"
                                       for="predictions[{{ $index }}][joker_used-input]">{{ __('forms.admin.predictions.joker_used.label') }}</label>
                                @include('forms.input-error', ['name' => 'predictions[' . $index . '][joker_used]'])
                            </div>
                        </div>
                    </div>

                    <div class="form-row align-items-center">
                        <div class="form-group col-10">
                            <div id="input-scorers-{{ $index }}-container">
                                <label for="predictions[{{ $index }}][first_scorer_id]">
                                    {{ __('forms.filters.partials.scorers.first_scorer._label') }}
                                </label>

                                {!! Form::select('predictions[' . $index . '][first_scorer_id]', $inputScorers, null, [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            @include('forms.input-error', ['name' => 'predictions[' . $index . '][first_scorer_id]'])
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal"
                                    data-target="#add-player-modal-game-idx-{{ $index }}">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>

                    </div>

                    <script>
                        $(document).ready(function () {
                            filterInputScorersByGame('{{ $index }}');
                        });
                    </script>

                </div>

            @endforeach

        </div>


        <div class="row">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary">{{ __('forms.home.predictions._submit') }}</button>

                <a href="{{ route('home.index') }}" class="btn btn-danger">
                    {{ __('forms.cancel') }}
                </a>
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@endsection

@push('scripts-foot')

    @foreach($games as $index => $game)

        <div class="modal fade" id="add-player-modal-game-idx-{{ $index }}" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">{{ __('forms.home.predictions._headings.add_player') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {!! Form::open(['class' => 'add-player-form was-validated']) !!}

                    {!! Form::hidden('form_index', $index) !!}
                    <div class="modal-body">
                        <p class="text-left">
                            {{ __('forms.home.predictions._headings.add_player_info') }}
                        </p>

                        <div class="form-row">
                            <div class="form-check form-check-inline">
                                {!! Form::radio('player_team_id', $game->home_team_id, null,
                                ['required' => true, 'id' => 'team-' . $game->home_team_id]) !!}
                                <label class="form-check-label"
                                       for="team-{{ $game->home_team_id }}">{{ $game->homeTeam->name }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::radio('player_team_id', $game->away_team_id, null,
                                ['required' => true, 'id' => 'team-' . $game->away_team_id]) !!}
                                <label class="form-check-label"
                                       for="team-{{ $game->away_team_id }}">{{ $game->awayTeam->name }}</label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-10 col-xl-8 offset-1 offset-xl-2">
                                <label for="player_name">{{ __('forms.mod.players.name.label') }}</label>
                                {!! Form::text('player_name', null, ['class' => 'form-control','required' => true, 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
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

    @endforeach

    <script>

        let filteringUrl = '{{ route('filters.filter.scorers-by-game') }}';

        let addingPlayerUrl = '{{ route('home.players.create') }}';

        function filterInputScorersByGame(index) {
            let selectedGameValue = $(':input[name="predictions[' + index + '][game_id]"]').val();

            let currentScorerSelection = $(':input[name="predictions[' + index + '][first_scorer_id]"]').val();

            let $cont = $('#input-scorers-' + index + '-container');
            let params = {game_id: selectedGameValue};
            ajaxCall(filteringUrl, params).then(response => {
                $cont.html(response);

                // replace "id", "name" and "for" attributes
                $cont.find('label').attr('for', 'predictions[' + index + '][first_scorer_id]');
                $cont.find(':input').prop('name', 'predictions[' + index + '][first_scorer_id]');

                // preserve selection from before filtering
                let $scorerInput = $cont.find(':input[name="predictions[' + index + '][first_scorer_id]"]');
                if ($scorerInput.find('option[value="' + currentScorerSelection + '"]').length) {
                    $scorerInput.val(currentScorerSelection);
                }
            });

        }

        $(document).on('submit', '.add-player-form', function (e) {
            e.preventDefault();
            let $form = $(this);

            let formIndex = $form.find(':input[name=form_index]').val();

            ajaxCall(addingPlayerUrl, $form.serializeArray()).then(() => {
                $form[0].reset();
                $form.closest('.modal').modal('hide');
                filterInputScorersByGame(formIndex);
            });
        });

    </script>



@endpush
