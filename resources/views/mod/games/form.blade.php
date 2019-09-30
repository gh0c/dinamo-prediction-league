<div class="form-row">
    <div class="form-group col-9">
        <label for="season_id">{{ __('forms.mod.games.season.label') }}</label>
        {!! Form::select('season_id', $inputSeasons, null, [
            'class' => 'form-control',
            'required' => true,
            'autofocus' => true,
            ]) !!}
        @include('forms.input-error', ['name' => 'season_id'])
    </div>

    <div class="form-group col-3">
        <label for="round">{{ __('forms.mod.games.round.label') }}</label>
        {!! Form::number('round', null, [
            'class' => 'form-control',
            'required' => true,
            'min' => 1,
            ]) !!}
        @include('forms.input-error', ['name' => 'round'])
    </div>

    <div class="form-group col-12">
        <label for="competition_id">{{ __('forms.mod.games.competition.label') }}</label>
        {!! Form::select('competition_id', $inputCompetitions, null, [
            'class' => 'form-control',
            'required' => true,
            ]) !!}
        @include('forms.input-error', ['name' => 'competition_id'])
    </div>

</div>

<div class="form-row">
    <div class="form-group col-7">
        <label for="datetime_date">{{ __('forms.mod.games.datetime_date.label') }}</label>
        {!! Form::date('datetime_date', null, [
            'class' => 'form-control',
            'required' => true,
            ]) !!}
        @include('forms.input-error', ['name' => 'datetime_date'])
    </div>
    <div class="form-group col-5">
        <label for="datetime_time">{{ __('forms.mod.games.datetime_time.label') }}</label>
        {!! Form::time('datetime_time', null, [
            'class' => 'form-control',
            'required' => true,
            ]) !!}
        @include('forms.input-error', ['name' => 'datetime_time'])
    </div>
</div>

<div class="form-row">
    <div class="form-group col-12">
        <label for="home_team_id">{{ __('forms.mod.games.home_team.label') }}</label>
        {!! Form::select('home_team_id', $inputHomeTeams, null, [
            'class' => 'form-control',
            ]) !!}
        @include('forms.input-error', ['name' => 'home_team_id'])
    </div>
</div>

<div class="form-row">
    <div class="form-group col-12">
        <label for="away_team_id">{{ __('forms.mod.games.away_team.label') }}</label>
        {!! Form::select('away_team_id', $inputAwayTeams, null, [
            'class' => 'form-control',
            ]) !!}
        @include('forms.input-error', ['name' => 'away_team_id'])
    </div>
</div>


<div class="text-center">
    <button type="submit" class="btn btn-primary">{{ __('forms.mod.games._submit') }}</button>

    <a href="{{ route('mod.games.index') }}" class="btn btn-danger">{{ __('forms.cancel') }}</a>
</div>


