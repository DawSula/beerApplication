<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <a class="navbar-brand" href="/"><h1 class="m-0">{{ $applicationName }}</h1></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse justify-content-start" id="navbarSupportedContent">
        @section('sidebar')
            @auth
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('beers.add') }}">Dodaj Piwo</a>
                    </li>

                    <li class="nav-item">

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('me.favourite.list') }}">
                            Ulubione
                        </a>
                    </li>
                </ul>
            @else
            @endauth

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @can('admin')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Admin panel
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.users.users') }}">
                                    Użytkownicy</a>
                                <a class="dropdown-item" href="{{ route('admin.waitingBeers.list') }}">
                                    Oczekujące na dodanie
                                </a>

                            </div>
                        </li>
                    @endcan


                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('me.profile') }}">
                                Profil
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Wyloguj
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

        @show
    </div>
</nav>
