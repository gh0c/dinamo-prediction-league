<div class="form-row">
    <div class="form-group col-12">
        <label for="name-input">{{ __('forms.admin.competitions.name.label') }}</label>
        {!! Form::text('name', null, [
            'id' => 'name-input',
            'placeholder' => __('forms.admin.competitions.name.placeholder'),
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
        <label for="sport">{{ __('forms.admin.competitions.sport.label') }}</label>
        {!! Form::select('sport', $inputSports, null, [
            'class' => 'form-control',
            'required' => true
            ]) !!}
        @include('forms.input-error', ['name' => 'sport'])
    </div>
</div>

<div class="form-row">
    <div class="form-group col-12">
        <label for="featured_image">{{ __('forms.admin.competitions.featured_image.label') }}</label>
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
    <button type="submit" class="btn btn-primary">{{ __('forms.admin.competitions._submit') }}</button>
</div>


<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function () {
        let fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script>


