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
    <link rel="icon" href="{{ asset('img/icons/LOGO-1.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    {{--Street View--}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
{{--    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet">--}}

{{--  Bootstrap  --}}
{{--    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media_query.css') }}">
    <script type="text/javascript"> (function() { let css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>

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
{{--    DESKTOP Navbar --}}
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="message-notification-desktop" style="position: sticky; top: 0; z-index: 2;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tourist.home') }}">
                <img src="{{ asset('img/icons/LOGO-2.png') }}" class="logo" alt="logo">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul id="navbar-dropdown" class="navbar-nav me-auto">
                <li><a href="{{ route('tourist.home') }}">Home</a></li>
                <li><a href="{{ route('tourist.discover') }}">Discover</a></li>
                <li><a href="{{ route('tourist.tour_operator') }}">Tour Operator</a></li>
                <li><a href="{{ route('tourist.map') }}">Map</a></li>
                <li class="dropdown"><a href="#" class="trigger-drop">More<i class="arrow"></i></a>
                    <ul class="drop">
                        <li><a href="{{ route('tourist.users.show', Auth::id())}}"><i class="fa-solid fa-user mr-2"></i>Account</a></li>
                        <li><a href="{{ route('tourist.discover.favorite_destinations')}}"><i class="fa-solid fa-map mr-2"></i>My Favorite Spots</a></li>
                        <li><a href="{{ route('tourist.tour_operator.favorite_tour_operators')}}"><i class="fa-solid fa-person-circle-check mr-2"></i>My Favorite Guides</a></li>

                        @if(Auth::guard('web')->user()->user_type === 'Tourist')
                            <li><a href="{{ route('tourist.add_destination') }}"><i class="fa-solid fa-location-dot mr-2"></i>Add Destination</a></li>
                            @if($owner === true)
                                <li><a href="{{ route('owner.index') }}"><i class="fa-sharp fa-solid fa-file-pen mr-2"></i>Manage Page</a></li>
                            @endif
                        @elseif(Auth::guard('web')->user()->user_type === 'Tour Operator')
                            <li><a href="{{ route('tour_operator.add_tour_operator') }}"><i class="fa-solid fa-location-dot mr-2"></i>Add Tour Operator Page</a></li>
                            <li><a href="{{ route('tour_operator.index') }}"><i class="fa-sharp fa-solid fa-file-pen mr-2"></i>Manage Page</a></li>
                        @endif

                        <li><a href="{{ route('tourist.about') }}"><i class="fa-solid fa-circle-info mr-2"></i>About</a></li>
                        <form id="logout-form" action="{{ route('tourist.logout') }}" method="POST" class="submit-form">
                            @csrf
                            <input type="submit" style="width: 100%;" value="Logout" name="logout" class="btn btn-danger btn-sm btn-logout mt-2" />
                        </form>
                    </ul>
                </li>
            </ul>

            <!-- Navbar notification for DESKTOP SIZE-->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Right navbar links -->
                <ul class="navbar-nav">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('chatify') }}">
                            <i class="fa-regular fa-envelope fa-lg"></i>
                            @php
                                $newMessage = App\Models\ChMessage::select('to_id', Illuminate\Support\Facades\DB::raw('COUNT(seen) as New'))
                                    ->where('to_id','=', Illuminate\Support\Facades\Auth::user()->id)
                                    ->where('seen','=',0)
                                    ->groupBy('to_id')
                                    ->first();
                            @endphp
                            @if($newMessage===null)
                                <span class="badge badge-danger navbar-badge"></span>
                            @else
                                <span class="badge badge-danger navbar-badge">{{ $newMessage['New'] }}</span>
                            @endif
                        </a>
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fa-regular fa-bell fa-lg"></i>
                            @if($notifications->where('notif_read',0)->count() != 0)
                            <span class="badge badge-danger navbar-badge">
                                    @if($notifications->where('notif_read',0)->count() <= 99)
                                        {{ $notifications->where('notif_read',0)->count() }}
                                    @else
                                        99+
                                    @endif
                            </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notif-message shadow">
                            <span class="dropdown-header">Notifications</span>
                            <span class="dropdown-header">
                                <form action="{{ route('tourist.markAllAsRead') }}" method="POST">
                                    @csrf
                                    <button type="button" class="btn btn-secondary btn-sm" id="btn_all_notif">All</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="btn_unread_notif">Unread</button>
                                    <button type="submit" class="btn btn-outline-primary btn-sm float-right">mark all as read</button>
                                </form>
                            </span>
                            <div class="dropdown-divider"></div>
                            @if($notifications->count() == 0)
                                <p style="text-align: center!important;">You have 0 notifications.</p>
                            @endif
                            <div id="all_notif">
                                @foreach($notifications as $notification)
                                <form action="{{ route('tourist.readClickedNotification',$notification->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item
                                    @if($notification->notif_read == 0)
                                    unread
                                    @else
                                    read
                                    @endif
                                    ">
                                    <span>{{ $notification->notif_message }}</span>
                                    <br><span class="float-right text-muted text-sm">
                                    <i class="fa fa-envelope mr-2 fa-lg"></i>{{ $notification->created_at->diffForHumans() }}</span>
                                    </button>
                                </form>
                                @endforeach
                            </div>
                            <div id="unread_notif" style="display: none">
                                @foreach($unread as $unread_msg)
                                <form action="{{ route('tourist.readClickedNotification', $unread_msg->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" href="#" class="dropdown-item unread">
                                        <span>{{ $unread_msg->notif_message }}</span>
                                        <br><span class="float-right text-muted text-sm">
                                        <i class="fa fa-envelope mr-2 fa-lg"></i>{{ $unread_msg->created_at->diffForHumans() }}</span>
                                    </button>
                                </form>
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
        </div>
    </nav>

{{--    Mobile Navbar--}}

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"  id="message-notification-mobile">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar notification for MOBILE SIZE-->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Right navbar links -->
                <ul class="navbar-nav">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('chatify') }}">
                            <i class="fa-regular fa-envelope fa-lg"></i>
                            @php
                                $newMessage = App\Models\ChMessage::select('to_id', Illuminate\Support\Facades\DB::raw('COUNT(seen) as New'))
                                    ->where('to_id','=', Illuminate\Support\Facades\Auth::user()->id)
                                    ->where('seen','=',0)
                                    ->groupBy('to_id')
                                    ->first();
                            @endphp
                            @if($newMessage===null)
                                <span class="badge badge-danger navbar-badge"></span>
                            @else
                                <span class="badge badge-danger navbar-badge">{{ $newMessage['New'] }}</span>
                            @endif
                        </a>
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fa-regular fa-bell fa-lg"></i>
                            @if($notifications->where('notif_read',0)->count() != 0)
                                <span class="badge badge-danger navbar-badge">
                                    @if($notifications->where('notif_read',0)->count() <= 99)
                                        {{ $notifications->where('notif_read',0)->count() }}
                                    @else
                                        99+
                                    @endif
                            </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notif-message shadow">
                            <span class="dropdown-header">Notifications</span>
                            <span class="dropdown-header">
                                <form action="{{ route('tourist.markAllAsRead') }}" method="POST">
                                    @csrf
                                    <button type="button" class="btn btn-secondary btn-sm" id="btn_all_notif_mobile">All</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="btn_unread_notif_mobile">Unread</button>
                                    <button type="submit" class="btn btn-outline-primary btn-sm float-right">mark all as read</button>
                                </form>
                            </span>
                            <div id="all_notif_mobile">
                                @foreach($notifications as $notification)
                                    <form action="{{ route('tourist.readClickedNotification',$notification->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item
                                        @if($notification->notif_read == 0)
                                        unread
                                        @else
                                        read
                                        @endif
                                        ">
                                        <span>{{ $notification->notif_message }}</span>
                                        <br><span class="float-right text-muted text-sm">
                                        <i class="fa fa-envelope mr-2 fa-lg"></i>{{ $notification->created_at->diffForHumans() }}</span>
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                            <div id="unread_notif_mobile" style="display: none">
                                @foreach($unread as $unread_msg)
                                    <form action="{{ route('tourist.readClickedNotification', $unread_msg->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" href="#" class="dropdown-item unread">
                                            <span>{{ $unread_msg->notif_message }}</span>
                                            <br><span class="float-right text-muted text-sm">
                                        <i class="fa fa-envelope mr-2 fa-lg"></i>{{ $unread_msg->created_at->diffForHumans() }}</span>
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul id="navbar-dropdown" class="navbar-nav me-auto">
                <li style="width: 100%;">
                    <a class="navbar-brand logo-home" href="{{ route('tourist.home') }}">
                        <img src="{{ asset('img/index/logo-dark.png') }}" class="logo" alt="logo">
                        {{ config('app.name', 'Lakbay Agapay') }}
                    </a>
                    <hr>
                </li>
                <li><a href="{{ route('tourist.home') }}">Home</a></li>
                <li><a href="{{ route('tourist.discover') }}">Discover</a></li>
                <li><a href="{{ route('tourist.tour_operator') }}">Tour Operator</a></li>
                <li><a href="{{ route('tourist.map') }}">Map</a></li>
                <li><a href="{{ route('tourist.about') }}">About</a></li>
                <li class="dropdown"><a href="#" class="trigger-drop">More<i class="arrow"></i></a>
                    <ul class="drop">
                        <li><a href="{{ route('tourist.users.show', Auth::id())}}"><i class="fa-solid fa-user mr-2"></i>Account</a></li>
                        <li><a href="{{ route('tourist.discover.favorite_destinations')}}"><i class="fa-solid fa-map mr-2"></i>My Favorite Spots</a></li>
                        <li><a href="{{ route('tourist.tour_operator.favorite_tour_operators')}}"><i class="fa-solid fa-person-circle-check mr-2"></i>My Favorite Guides</a></li>
                        @if(Auth::guard('web')->user()->user_type === 'Tourist')
                            <li><a href="{{ route('tourist.add_destination') }}"><i class="fa-solid fa-location-dot mr-2"></i>Add Destination</a></li>
                            @if($owner === true)
                                <li><a href="{{ route('owner.index') }}"><i class="fa-sharp fa-solid fa-file-pen mr-2"></i>Manage Page</a></li>
                            @endif
                        @elseif(Auth::guard('web')->user()->user_type === 'Tour Operator')
                            <li><a href="{{ route('tour_operator.add_tour_operator') }}"><i class="fa-solid fa-location-dot mr-2"></i>Add Tour Operator Page</a></li>
                            <li><a href="{{ route('tour_operator.index') }}"><i class="fa-sharp fa-solid fa-file-pen mr-2"></i>Manage Page</a></li>
                        @endif

                        <li><a href="{{ route('tourist.about') }}"><i class="fa-solid fa-circle-info mr-2"></i>About</a></li>
                        <form id="logout-form" action="{{ route('tourist.logout') }}" method="POST" class="submit-form">
                            @csrf
                            <input type="submit" style="width: 100%;" value="Logout" name="logout" class="btn btn-danger btn-sm btn-logout mt-2" />
                        </form>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <footer>
        <div class="col">
            <img class="footer-logo" src="{{ asset('img/icons/LOGO-BANNER-TRANSPARENT.png') }}" alt="logo">
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
                <a href="{{ route('tourist.about') }}">About Us</a>
                <a href="{{ route('privacy') }}">Privacy Policy</a>
            </div>

            <div class="col">
                <h4>Account</h4>
                <a href="{{ route('tourist.users.show', Auth::id())}}">Profile</a>
                <a href="{{ route('tourist.leaderboard.index') }}">Leaderboard</a>
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
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
{{--<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>--}}
{{-- Bootstrap 5 --}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>--}}
<script>
{{--    Notification View All or Unread--}}
    $("#btn_all_notif").click(function (e){
        $("#unread_notif").hide();
        $("#all_notif").show();
        document.getElementById("btn_all_notif").classList.remove('btn-outline-secondary');
        document.getElementById("btn_all_notif").classList.add('btn-secondary');
        document.getElementById("btn_unread_notif").classList.remove('btn-secondary');
        document.getElementById("btn_unread_notif").classList.add('btn-outline-secondary');
        e.stopPropagation();
    });
    $("#btn_unread_notif").click(function (e){
        $("#all_notif").hide();
        $("#unread_notif").show();
        document.getElementById("btn_unread_notif").classList.remove('btn-outline-secondary');
        document.getElementById("btn_unread_notif").classList.add('btn-secondary');
        document.getElementById("btn_all_notif").classList.remove('btn-secondary');
        document.getElementById("btn_all_notif").classList.add('btn-outline-secondary');
        e.stopPropagation();
    });
    $("#btn_all_notif_mobile").click(function (e){
        $("#unread_notif_mobile").hide();
        $("#all_notif_mobile").show();
        document.getElementById("btn_all_notif_mobile").classList.remove('btn-outline-secondary');
        document.getElementById("btn_all_notif_mobile").classList.add('btn-secondary');
        document.getElementById("btn_unread_notif_mobile").classList.remove('btn-secondary');
        document.getElementById("btn_unread_notif_mobile").classList.add('btn-outline-secondary');
        e.stopPropagation();
    });
    $("#btn_unread_notif_mobile").click(function (e){
        $("#all_notif_mobile").hide();
        $("#unread_notif_mobile").show();
        document.getElementById("btn_unread_notif_mobile").classList.remove('btn-outline-secondary');
        document.getElementById("btn_unread_notif_mobile").classList.add('btn-secondary');
        document.getElementById("btn_all_notif_mobile").classList.remove('btn-secondary');
        document.getElementById("btn_all_notif_mobile").classList.add('btn-outline-secondary');
        e.stopPropagation();
    });

    $(".dropdown-item").click(function (e){
        e.stopPropagation();
    });

    $(document).ready(function () {
        $(".toast").toast('show');
        $('[data-toggle="tooltip"]').show();
        $('[data-toggle="popover"]').show();
    });
</script>
@stack('scripts')
</body>
</html>
