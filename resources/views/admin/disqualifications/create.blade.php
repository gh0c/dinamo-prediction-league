@extends('layouts.app')

@section('page_title', __('forms.admin.disqualifications._headings.store'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.disqualifications._headings.store') }}</h3>

                {!! Form::open(['route' => 'admin.disqualifications.store', 'class' => 'was-validated']) !!}

                @include('admin.disqualifications.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
