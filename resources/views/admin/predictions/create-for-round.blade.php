@extends('layouts.app')

@section('page_title', __('forms.admin.predictions._headings.store'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-12 col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.predictions._headings.store') }}</h3>

                {!! Form::open(['route' => ['admin.predictions.store-for-round', 'round' => $round], 'class' => 'was-validated']) !!}

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="user_id">{{ __('forms.admin.predictions.user.label') }}</label>
                        {!! Form::select('user_id', $inputUsers, null, [
                            'class' => 'form-control',
                            'autofocus' => true,
                            'required' => true,
                            ]) !!}
                        @include('forms.input-error', ['name' => 'user_id'])
                    </div>
                </div>

                @foreach($games as $index => $game)

                    <div class="form-row border-top pt-2">
                        <div class="form-group col-12">
                            <label for="predictions[{{ $index }}][game_id]">{{ __('forms.admin.predictions.game.label') }}</label>
                            {!! Form::select('predictions[' . $index . '][game_id]', $inputGames, $game->id, [
                                'class' => 'form-control',
                                'readonly' => 'readonly',
                                'disabled' => true
                                ]) !!}
                            {!! Form::hidden('predictions[' . $index . '][game_id]', $game->id) !!}
                            @include('forms.input-error', ['name' => 'predictions[' . $index . '][game_id]'])
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-4 offset-1">
                            <label for="predictions[{{ $index }}][home_team_score]">{{ __('forms.admin.predictions.home_team.label') }}</label>
                            {!! Form::number('predictions[' . $index . '][home_team_score]', null, [
                                'class' => 'form-control text-center form-control-lg',
                                'required' => true,
                            ]) !!}
                            @include('forms.input-error', ['name' => 'predictions[' . $index . '][home_team_score]'])
                        </div>

                        <div class="form-group col-4 offset-2">
                            <label for="away_team_score">{{ __('forms.admin.predictions.away_team.label') }}</label>
                            {!! Form::number('predictions[' . $index . '][away_team_score]', null, [
                                'class' => 'form-control text-center form-control-lg',
                                'required' => true,
                            ]) !!}
                            @include('forms.input-error', ['name' => 'predictions[' . $index . '][away_team_score]'])
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <div class="form-check">
                                <input type="hidden" name="predictions[{{ $index }}][joker_used]" value="0">
                                {!! Form::checkbox('predictions[' . $index . '][joker_used]', 1, null, [
                                    'id' => 'predictions[' . $index . '][joker_used-input]', 'class' => 'form-check-input'
                                    ]) !!}
                                <label class="form-check-label"
                                       for="predictions[{{ $index }}][joker_used-input]">{{ __('forms.admin.predictions.joker_used.label') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12" id="input-scorers-{{ $index }}-container">
                            <label for="predictions[{{ $index }}][first_scorer_id]">
                                {{ __('forms.admin.predictions.first_scorer.label') }}
                            </label>

                            {!! Form::select('predictions[' . $index . '][first_scorer_id]', $inputScorers, null, [
                                'class' => 'form-control',
                            ]) !!}

                            @include('forms.input-error', ['name' => 'predictions[' . $index . '][first_scorer_id]'])
                        </div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            filterInputScorersByGame('{{ $index }}');
                        });
                    </script>



                @endforeach

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">{{ __('forms.admin.predictions._submit') }}</button>
                </div>

                <script>

                    let filteringUrl = '{{ route('admin.predictions.filter.scorers-by-game') }}';

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

                </script>


                {!! Form::close() !!}

            </div>
        </div>

    </div>


@endsection
