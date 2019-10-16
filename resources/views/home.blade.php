@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col py-1">
                @if(empty($nextRounds) && empty($currentRound) && empty($previousRounds))
                    {{ __('pages.dashboard.no_rounds_for_season._label') }}
                @else

                    <div class="row">
                        @if(!empty($nextRounds))
                            <div class="col-12 col-lg-4 alert alert-info">
                                @include('home.next-rounds', ['rounds' => $nextRounds])
                            </div>
                        @endif

                        @if(!empty($currentRound))
                            <div class="col-12 col-lg-4">
                                @include('home.current-round', ['roundDetails' => $currentRound])
                            </div>

                        @endif

                        @if(!empty($previousRounds))
                            <div class="col-12 col-lg-4">
                                @include('home.previous-rounds', ['rounds' => $previousRounds])
                            </div>
                        @endif
                    </div>


                @endif

            </div>
        </div>
    </div>
@endsection
