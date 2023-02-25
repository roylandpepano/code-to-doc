@extends('layouts.tourist-show')

@section('content-tourist-show')

    @if(Illuminate\Support\Facades\Session::has('success'))
        <div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 9999;">
            <!-- Position it -->
            <div style="position: absolute; top: 0; right: 0;">
                <!-- Then put toasts within -->
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
                    <div class="toast-header">
                        <img src="{{ asset('img/icons/LOGO-2.png') }}" class="rounded mr-2" alt="logo" style="width: 15px; height: 15px;">
                        <strong class="mr-auto" style="color: green;">Success</strong>
                        <small class="text-muted">just now</small>
                    </div>
                    <div class="toast-body">
                        {{ Illuminate\Support\Facades\Session::get('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <header>
        <div class="nav-bar">
            <img src="{{ asset('img/icons/LOGO-1.png') }}" class="img-logo" alt="logo">
            <div class="navigation" style="width: 100%; display: flex;">
                <ul id="navbar-dropdown" class="navbar-nav me-auto nav-items" style="margin-left: 35%; flex-direction: row;">
                    <i class="uil uil-times nav-close-btn"></i>
                    <li><a href="{{ route('tourist.home') }}" style="color: white;">Home</a></li>
                    <li><a href="{{ route('tourist.discover') }}" style="color: white;">Discover</a></li>
                    <li><a href="{{ route('tourist.tour_operator') }}" style="color: white;">Tour Operator</a></li>
                    <li><a href="{{ route('tourist.map') }}" style="color: white;">Map</a></li>
                    <li class="dropdown"><a href="#" class="trigger-drop" style="color: white;">More<i class="arrow"></i></a>
                        <ul class="drop">
                            <li><a href="{{ route('tourist.users.show', Auth::id())}}"><i class="fa-solid fa-user ml-0"></i>Account</a></li>
                            <li><a href="{{ route('tourist.discover.favorite_destinations')}}"><i class="fa-solid fa-map mr-2"></i>My Favorite Spots</a></li>
                            <li><a href="{{ route('tourist.tour_operator.favorite_tour_operators')}}"><i class="fa-solid fa-person-circle-check mr-2"></i>My Favorite Guides</a></li>
                            @if(Auth::guard('web')->user()->user_type === 'Tourist')
                                <li><a href="{{ route('tourist.add_destination') }}"><i class="fa-solid fa-location-dot mr-2"></i>Add Destination</a></li>
                                @if($owner === true)
                                    <li><a href="{{ route('owner.index') }}"><i class="fa-sharp fa-solid fa-file-pen mr-2"></i>Manage Page</a></li>
                                @endif
                            @elseif(Auth::guard('web')->user()->user_type === 'Tour Operator')
                                {{--                            @if($countSubTour<1)--}}
                                <li><a href="{{ route('tour_operator.add_tour_operator') }}"><i class="fa-solid fa-location-dot mr-2"></i>Add Tour Operator Page</a></li>
                                {{--                            @else--}}
                                <li><a href="{{ route('tour_operator.index') }}"><i class="fa-sharp fa-solid fa-file-pen mr-2"></i>Manage Page</a></li>
                                {{--                            @endif--}}
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
                <nav class="desktop main-header navbar navbar-expand navbar-white navbar-light">
                    <!-- Right navbar links -->
                    <ul class="navbar-nav">
                        <!-- Messages Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('chatify') }}" style="color: white;">
                                <i class="fa-regular fa-envelope fa-lg"></i>
                                {{--                            <span class="badge badge-danger navbar-badge">0</span>--}}
                            </a>
                        </li>
                        <!-- Notifications Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" style="color: white;">
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
            </div>
            <div class="navbar navbar-expand-md navbar-light"  id="message-notification-mobile">
                <div class="container">
                    <!-- Navbar notification for MOBILE SIZE-->
                    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-right: 13px;">
                        <!-- Right navbar links -->
                        <ul class="navbar-nav">
                            <!-- Messages Dropdown Menu -->
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('chatify') }}">
                                    <i class="fa-regular fa-envelope fa-lg" style="color: darkgray;"></i>
                                    {{--                            <span class="badge badge-danger navbar-badge">0</span>--}}
                                </a>
                            </li>
                            <!-- Notifications Dropdown Menu -->
                            <li class="nav-item dropdown">
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                    <i class="fa-regular fa-bell fa-lg" style="color: darkgray;"></i>
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
                    <i class="uil uil-apps nav-menu-btn"></i>
                </div>
            </div>
        </div>
    </header>
    <section id="show-header-banner">
        <img src="{{ asset('img/discover/discover-bg.jpg') }}" class="img-banner-show">
        <img src="{{ asset('img/discover/discover-bg-mobile.jpg') }}" class="img-banner-show-mobile">
        <div class="header show-animation"  style="">
            <h2 class="text-white">#<span class="auto-type"></span></h2>
            <p class="text-white">Manage Your Account</p>
        </div>
    </section>
    <section id="account-info" class="account-container">
        <div class="container">
            <h3 style="text-align:center; font-size: 28px; font-weight: bold">My Profile</h3>
            <div class="row">
                <div class="col-4 user-right">
                    <div class="rounded-circle">
                        <img src="{{ url(Auth::guard('web')->user()->user_picture) }}" alt="profile_pic" style="object-fit: cover;">
                    </div>
                    <h5>{{ Auth::guard('web')->user()->user_fname }} {{ Auth::guard('web')->user()->user_mname }} {{ Auth::guard('web')->user()->user_lname }} </h5>
                    <span>Joined: {{ Carbon\Carbon::parse(Auth::guard('web')->user()->created_at)->isoFormat('LLLL') }} </span>
                    @php
                        $pagesOwned = \App\Models\User::join('destinations', 'users.id', '=', 'destinations.user_id')
                            ->select('destinations.dest_owner', 'users.id')
                            ->where('destinations.user_id', '=', Auth::guard('web')->user()->id)
                            ->get();
                        $pagesOwnerCount = 0;
                        for($i=0; $i<count($pagesOwned); $i++){
                            if($pagesOwned[$i]->dest_owner === 1){
                                $pagesOwnerCount++;
                            }
                        }
                    @endphp
                    @if(Auth::guard('web')->user()->user_type === 'Tourist')
                        <div class="actions mt-4">
                            <a href="{{ route('tourist.leaderboard.index') }}" type="button" class="btn btn-outline-success" data-toggle="tooltip"
                               data-placement="top" title="Leaderboard"><i class="fa-solid fa-ranking-star"></i></a>
                            <div class = "button-group" style="display: inline-block">
                                {{-- Favorites --}}
                                <button type = "button" class="btn btn-outline-success" data-toggle = "dropdown" data-placement="top" title="Favorites">
                                    <i class="fa-solid fa-star"></i>
                                </button>
                                {{-- Favorites Dropdown --}}
                                <ul class = "dropdown-menu" role = "menu" style="margin-top: 1%;margin-left: -20%;  padding: 2%;">
                                    <li><a href = "{{ route('tourist.discover.favorite_destinations') }}"><i class="fa-solid fa-map-marked-alt mr-2"></i>Favorite Destinations</a></li>
                                    <li style="margin-left: -0.5%;"><a href = "{{ route('tourist.tour_operator.favorite_tour_operators') }}"><i class="fa-solid fas fa-user-check mr-2"></i>Favorite Tour Operators</a></li>
                                </ul>
                            </div>
                            {{-- Chatify --}}
                            <a href="{{ route('chatify') }}" type="button" class="btn btn-outline-success" data-toggle="tooltip"
                               data-placement="top" title="Inbox"><i class="fa-solid fa-envelope"></i>
                            </a>
                            <br>
                        </div>
                        <div class="submission mt-2">
                            <div class="submission-head mt-2" style="display: flex; justify-content: center;">
                                <span class="badge bg-primary">Submitted: {{ $countSubmitted }}</span>
                            </div>
                            <div class="submission-part mt-1">
                                <span class="badge bg-success">Approved: {{ $countApproved }}</span>
                                <span class="badge bg-warning">Pending: {{ $countPending }}</span>
                                <span class="badge bg-danger">Rejected: {{ $countRejected }}</span>
                            </div>
                        </div>
                    @elseif(Auth::guard('web')->user()->user_type === 'Owner' || $pagesOwnerCount>=1)
                        <div class="actions mt-4">
                            {{-- Owner Manage Page --}}
                            <a href="{{ route('owner.index') }}" type="button" class="btn btn-outline-success" data-toggle="tooltip"
                               data-placement="top" title="Manage Page"><i class="fa-sharp fa-solid fa-file-pen"></i>
                            </a>
                            {{-- Favorites --}}
                            <div class = "button-group" style="display: inline-block">
                                <button type = "button" class="btn btn-outline-success" data-toggle = "dropdown" data-placement="top" title="Favorites">
                                    <i class="fa-solid fa-star"></i>
                                </button>
                                {{-- Favorites Dropdown --}}
                                <ul class = "dropdown-menu" role = "menu" style="margin-top: 1%;margin-left: -20%;  padding: 2%;">
                                    <li><a href = "{{ route('tourist.discover.favorite_destinations') }}"><i class="fa-solid fa-map-marked-alt mr-2"></i>Favorite Destinations</a></li>
                                    <li style="margin-left: -0.5%;"><a href = "{{ route('tourist.tour_operator.favorite_tour_operators') }}"><i class="fa-solid fas fa-user-check mr-2"></i>Favorite Tour Operators</a></li>
                                </ul>
                            </div>
                            {{-- Chatify --}}
                            <a href="{{ route('chatify') }}" type="button" class="btn btn-outline-success" data-toggle="tooltip"
                               data-placement="top" title="Inbox"><i class="fa-solid fa-envelope"></i>
                            </a>
                            <br>
                        </div>
                    @elseif(Auth::guard('web')->user()->user_type === 'Tour Operator')
                        <div class="actions mt-4">
                            {{-- Tour Operator Manage Page --}}
                            <a href="{{ route('tour_operator.index', Auth::guard('web')->user()) }}" type="button" class="btn btn-outline-success" data-toggle="tooltip"
                               data-placement="top" title="Manage Page"><i class="fa-sharp fa-solid fa-file-pen"></i>
                            </a>
                            {{-- Favorites --}}
                            <div class = "button-group" style="display: inline-block">
                                <button type = "button" class="btn btn-outline-success" data-toggle = "dropdown" data-placement="top" title="Favorites">
                                    <i class="fa-solid fa-star"></i>
                                </button>
                                {{-- Favorites Dropdown --}}
                                <ul class = "dropdown-menu" role = "menu" style="margin-top: 1%;margin-left: -20%;  padding: 2%;">
                                    <li><a href = "{{ route('tourist.discover.favorite_destinations') }}"><i class="fa-solid fa-map-marked-alt mr-2"></i>Favorite Destinations</a></li>
                                    <li style="margin-left: -0.5%;"><a href = "{{ route('tourist.tour_operator.favorite_tour_operators') }}"><i class="fa-solid fas fa-user-check mr-2"></i>Favorite Tour Operators</a></li>
                                </ul>
                            </div>
                            {{-- Chatify --}}
                            <a href="{{ route('chatify') }}" type="button" class="btn btn-outline-success" data-toggle="tooltip"
                               data-placement="top" title="Inbox"><i class="fa-solid fa-envelope"></i>
                            </a>
                            <br>
                        </div>
                    @endif
                </div>
                <div class="col-8">
                    <div class="col-4 user-content">
                        <h4>Username</h4>
                        <input name="username" type="text" class="form-control"
                               value="{{ Auth::guard('web')->user()->user_username }}" disabled>
                        <br>
                        <h4>Email</h4>
                        <input type="email" class="form-control" value="{{ Auth::guard('web')->user()->user_email }}"
                               disabled>
                        <br>
                        @if(Auth::guard('web')->user()->user_logged_in_using === 'Email')
                            <div class="user_btn" style="justify-content: space-between;">
                                <a href="{{ route('password.forgot') }}" type="button" class="btn btn-outline-danger">Reset Password</a>
                                <a href="{{ route('tourist.users.edit', Auth::guard('web')->user()) }}" type="button"
                                   class="btn btn-warning">Edit</a>
                            </div>
                        @else
                            <div class="user_btn" style="justify-content: flex-end;">
                                <a href="{{ route('tourist.users.edit', Auth::guard('web')->user()) }}" type="button"
                                   class="btn btn-warning">Edit</a>
                            </div>
                        @endif
                    </div>
                    <div class="col-4 user-content">
                        <h4>Role</h4>
                        <input type="text" class="form-control" value="{{ Auth::guard('web')->user()->user_type }}"
                               disabled>
                        <br>
                        <h4>Other Info</h4>
                        <span>{{ Auth::guard('web')->user()->user_address }}</span>
                        <hr>
                        <span>{{ Auth::guard('web')->user()->user_phone }}</span>
                        <br>
                        <h4>Logged In Using</h4>
                        <div>
                            @if(Auth::guard('web')->user()->user_logged_in_using === 'Email')
                                <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top"
                                        title="Email"><i class="fa-solid fa-envelope-circle-check"></i></button>
                            @elseif(Auth::guard('web')->user()->user_logged_in_using === 'Facebook')
                                <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top"
                                        title="Facebook"><i class="fa-brands fa-facebook"></i></button>
                            @elseif(Auth::guard('web')->user()->user_logged_in_using === 'Google')
                                <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top"
                                        title="Google"><i class="fa-brands fa-google"></i></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('specific-css')
    <style>
        body{
            /*overflow-x: hidden;*/
        }
    </style>
@endpush

@push('scripts-tourist-show')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script>
        $(document).ready(function(){
            const typed = new Typed(".auto-type", {
                strings: ["Personalize", "Interact", "Travel"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });
            if(window.innerWidth < 1340){
                $('.col-4').removeClass('col-4');
            }
            $(".toast").toast('show');
            $('[data-toggle=tooltip]').show();
        });

        $(window).resize(function(){
            if(window.innerWidth < 1340){
                $('.col-4').removeClass('col-4');
            }else{
                $('.col-4').removeClass('col-4');
            }
        });
    </script>
@endpush
