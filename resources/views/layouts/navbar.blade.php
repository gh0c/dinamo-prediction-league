<nav class="navbar navbar-expand-md navbar-dark bg-zona-dinamo text-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/') }}">
            {{ config('app.name', 'Prediction league') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

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

                                <a class="dropdown-item {{ request()->routeIs('admin.teams.*')  ? 'active' : '' }}"
                                   href="{{ route('admin.teams.index') }}">
                                    {{ __('models.games.team.collection') }}
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


                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }}
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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