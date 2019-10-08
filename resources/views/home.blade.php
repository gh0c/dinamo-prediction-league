@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 py-1">

                @if(isset($nextRound))

                    @include('home.next-round', ['round' => $nextRound])

                @endif

                <div class="card">
                    <div class="card-header">{{ __('pages.profile.index.user_card._label') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
