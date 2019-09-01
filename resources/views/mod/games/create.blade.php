@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.mod.games._headings.store') }}</h3>

                {!! Form::open(['route' => 'mod.games.store', 'class' => 'was-validated']) !!}

                @include('mod.games.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
