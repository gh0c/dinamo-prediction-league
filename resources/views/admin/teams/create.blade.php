@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.teams._headings.store') }}</h3>

                {!! Form::open(['route' => 'admin.teams.store', 'files' => true, 'class' => 'was-validated']) !!}

                @include('admin.teams.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
