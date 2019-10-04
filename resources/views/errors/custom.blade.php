@extends('layouts.app')

@section('page_title', $message)

@push('stylesheets')
    <style>
        main {
            align-items: center;
            display: flex;
            flex: 1;
            justify-content: center;
        }

        main .message {
            font-size: 2em;
            color: darkgray;
        }
    </style>
@endpush

@section('content')
    <div class="message" style="padding: 10px;">
        {{ $message }}
    </div>
@endsection