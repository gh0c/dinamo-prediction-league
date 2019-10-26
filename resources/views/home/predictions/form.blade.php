{{-- Game display --}}
<div class="form-row border-top pt-2">
    <div class="form-group col-12">

        {!! Form::hidden('game_id', $game->id) !!}

        @include('home.display-partials.prediction-game')

        @include('forms.input-error', ['name' => 'game_id'])
    </div>
</div>

<div class="form-row">

    <div class="form-group col-6">
        <label for="home_team_score">{{ __('forms.admin.predictions.home_team.label') }}</label>
        {!! Form::number('home_team_score', null, [
            'class' => 'form-control text-center form-control-lg',
            'required' => true,
            'min' => 0,
        ]) !!}
        @include('forms.input-error', ['name' => 'home_team_score'])
    </div>

    <div class="form-group col-6">
        <label for="away_team_score">{{ __('forms.admin.predictions.away_team.label') }}</label>
        {!! Form::number('away_team_score', null, [
            'class' => 'form-control text-center form-control-lg',
            'required' => true,
            'min' => 0,
        ]) !!}
        @include('forms.input-error', ['name' => 'away_team_score'])
    </div>

</div>

<div class="form-row">
    <div class="form-group col-12 mb-0">
        <div class="form-check">
            <input type="hidden" name="joker_used" value="0">
            {!! Form::checkbox('joker_used', 1, null, [
                'id' => 'joker_used-input', 'class' => 'form-check-input'
                ]) !!}
            <label class="form-check-label"
                   for="joker_used-input">{{ __('forms.admin.predictions.joker_used.label') }}</label>
            @include('forms.input-error', ['name' => 'joker_used'])
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-12">
        <div id="input-scorers-container">
            <label for="first_scorer_id">
                {{ __('forms.filters.partials.scorers.first_scorer._label') }}
            </label>

            {!! Form::select('first_scorer_id', $inputScorers, null, [
                'class' => 'form-control',
            ]) !!}
        </div>
        @include('forms.input-error', ['name' => 'first_scorer_id'])
    </div>

</div>

<div class="text-center">
    <button type="submit" class="btn btn-primary">{{ __('forms.home.predictions._submit') }}</button>

    <a href="{{ route('home.index') }}"
       class="btn btn-danger">{{ __('forms.cancel') }}</a>
</div>

<script>

    let filteringUrl = '{{ route('filters.filter.scorers-by-game') }}';

    function filterInputScorersByGame() {
        let selectedGameValue = $(':input[name="game_id"]').val();

        let currentScorerSelection = $(':input[name="first_scorer_id"]').val();

        let $cont = $('#input-scorers-container');
        let params = {game_id: selectedGameValue};

        ajaxCall(filteringUrl, params).then(response => {
            $cont.html(response);

            // preserve selection from before filtering
            let $scorerInput = $cont.find(':input[name="first_scorer_id"]');
            if ($scorerInput.find('option[value="' + currentScorerSelection + '"]').length) {
                $scorerInput.val(currentScorerSelection);
            }
        });

    }

    $(document).ready(function () {
        filterInputScorersByGame();
    });
</script>

