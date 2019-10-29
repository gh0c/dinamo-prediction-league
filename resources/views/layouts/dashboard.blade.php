@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-xs-12 col-lg-4 mt-2 dashboard-sidebar-left">
                <div class="card">
                    <div class="card-header text-center">{{ Auth::user()->username }}</div>

                    <div class="card-body pt-0 container-fluid">

                        <div class="row">
                            <div class="col font-weight-bold py-1 text-center">
                                {{ __('pages.profile.index.user_card._label') }}
                            </div>
                        </div>
                        <div class="row border-top border-bottom">
                            @unless(is_null($personalStats['overallScore']))

                                <div class="col-4">
                                    <div class="row">
                                        <span class="text-muted small m-auto">{{ __('pages.profile.index.user_card.ranking._label') }}</span>
                                    </div>
                                    <div class="row text-center">
                                        <h4 class="col">{{ $personalStats['position'] }}.</h4>
                                    </div>
                                </div>

                                <div class="col-4 border-left border-right">
                                    <div class="row">
                                        <span class="text-muted small m-auto">{{ __('pages.profile.index.user_card.points._label') }}</span>
                                    </div>
                                    <div class="row text-center">
                                        <h4 class="col">{{ $personalStats['overallScore']['total_points'] }}</h4>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="row">
                                        <span class="text-muted small m-auto">{{ __('pages.profile.index.user_card.remaining_jokers._label') }}</span>
                                    </div>
                                    <div class="row text-center">
                                        <h4 class="col">{{ $personalStats['remaining_jokers'] }}</h4>
                                    </div>
                                </div>

                            @else
                                @if($personalStats['disqualification'])
                                    <span class="col-12 pt-2 font-weight-bold text-danger text-center">
                                        <i class="fa fa-fw fa-exclamation-triangle"></i>&nbsp;
                                        {{ __('pages.profile.index.disqualified') }}
                                    </span>
                                    <span class="col-12 py-1 text-center">
                                        {{ __('pages.profile.index.disqualification_reason') }}:&nbsp;
                                        {{ __('models.predictions.disqualification_reason._values.' . $personalStats['disqualification']->reason) }}
                                    </span>
                                @else
                                    <span class="col-12 py-2 text-center">
                                        <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>&nbsp;
                                        {{ __('pages.profile.index.no_stats') }}
                                    </span>
                                @endif
                            @endunless
                        </div>

                        <div class="row">
                            <div class="col font-weight-bold py-1 text-center">
                                {{ __('pages.profile.index.results_card._label') }}
                            </div>
                        </div>
                        <div class="row border-top border-bottom">

                            <div class="col-6">
                                <div class="row p-1">
                                    <a href="{{ route('results.overall') }}" class="btn btn-sm btn-primary m-auto">
                                        {{ __('pages.profile.index.results_card.links.overall_results._label') }}
                                    </a>
                                </div>
                            </div>

                            <div class="col-6 border-left border-left-dashed">
                                <div class="row p-1">
                                    <a href="{{ route('results.dashboard.by-round') }}" class="btn btn-sm btn-primary m-auto">
                                        {{ __('pages.profile.index.results_card.links.results_by_round._label') }}
                                    </a>
                                </div>
                            </div>

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
