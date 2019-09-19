@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.predictions._headings.store') }}</h3>

                {!! Form::open(['route' => 'admin.predictions.store', 'files' => true, 'class' => 'was-validated']) !!}

                @include('admin.predictions.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
