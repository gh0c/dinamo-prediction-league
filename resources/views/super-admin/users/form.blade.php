<div class="form-row">

    <div class="form-group col-12">
        <label for="username">{{ __('forms.super_admin.users.username.label') }}</label>
        {!! Form::text('username', null, ['class' => 'form-control','required' => true, 'autofocus' => true]) !!}
        @include('forms.input-error', ['name' => 'username'])
    </div>

    <div class="form-group col-12">
        <label for="email">{{ __('forms.super_admin.users.email.label') }}</label>
        {!! Form::email('email', null, ['class' => 'form-control','required' => true,]) !!}
        @include('forms.input-error', ['name' => 'email'])
    </div>

</div>

<div class="form-row">
    <div class="form-group col-12 col-lg-6">
        <div class="form-check">
            <input type="hidden" name="userSetting[is_admin]" value="0">
            {!! Form::checkbox('userSetting[is_admin]', 1, null, [
                'id' => 'is_admin-input', 'class' => 'form-check-input'
                ]) !!}
            <label class="form-check-label"
                   for="is_admin-input">{{ __('forms.super_admin.users.is_admin.label') }}</label>
        </div>
    </div>
    <div class="form-group col-12 col-lg-6">
        <div class="form-check">
            <input type="hidden" name="userSetting[is_moderator]" value="0">
            {!! Form::checkbox('userSetting[is_moderator]', 1, null, [
                'id' => 'is_mod-input', 'class' => 'form-check-input'
                ]) !!}
            <label class="form-check-label"
                   for="is_mod-input">{{ __('forms.super_admin.users.is_moderator.label') }}</label>
        </div>
    </div>
</div>

<div class="text-center">
    <button type="submit" class="btn btn-primary">{{ __('forms.super_admin.users._submit') }}</button>

    <a href="{{ route('super-admin.users.index') }}" class="btn btn-danger">{{ __('forms.cancel') }}</a>
</div>
