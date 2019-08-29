@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.mod.players._headings.store') }}</h3>

                {!! Form::open(['route' => 'mod.players.store', 'class' => 'was-validated']) !!}

                @include('mod.players.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
