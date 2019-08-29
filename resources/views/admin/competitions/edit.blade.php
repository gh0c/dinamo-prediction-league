@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.competitions._headings.update') }}</h3>

                {!! Form::model($competition, ['method' => 'PATCH', 'route' => ['admin.competitions.update', 'competition' => $competition->id], 'files' => true, 'class' => 'was-validated']) !!}

                @include('admin.competitions.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
