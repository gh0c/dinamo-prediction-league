@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-xs-12 col-lg-4 mt-2 dashboard-sidebar-left">
                <div class="card">
                    <div class="card-header text-center">{{ __('pages.profile.index.user_card._label') }}</div>

                    <div class="card-body container-fluid">

                        <div class="row">
                            <div class="col text-center font-weight-bold">
                                {{ Auth::user()->username }}
                            </div>
                        </div>
                        <div class="row border-top border-bottom">
                            @unless(is_null($personalStats['overallScore']))

                                <div class="col-4">
                                    <div class="row text-center">
                                        <span class="col text-muted small">{{ __('pages.profile.index.user_card.ranking._label') }}</span>
                                    </div>
                                    <div class="row text-center">
                                        <h4 class="col">{{ $personalStats['position'] }}.</h4>
                                    </div>
                                </div>

                                <div class="col-4 border-left border-right">
                                    <div class="row text-center">
                                        <span class="col text-muted small">{{ __('pages.profile.index.user_card.points._label') }}</span>
                                    </div>
                                    <div class="row text-center">
                                        <h4 class="col">{{ $personalStats['overallScore']['total_points'] }}</h4>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="row text-center">
                                        <span class="col text-muted small">{{ __('pages.profile.index.user_card.remaining_jokers._label') }}</span>
                                    </div>
                                    <div class="row text-center">
                                        <h4 class="col">{{ $personalStats['remaining_jokers'] }}</h4>
                                    </div>
                                </div>

                            @else
                                -Nema statsa
                            @endunless
                        </div>
                    </div>


                </div>
            </div>


            <div class="col-xs-12 col-lg-8 mt-2 dashboard-sidebar-right">
                <div class="card">
                    @yield('dashboard-content')
                </div>
            </div>
        </div>

    </div>

@endsection
