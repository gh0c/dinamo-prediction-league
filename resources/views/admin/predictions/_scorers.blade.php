<label for="first_scorer_id">{{ __('forms.admin.predictions.first_scorer.label') }}</label>

{!! Form::select('first_scorer_id', $inputScorers, null, [
    'class' => 'form-control',
]) !!}

@include('forms.input-error', ['name' => 'first_scorer_id'])