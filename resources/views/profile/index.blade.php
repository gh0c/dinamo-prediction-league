@extends('layouts.app')

@section('page_title', __('pages.profile.index.title', ['username' => Auth::user()->username]))

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-xs-12 col-md-4 mt-2 dashboard-sidebar-left">
                <div class="card">
                    <div class="card-header">{{ Auth::user()->username }}</div>

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
