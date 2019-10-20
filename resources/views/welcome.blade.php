@extends('layouts.app')

@section('content')
    <div class="container-fluid text-center">
        <a href="{{ route('home.index') }}">
            {!! Html::image('/img/dinamo-predictor-banner.jpg', 'Banner', ['class' => 'img-fluid']) !!}
        </a>
    </div>
@endsection