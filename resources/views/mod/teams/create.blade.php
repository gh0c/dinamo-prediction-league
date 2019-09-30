@extends('layouts.app')

@section('page_title', __('forms.mod.teams._headings.store'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.mod.teams._headings.store') }}</h3>

                {!! Form::open(['route' => 'mod.teams.store', 'files' => true, 'class' => 'was-validated']) !!}

                @include('mod.teams.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
