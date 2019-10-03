@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.profile.change_password._headings.change') }}</h3>

                {!! Form::open(['route' => 'profile.change-password.submit', 'class' => 'was-validated']) !!}

                <div class="form-row">

                    <div class="form-group col-xl-8 offset-xl-2">
                        <label for="old_password">{{ __('forms.profile.change_password.old_password.label') }}</label>
                        {!! Form::password('old_password', ['class' => 'form-control','required' => true, 'autofocus' => true]) !!}
                        @include('forms.input-error', ['name' => 'old_password'])
                    </div>

                    <div class="form-group col-xl-8 offset-xl-2">
                        <label for="new_password">{{ __('forms.profile.change_password.new_password.label') }}</label>
                        {!! Form::password('new_password', ['class' => 'form-control','required' => true,]) !!}
                        @include('forms.input-error', ['name' => 'new_password'])
                    </div>

                    <div class="form-group col-xl-8 offset-xl-2">
                        <label for="new_password_confirmation">{{ __('forms.profile.change_password.new_password_confirmation.label') }}</label>
                        {!! Form::password('new_password_confirmation', ['class' => 'form-control','required' => true,]) !!}
                        @include('forms.input-error', ['name' => 'new_password_confirmation'])
                    </div>

                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">{{ __('forms.profile.change_password._submit') }}</button>

                    <a href="{{ route('profile.index') }}" class="btn btn-danger">{{ __('forms.cancel') }}</a>
                </div>

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
