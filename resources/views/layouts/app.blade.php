<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    @stack('scripts')


    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"> <!--load all styles -->


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register as User') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('doctors.create') }}">{{ __('Register as Doctor') }}</a>
                                </li>
                            @endif
                        @else
                            @if(auth()->user()->type == 'backoffice')
                                <li><a class="nav-link " href="{{url('/users')}}" role="button">Users</a></li>
                                <li><a class="nav-link " href="{{url('/doctors')}}" role="button">Doctors</a></li>
                                <li><a class="nav-link " href="{{url('/reservations')}}" role="button">Reservations</a></li>

                            @elseif(auth()->user()->type == 'user')
                                <li><a class="nav-link " href="{{url('/specialities')}}" role="button">Specialities</a></li>

                            @elseif(auth()->user()->type == 'doctor')
                                <li><a class="nav-link " href="{{url('/doctor-reservations')}}" role="button">Your Reservations</a></li>
                            @endif
                            @if(auth()->user()->type !='backoffice')

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                           <i class="fa fa-bell"></i>
                                            <span class="badge badge-danger">{{ auth()->user()->unreadNotifications()->count() }}</span>
                                        </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                @forelse (auth()->user()->unreadNotifications as $notification)

                                                    @if(auth()->user()->type == 'doctor')
                                                    <a class="dropdown-item" href="{{ url('/read-notification/'.$notification->id) }}">
                                                        new reservation at
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </a>
                                                    @elseif(auth()->user()->type == 'user')
                                                    <a class="dropdown-item" href="{{ url('/read-notification/'.$notification->id) }}">
                                                        Doctor {{$notification['data']['doctor_name']}}
                                                        {{$notification->type == \App\Notifications\ReserveAccepted::class ? ' accepted ':' rejected '}} your reserve
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </a>
                                                    @endif

                                                @empty
                                                    <div class="alert alert-info">
                                                        there is no notification for you
                                                    </div>
                                                @endforelse
                                            </div>
                                    </li>

                                @endif
                                <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>