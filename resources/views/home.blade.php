@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col py-1">
                @if(empty($nextRounds) && empty($currentRound) && empty($previousRounds))
                    {{ __('pages.dashboard.no_rounds_for_season._label') }}
                @else

                    @if(!empty($previousRounds))

                        @include('home.previous-rounds', ['rounds' => $previousRounds])

                    @endif

                    @if(!empty($currentRound))

                        @include('home.current-round', ['roundDetails' => $currentRound])

                    @endif

                    @if(!empty($nextRounds))

                        @include('home.next-rounds', ['rounds' => $nextRounds])

                    @endif

                @endif

            </div>
        </div>
    </div>
@endsection
