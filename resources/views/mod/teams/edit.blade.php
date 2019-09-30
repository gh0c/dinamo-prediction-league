@extends('layouts.app')

@section('page_title', __('forms.mod.teams._headings.update'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.mod.teams._headings.update') }}</h3>

                {!! Form::model($team, ['method' => 'PATCH', 'route' => ['mod.teams.update', 'team' => $team->id], 'files' => true, 'class' => 'was-validated']) !!}

                @include('mod.teams.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
