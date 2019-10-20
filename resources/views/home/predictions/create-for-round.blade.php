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

                            <div class="row align-items-center">
                                <div class="col-12 text-center small">
                                    {{ $game->datetime->format('d.m.Y. H:i') }}
                                </div>

                                <div class="col-6">
                                    @if($game->homeTeam)
                                        @include('home.display-partials.team', ['team' => $game->homeTeam])
                                    @endif
                                </div>

                                <div class="col-6">
                                    @if($game->awayTeam)
                                        @include('home.display-partials.team', ['team' => $game->awayTeam])
                                    @endif
                                </div>
                            </div>
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
                            <label for="away_team_score">{{ __('forms.admin.predictions.away_team.label') }}</label>
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

                    <div class="form-row">
                        <div class="form-group col-12">
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

    <script>

        let filteringUrl = '{{ route('filters.filter.scorers-by-game') }}';

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

@endpush
