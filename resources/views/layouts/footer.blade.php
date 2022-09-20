<footer class="footer my-2">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-4">
        <div class="footer container d-flex justify-content-between align-items-start">
        <nav class="nav flex-column">
            @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link btn-text">Zum Dashboard</a>
                    @else
                        <span class="d-flex nav-link btn-text">
                            <a href="{{ route('login') }}" class="btn-text">Einloggen</a> / @if (Route::has('register'))<a href="{{ route('register') }}" class="btn-text">Registrieren</a>@endif
                        </span>

                        
                    @endauth
            @endif
            <a class="nav-link btn-text" href="/datenschutz">Datenschutz</a>
            <a class="nav-link btn-text" href="/impressum">Impressum</a>
        </nav>
           
            <div class="navbar-brand">
                <p class="h1 site-title">{{ config('app.name', 'Laravel') }}</p>
            </div>
        </div>
    </nav>
</footer>