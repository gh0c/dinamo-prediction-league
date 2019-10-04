@extends('layouts.app')

@section('page_title', __('pages.profile.index.title', ['username' => Auth::user()->username]))

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-xs-12 col-md-4 mt-2 dashboard-sidebar-left">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i>&nbsp;{{ Auth::user()->username }}
                    </div>

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>&nbsp;{{ Auth::user()->email }}
                        </li>

                        @if(Auth::user()->is_mod || Auth::user()->is_admin)
                            <li class="list-group-item">
                                @if(Auth::user()->is_admin)
                                    <span class="mr-2 small font-weight-bold">{{ __('pages.profile.index.user_card.admin') }}</span>
                                @endif
                                @if(Auth::user()->is_mod)
                                    <span class="mr-2 small font-weight-bold">{{ __('pages.profile.index.user_card.mod') }}</span>
                                @endif
                            </li>
                        @endif

                    </ul>

                    <div class="card-body">
                        <div class="list-group">
                            <a href="{{ route('profile.change-password.form') }}"
                               class="list-group-item list-group-item-action">
                                {{ __('pages.profile.index.card_links.password_change.label') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
