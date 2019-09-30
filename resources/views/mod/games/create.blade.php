@extends('layouts.app')

@section('page_title', __('forms.mod.games._headings.store'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-xl-6 col-lg-10 offset-lg-1 offset-xl-3">

                <h3>{{ __('forms.mod.games._headings.store') }}</h3>

                {!! Form::open(['route' => 'mod.games.store', 'class' => 'was-validated']) !!}

                @include('mod.games.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
