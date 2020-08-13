@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col py-1">
                @if(empty($nextRounds) && empty($currentRounds) && empty($previousRounds))
                    {{ __('pages.dashboard.no_rounds_for_season._label') }}
                @else

                    <div class="row">
                        @if(!empty($nextRounds))
                            <div class="col-12 px-1">
                                @include('home.next-rounds', ['rounds' => $nextRounds])
                            </div>
                        @endif

                        @if(!empty($currentRounds))
                            <div class="col-12 px-1">
                                @include('home.current-rounds', ['rounds' => $currentRounds])
                            </div>
                        @endif

                        @if(!empty($previousRounds))
                            <div class="col-12 px-1">
                                @include('home.previous-rounds', ['rounds' => $previousRounds])
                            </div>
                        @endif
                    </div>


                @endif

            </div>
        </div>
    </div>
@endsection
