<div class="form-row">
    <div class="form-group col-12">
        <label for="name-input">{{ __('forms.admin.seasons.name.label') }}</label>
        {!! Form::text('name', null, [
            'id' => 'name-input',
            'placeholder' => __('forms.admin.seasons.name.placeholder'),
            'class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : ''),
            'required' => true
            ]) !!}
        @include('forms.input-error', ['name' => 'name'])
    </div>
</div>

<div class="form-row">
    <div class="form-group col-5">
        <div class="form-check">
            <input type="hidden" name="is_active" value="0">
            {!! Form::checkbox('is_active', 1, null, [
                'id' => 'is_active-input', 'class' => 'form-check-input'
                ]) !!}
            <label class="form-check-label"
                   for="is_active-input">{{ __('forms.admin.seasons.is_active.label') }}</label>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-5">
        <label for="jokers_available">{{ __('forms.admin.seasons.jokers_available.label') }}</label>
        {!! Form::number('jokers_available', null, [
            'class' => 'form-control',
            'required' => true,
            'min' => 0
        ]) !!}
        @include('forms.input-error', ['name' => 'jokers_available'])
    </div>
</div>

<div class="text-center">
    <button type="submit" class="btn btn-primary">{{ __('forms.admin.seasons._submit') }}</button>

    <a href="{{ route('admin.seasons.index') }}" class="btn btn-danger">{{ __('forms.cancel') }}</a>
</div>





