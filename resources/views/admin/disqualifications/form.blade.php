<div class="form-row">
    <div class="form-group col-12">
        <label for="user_id">{{ __('forms.admin.disqualifications.user.label') }}</label>
        {!! Form::select('user_id', $inputUsers, null, [
            'class' => 'form-control',
            'required' => true,
            'autofocus' => true,
            ]) !!}
        @include('forms.input-error', ['name' => 'user_id'])
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12">
        <label for="season_id">{{ __('forms.admin.disqualifications.season.label') }}</label>
        {!! Form::select('season_id', $inputSeasons, null, [
            'class' => 'form-control',
            'required' => true,
            ]) !!}
        @include('forms.input-error', ['name' => 'season_id'])
    </div>
</div>

<div class="form-row">
    <div class="form-group col-12">
        <label for="reason">{{ __('forms.admin.disqualifications.reason.label') }}</label>
        {!! Form::select('reason', $inputDisqualificationReasons, null, [
            'class' => 'form-control',
            'required' => true
            ]) !!}
        @include('forms.input-error', ['name' => 'reason'])
    </div>
</div>


<div class="text-center">
    <button type="submit" class="btn btn-primary">{{ __('forms.admin.disqualifications._submit') }}</button>

    <a href="{{ route('admin.disqualifications.index') }}" class="btn btn-danger">{{ __('forms.cancel') }}</a>
</div>
