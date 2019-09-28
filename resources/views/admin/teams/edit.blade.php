@extends('layouts.app')

@section('page_title', __('forms.admin.teams._headings.update'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.teams._headings.update') }}</h3>

                {!! Form::model($team, ['method' => 'PATCH', 'route' => ['admin.teams.update', 'team' => $team->id], 'files' => true, 'class' => 'was-validated']) !!}

                @include('admin.teams.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
