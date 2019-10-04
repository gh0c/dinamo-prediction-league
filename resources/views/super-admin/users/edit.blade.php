@extends('layouts.app')

@section('page_title', __('forms.super_admin.users._headings.update'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.super_admin.users._headings.update') }}</h3>

                {!! Form::model($user, ['method' => 'PATCH',
                    'route' => ['super-admin.users.update', 'user' => $user->id],
                    'class' => 'was-validated']) !!}

                @include('super-admin.users.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
