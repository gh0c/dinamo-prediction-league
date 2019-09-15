@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.seasons._headings.update') }}</h3>

                {!! Form::model($season, ['method' => 'PATCH', 'route' => ['admin.seasons.update', 'season' => $season->id]]) !!}

                @include('admin.seasons.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection