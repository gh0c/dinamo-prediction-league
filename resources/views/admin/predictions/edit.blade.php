@extends('layouts.app')

@section('page_title', __('forms.admin.predictions._headings.update'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.predictions._headings.update') }}</h3>

                {!! Form::model($prediction, ['method' => 'PATCH', 'route' => ['admin.predictions.update', 'prediction' => $prediction->id], 'class' => 'was-validated']) !!}

                @include('admin.predictions.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
