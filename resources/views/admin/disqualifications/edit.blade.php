@extends('layouts.app')

@section('page_title', __('forms.admin.disqualifications._headings.update'))

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <h3>{{ __('forms.admin.disqualifications._headings.update') }}</h3>

                {!! Form::model($disqualification, ['method' => 'PATCH',
                    'route' => ['admin.disqualifications.update', 'disqualification' => $disqualification->id],
                    'class' => 'was-validated']) !!}

                @include('admin.disqualifications.form')

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
