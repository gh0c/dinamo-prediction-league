@if($errors->has(($name)))
    <div class="invalid-feedback d-block">
        <i class="fa fa-fw fa-exclamation-triangle"></i> {{ $errors->first($name) }}
    </div>
@endif
