@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.seasons._headings.create') }}</h3>

                {!! Form::open(['route' => 'admin.seasons.store']) !!}

                @include('admin.seasons.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
