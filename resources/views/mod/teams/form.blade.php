<div class="form-row">
    <div class="form-group col-12">
        <label for="name-input">{{ __('forms.mod.teams.name.label') }}</label>
        {!! Form::text('name', null, [
            'id' => 'name-input',
            'placeholder' => __('forms.mod.teams.name.placeholder'),
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
        <label for="sport">{{ __('forms.mod.teams.sport.label') }}</label>
        {!! Form::select('sport', $inputSports, null, [
            'class' => 'form-control',
            'required' => true
            ]) !!}
        @include('forms.input-error', ['name' => 'sport'])
    </div>
</div>

<div class="form-row">
    <div class="form-group col-12">
        <label for="featured_image">{{ __('forms.mod.teams.featured_image.label') }}</label>
        <div class="custom-file">
            {!! Form::file('featured_image', [
                'class' => 'custom-file-input ' . ($errors->has('name') ? 'is-invalid' : '')
            ]) !!}
            <label class="custom-file-label" for="featured_image">Choose file</label>
        </div>
        @include('forms.input-error', ['name' => 'featured_image'])
    </div>
</div>

<div class="text-center">
    <button type="submit" class="btn btn-primary">{{ __('forms.mod.teams._submit') }}</button>

    <a href="{{ route('mod.teams.index') }}" class="btn btn-danger">{{ __('forms.cancel') }}</a>
</div>


<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function () {
        let fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script>


