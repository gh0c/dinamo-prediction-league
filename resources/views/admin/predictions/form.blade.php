
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

<div class="form-row">
    <div class="form-group col-12">
        <label for="game_id">{{ __('forms.admin.predictions.game.label') }}</label>
        {!! Form::select('game_id', $inputGames, null, [
            'class' => 'form-control',
            ]) !!}
        @include('forms.input-error', ['name' => 'game_id'])
    </div>
</div>

<div class="form-row">

    <div class="form-group col-4 offset-1">
        <label for="home_team_score">{{ __('forms.admin.predictions.home_team.label') }}</label>
        {!! Form::number('home_team_score', null, [
            'class' => 'form-control text-center form-control-lg',
            'required' => true,
        ]) !!}
        @include('forms.input-error', ['name' => 'home_team_score'])
    </div>

    <div class="form-group col-4 offset-2">
        <label for="away_team_score">{{ __('forms.admin.predictions.away_team.label') }}</label>
        {!! Form::number('away_team_score', null, [
            'class' => 'form-control text-center form-control-lg',
            'required' => true,
        ]) !!}
        @include('forms.input-error', ['name' => 'away_team_score'])
    </div>

</div>

<div class="form-row">
    <div class="form-group col-12">
        <div class="form-check">
            <input type="hidden" name="joker_used" value="0">
            {!! Form::checkbox('joker_used', 1, null, [
                'id' => 'joker_used-input', 'class' => 'form-check-input'
                ]) !!}
            <label class="form-check-label"
                   for="joker_used-input">{{ __('forms.admin.predictions.joker_used.label') }}</label>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-12" id="input-scorers-container">
        @include('admin.predictions._scorers')
    </div>
</div>

<div class="text-center">
    <button type="submit" class="btn btn-primary">{{ __('forms.admin.predictions._submit') }}</button>

    <a href="{{ route('admin.predictions.seasons.index', ['season' => $season->id]) }}" class="btn btn-danger">{{ __('forms.cancel') }}</a>
</div>

<script>
    $(document).on('change.filtering', ':input[name="game_id"]', function () {
        filterInputScorersByGame();
    });

    let filteringUrl = '{{ route('admin.predictions.filter.scorers-by-game') }}';

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
