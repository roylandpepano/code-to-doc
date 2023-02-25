<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Explore the wonders of Albay with Lakbay Agapay — a guide for your next travels in the province.
                            With just a few clicks, you can now see the wondrous spots Albay has to offer.
                            Visit some never-before-seen places and be at awe with the province's hidden gems." />
    <meta name="keywords" content="Lakbay Agapay, lakbay, agapay, lakbay agapay, lakbayagapay, travel, albay, tourist, tourist destinations, tour operator, tour guide, philippines, bicol, bicol region, albay tourism, tourism, department of tourism, where to travel, travel, travel in the philippines, best place to travel" />
    <meta name="author" content="CJ4">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lakbay Agapay') }}</title>
    <link rel="icon" href="{{ asset('img/index/LOGO-1.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    {{--Street View--}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
{{--    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>--}}

{{--  Bootstrap  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media_query.css') }}">
    @stack('specific-css')

    <!-- Fetch Online -->

    <!-- FontAwesome JS -->
    <script src="https://kit.fontawesome.com/2fb013f950.js" crossorigin="anonymous"></script>
    <!-- FontAwesome CSS -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<div id="progress">
    <span id="progress-value"><i class="fa-solid fa-arrow-up"></i></span>
</div>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="position: sticky; top: 0; z-index: 2;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('img/icons/LOGO-2.png') }}" class="logo" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul id="navbar-dropdown" class="navbar-nav me-auto">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('guest.discover') }}">Discover</a></li>
                <li><a href="{{ route('guest.tour_operator') }}">Tour Operator</a></li>
                <li><a href="{{ route('guest.map') }}"><i class="uil uil-map"></i>Map</a></li>
                <li><a href="{{ route('guest.about') }}">About</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

            </ul>
        </div>
    </nav>

    <main class="py-4">
        @yield('content-guest')
    </main>

    <footer>
        <div class="col">
            <img class="footer-logo" src="{{ asset('img/icons/footer-logo-dark.png') }}" alt="logo">
            <h4>Contact</h4>
            <p><strong>Email Address: </strong> lakbay.agapay@gmail.com</p>
            <p><strong>Address: </strong> Legazpi City, Albay, Philippines</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <a href="https://www.facebook.com/profile.php?id=100086206800895"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/LakbayAgapay"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/lakbayagapay/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div style="display:flex; width: 70%;">
            <div class="col">
                <h4>Province of Albay</h4>
                <a href="https://beta.tourism.gov.ph/">DOT Website</a>
                <a href="https://albay.gov.ph/?page_id=1557">Tourism</a>
                <a href="https://albay.gov.ph/?page_id=18018">Festivals</a>
                <a href="https://albay.gov.ph/?page_id=18580">Culture, Arts and History</a>
            </div>

            <div class="col">
                <h4>About</h4>
                <a href="{{ route('guest.about') }}">About Us</a>
                <a href="{{ route('privacy') }}">Privacy Policy</a>
            </div>

            <div class="col">
                <h4>Account</h4>
                <a href="{{ route('guest.login') }}">Sign In</a>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; 2022, Lakbay Agapay</p>
        </div>
    </footer>
</div>
<script src="{{ asset('js/packages/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/packages/typed-2.0.12.js') }}"></script>
<script src="{{ asset('js/packages/vanilla_tilt.js') }}"></script>
<script src="{{ asset('js/function.js') }}"></script>
<script src="{{ asset('js/scroll-top.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
@stack('scripts-guest')
</body>
</html>
