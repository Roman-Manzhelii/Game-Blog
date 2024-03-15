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
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-gray-800 py-6">
            <div class="container mx-auto flex justify-end items-center">
                <nav class="space-x-4 text-gray-300 sm:text-base">
                    <a class="no-underline hover:underline text-lg" href="/">Home</a>
                    <a class="no-underline hover:underline text-lg" href="/blog">Blog</a>
                    <a class="no-underline hover:underline text-lg" href="/reviews">Reviews</a>
                    <a class="no-underline hover:underline text-lg" href="/guides">Guides</a>
                    <a class="no-underline hover:underline text-lg" href="/games">Games</a>
                    @guest
                        <a class="no-underline hover:underline text-lg" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline text-lg" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span class="text-lg">{{ Auth::user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline text-lg"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>

        <div>
            @yield('content')
            @yield('scripts')
        </div>

        <div>
            @include('layouts.footer')
        </div>
    </div>
</body>
</html>
