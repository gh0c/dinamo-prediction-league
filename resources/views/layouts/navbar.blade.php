<nav class="navbar navbar-expand-md navbar-dark bg-zona-dinamo text-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/') }}">
            {!! Html::image('/img/logo.png', config('app.name', 'Prediction league')) !!}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.index') }}">{{ __('layout.navbar.home._label') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                        </li>
                    @endif
                @else
                    @if(Auth::user()->is_admin)

                        <li class="nav-item dropdown {{ request()->routeIs('admin.*')  ? 'active' : '' }}">
                            <a id="adminNavbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('layout.navbar.admin._label') }}
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminNavbarDropdown">
                                <a class="dropdown-item {{ request()->routeIs('admin.predictions.*')  ? 'active' : '' }}"
                                   href="{{ route('admin.predictions.dashboard') }}">
                                    {{ __('models.predictions.prediction.collection') }}
                                </a>

                                <a class="dropdown-item {{ request()->routeIs('admin.competitions.*') ? 'active' : '' }}"
                                   href="{{ route('admin.competitions.index') }}">
                                    {{ __('models.games.competition.collection') }}
                                </a>

                                <a class="dropdown-item {{ request()->routeIs('admin.disqualifications.*') ? 'active' : '' }}"
                                   href="{{ route('admin.disqualifications.index') }}">
                                    {{ __('models.predictions.disqualification.collection') }}
                                </a>

                                <a class="dropdown-item {{ request()->routeIs('admin.seasons.*') ? 'active' : '' }}"
                                   href="{{ route('admin.seasons.index') }}">
                                    {{ __('models.games.season.collection') }}
                                </a>
                            </div>
                        </li>

                    @endif

                    @if(Auth::user()->is_admin || Auth::user()->is_mod)

                        <li class="nav-item dropdown {{ request()->routeIs('mod.*')  ? 'active' : '' }}">
                            <a id="modNavbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('layout.navbar.mod._label') }}
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="modNavbarDropdown">

                                <a class="dropdown-item {{ request()->routeIs('mod.teams.*')  ? 'active' : '' }}"
                                   href="{{ route('mod.teams.index') }}">
                                    {{ __('models.games.team.collection') }}
                                </a>

                                <a class="dropdown-item {{ request()->routeIs('mod.games.*') ? 'active' : '' }}"
                                   href="{{ route('mod.games.index') }}">
                                    {{ __('models.games.game.collection') }}
                                </a>

                                <a class="dropdown-item {{ request()->routeIs('mod.players.*') ? 'active' : '' }}"
                                   href="{{ route('mod.players.index') }}">
                                    {{ __('models.games.player.collection') }}
                                </a>
                            </div>
                        </li>

                    @endif

                        @if(Auth::user()->is_super_admin)

                            <li class="nav-item dropdown {{ request()->routeIs('super-admin.*')  ? 'active' : '' }}">
                                <a id="superAdminNavbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('layout.navbar.super_admin._label') }}
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="superAdminNavbarDropdown">

                                    <a class="dropdown-item {{ request()->routeIs('super-admin.users.*')  ? 'active' : '' }}"
                                       href="{{ route('super-admin.users.index') }}">
                                        {{ __('models.users.user.collection') }}
                                    </a>

                                </div>
                            </li>

                        @endif


                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }}
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ request()->routeIs('profile.*')  ? 'active' : '' }}"
                               href="{{ route('profile.index') }}">
                                {{ __('layout.navbar.profile._label') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('auth.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>