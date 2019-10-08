@extends('layouts.app')

@section('page_title', __('forms.admin.predictions._headings.store'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-10 col-lg-6 offset-md-1 offset-lg-3">

                <h3>{{ __('forms.admin.predictions._headings.store') }}</h3>

                {!! Form::open(['route' => 'admin.predictions.store', 'class' => 'was-validated']) !!}

                @include('admin.predictions.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
