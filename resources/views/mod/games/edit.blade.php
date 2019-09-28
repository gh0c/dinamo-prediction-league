@extends('layouts.app')

@section('page_title', __('forms.mod.games._headings.update'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.mod.games._headings.update') }}</h3>

                {!! Form::model($game, ['method' => 'PATCH', 'route' => ['mod.games.update', 'game' => $game->id], 'class' => 'was-validated']) !!}

                @include('mod.games.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
