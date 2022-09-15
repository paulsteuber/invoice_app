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
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/dashboard') }}">
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
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrieren') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">{{__('Geschäftsinformationen')}}</a>
                                    <a class="dropdown-item logout" href="{{ route('logout') }}"
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
        @if(Auth::user())
        <nav class="pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a type="button" class="btn btn-secondary" href="{{route('home')}}">{{__("Dashboard")}}</a>
                    <div class="btn-group" role="group">
                        <a id="btnGroupInvoices" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{__("Rechnungen")}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupInvoices">
                        <li><a class="dropdown-item" href="{{ route('invoice.index')}}">{{__("Alle Rechnungen")}} </a></li>
                        <li><a class="dropdown-item" href="{{ route('invoice.create')}}">{{__("Neue Rechnung erstellen")}} </a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <a id="btnGroupCustomers" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{__("Kunden")}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupCustomers">
                        <li><a class="dropdown-item" href="{{ route('customers')}}">{{__("Alle Kunden")}} </a></li>
                        <li><a class="dropdown-item" href="{{ route('customer.create')}}">{{__("Neuen Kunden erstellen")}} </a></li>
                        </ul>
                    </div>
                    </div>
                
                </div>            
            </div>
        
        </div>
        
        </nav>
        @endif
        <main class="py-3">
            @yield('content')
        </main>
    </div>
    <footer>
        
    </footer>
</body>
</html>
