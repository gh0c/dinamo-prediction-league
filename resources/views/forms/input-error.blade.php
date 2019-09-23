@if($errors->has((str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $name))))
    <div class="invalid-feedback d-block">
        <i class="fa fa-fw fa-exclamation-triangle"></i> {{ $errors->first(str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $name)) }}
    </div>
@endif
