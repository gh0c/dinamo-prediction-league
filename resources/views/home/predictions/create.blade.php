@extends('layouts.dashboard')

@section('page_title', __('forms.home.predictions._headings.create'))

@section('dashboard-content')

    <div class="container py-1">

        <div class="row">

            <div class="col-md-6 offset-md-3 text-center">

                <h4>{{ __('forms.home.predictions._headings.create') }}</h4>

                {!! Form::open(['route' => 'home.predictions.store', 'class' => 'was-validated']) !!}

                @include('home.predictions.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
