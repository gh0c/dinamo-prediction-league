<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title', config('app.name', 'Predictions league'))</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    {{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="{{ mix('/js/app.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{ Html::style('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}


    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}"/>

    @stack('stylesheets')

</head>

<body class="d-flex flex-column h-100">
@include('flash.errors')

@include('flash.messages')

@include('layouts.navbar')

<main class="py-4 flex-shrink-0">
    @yield('content')
</main>

@include('layouts.footer')

@stack('scripts-foot')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
</script>

</body>



</html>
