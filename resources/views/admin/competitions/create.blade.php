@extends('layouts.app')

@section('page_title', __('forms.admin.competitions._headings.store'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.competitions._headings.store') }}</h3>

                {!! Form::open(['route' => 'admin.competitions.store', 'files' => true, 'class' => 'was-validated']) !!}

                @include('admin.competitions.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
