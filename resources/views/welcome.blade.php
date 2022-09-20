<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chia Invoice</title>


        <!-- Styles -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Righteous&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="welcome-page">
        <nav class="navbar navbar-header navbar-expand-md navbar-light bg-white shadow-sm ">
            <header class="container d-flex justify-content-between">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <p class="h1 site-title">{{ config('app.name', 'Laravel') }}</p>
                </a>
                @if (Route::has('login'))
                    <div class="navbar-nav">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link">Einloggen</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-link">Registrieren</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </header>
        </nav>
        <main class="container">
            <div class="row">
                <section class="main-section row">
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <h1 class="seo-title">{{__("Online Rechnungssoftware")}}</h1>
                        <p class="section-title h2">
                            Für Selbstständige und Kleinunternehmer!
                        </p>
                        <p class="pr-4">Bei <span class="mini-site-title">chia</span> kannst Du Rechnungen erstellen, verändern und als PDF downloaden.
                        Genieße den vollen Umfang unseres Services und das sogar <b>100% kostenfrei!</b> </p>
                        <div class="cta-buttons">
                        @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Zum Dashboard</a>
                                @else
                                    <div class="d-flex align-items-center">
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-primary">Kostenfrei registrieren!</a>
                                    @endif
                                    <a href="{{ route('login') }}" class="btn-text ml-3">oder einloggen</a>

                                    </div>
                                @endauth
                        @endif
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <img src="/svg/print-invoice.svg" alt="Printing Invoices Icons">
                    </div>
                </section>
                <hr class="offset-md-5 col-md-2 my-5">
                <!---main-section ENDE -->
                <section class="center-section row">
                    <div class="col-md-12 text-center">
                        <h2 class="seo-title">{{__("kostenlos Rechnungen erstellen")}}</h2>
                        <p class="section-title h2">
                            In wenigen Klicks Rechnungen erstellen
                        </p>
                    </div>
                    <p class="offset-md-3 col-md-6 text-center">
                        Bei <span class="mini-site-title ">chia</span> kannst Du Rechnungen erstellen, mehrere Positionen anlegen und <b>unterschiedliche Mehrwertsteuersätze</b> festlegen. 
                        Wenn du fertig bist, kannst du die Rechnung <b>als PDF downloaden</b> und deinem Kunden zu schicken.
                        </p>
                    <div class="offset-md-4 col-md-4 d-flex flex-column justify-content-center">
                        <img src="/svg/invoice-boy.svg" alt="Printing Invoices Icons">
                    </div>
                </section>
                <!---center-section ENDE -->
                <hr class="offset-md-5 col-md-2 my-5">

                <section class="image-left-section row">
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <img src="/svg/profile-customer.svg" alt="Kunden verwalten">
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <h2 class="seo-title">{{__("Kundenverwaltung")}}</h2>
                        <p class="section-title h2">
                            Erstelle Kundenprofile schnell und unkompliziert!
                        </p>
                        <p class="pr-4">Bei <span class="mini-site-title">chia</span> kannst Du Kundenprofile speichern, Rechnungen erstellen, verändern und als PDF downloaden.
                        Genieße den vollen Umfang unseres Services und das sogar <b>100% kostenfrei!</b> </p>
                        <div class="cta-buttons">
                        @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Zum Dashboard</a>
                                @else
                                    <div class="d-flex align-items-center">
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-primary">Kostenfrei registrieren!</a>
                                    @endif
                                    <a href="{{ route('login') }}" class="btn-text ml-3">oder einloggen</a>

                                    </div>
                                @endauth
                        @endif
                        </div>
                    </div>
                </section>

            </div>

        </main>
        @include('layouts/footer')

    </body>
</html>
