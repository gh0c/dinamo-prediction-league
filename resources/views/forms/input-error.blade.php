@if($errors->has(($name)))
    <div class="invalid-feedback d-block">
        {{ $errors->first($name) }}
    </div>
@endif
