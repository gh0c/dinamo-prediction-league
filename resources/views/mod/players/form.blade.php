<div class="form-row">
    <div class="form-group col-12">
        <label for="name-input">{{ __('forms.mod.players.name.label') }}</label>
        {!! Form::text('name', null, [
            'id' => 'name-input',
            'placeholder' => __('forms.mod.players.name.placeholder'),
            'class' => 'form-control',
            'required' => true,
            'autofocus' => true,
            'autocomplete' => 'off'
            ]) !!}
        @include('forms.input-error', ['name' => 'name'])
    </div>
</div>

<div class="form-row">
    <div class="form-group col-12">
        <label for="team_id">{{ __('forms.mod.players.team.label') }}</label>
        {!! Form::select('team_id', $inputTeams, null, [
            'class' => 'form-control',
            ]) !!}
        @include('forms.input-error', ['name' => 'team_id'])
    </div>
</div>


<div class="text-center">
    <button type="submit" class="btn btn-primary">{{ __('forms.mod.players._submit') }}</button>

    <a href="{{ route('mod.players.index') }}" class="btn btn-danger">{{ __('forms.cancel') }}</a>
</div>


