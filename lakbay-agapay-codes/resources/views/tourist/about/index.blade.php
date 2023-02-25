@extends('layouts.tourist-new')

@section('content-tourist-new')

    <header>
        <div class="nav-bar">
            <img src="{{ asset('img/icons/LOGO-1.png') }}" class="img-logo" alt="logo">
            <div class="navigation" style="width: 100%; display: flex;">
                <ul id="navbar-dropdown" class="navbar-nav me-auto nav-items" style="margin-left: 37%; flex-direction: row;">
                    <i class="uil uil-times nav-close-btn"></i>
                    <li><a href="{{ route('tourist.home') }}" style="color: white;">Home</a></li>
                    <li><a href="{{ route('tourist.discover') }}" style="color: white;">Discover</a></li>
                    <li><a href="{{ route('tourist.tour_operator') }}" style="color: white;">Tour Operator</a></li>
                    <li><a href="{{ route('tourist.map') }}" style="color: white;">Map</a></li>
                    <li class="dropdown"><a href="#" class="trigger-drop" style="color: white;">More<i class="arrow"></i></a>
                        <ul class="drop">
                            <li><a href="{{ route('tourist.users.show', Auth::id())}}"><i class="fa-solid fa-user mr-2"></i>Account</a></li>
                            <li><a href="{{ route('tourist.discover.favorite_destinations')}}"><i class="fa-solid fa-map mr-2"></i>My Favorite Spots</a></li>
                            <li><a href="{{ route('tourist.tour_operator.favorite_tour_operators')}}"><i class="fa-solid fa-person-circle-check mr-2"></i>My Favorite Guides</a></li>

                            {{--                            @php--}}
                            {{--                                // Counts how many submission are already submitted--}}
                            {{--                                // Tourist = Can submit as many as they want--}}
                            {{--                                // Owner = Only 1--}}
                            {{--                                // Tour Operator = Only 1--}}
                            {{--                                $countSubDest = \App\Models\Destination::join('users', 'destinations.user_id', '=', 'users.id')--}}
                            {{--                                                    ->where('destinations.user_id', (\Illuminate\Support\Facades\Auth::guard('web')->user()->id))--}}
                            {{--                                                    ->count();--}}
                            {{--                                $countSubTour = \App\Models\TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')--}}
                            {{--                                                    ->where('tour_operators.user_id', (\Illuminate\Support\Facades\Auth::guard('web')->user()->id))--}}
                            {{--                                                    ->count();--}}
                            {{--                            @endphp--}}

                            {{--                        @if(Auth::guard('web')->user()->user_type === 'Tourist')--}}
                            {{--                            <li><a href="{{ route('tourist.add_destination') }}"><i class="fa-solid fa-location-dot mr-2"></i>Add Destination</a></li>--}}
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

    {{--    ABOUT-DESKTOP--}}
    <section id="about-desktop">

        <section id="about-bg">
            <img src="{{ asset('img/about/about-bg-2.jpg') }}">
            <h1 class="about-title reveal">ABOUT</h1>
            <h2 class="about-subtitle reveal">#<span class="auto-type"></span></h2>
        </section>
        <section id="main-section-one">
            <div class="banner-container-gradient-about">
                <div class="banner-container-about">
                    <div class="section-one-content reveal">
                        <img src="{{ asset('img/icons/LOGO-BANNER-1.png') }}" class="about-image">
                    </div>
                    <div class="section-one-content reveal">
                        <p class="about-content-one">
                            A responsive web-based application which aims to promote
                            the tourism of the Province of Albay, especially the new and emerging destinations, as well as the unpopular
                            wonders in this area. Being one of the most affected sectors — the tourism industry has been facing a lot of
                            problems for the past years since the emergence of the Coronavirus Disease 2019 (COVID-19). Thus, to aid the
                            economic recovery of the tourism sector, the developers opted to develop an application equipped with features
                            that could help you in browsing for more destinations and will surely bring you the best of Albay.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <h2 class="section-title reveal">Department of Tourism</h2>
        <section id="main-section-two">
            <div class="section-two-content-left reveal">
                <h3 class="content-title">Mission</h3>
                <p class="about-content-two">
                    The Department of Tourism (DOT) shall be the primary government agency charged with the
                    responsibility to encourage, promote, and develop tourism as a major socio-economic activity
                    to generate foreign currency and employment and to spread the benefits of tourism to both the
                    private and public sector.
                </p>
            </div>
            <div class="section-two-content-middle reveal">
                <img src="{{ asset('img/about/Department of Tourism.png') }}" class="about-dot-image">
            </div>
            <div class="section-two-content-right reveal">
                <h3 class="content-title">Vision</h3>
                <p class="about-content-two">
                    To develop a globally competitive, environmentally sustainable and socially
                    responsible tourism industry that promotes inclusive growth through employment generation
                    and equitable distribution of income thereby contributing to building a foundation for a high
                    trusted society.
                </p>
            </div>
        </section>
        <section id="main-section-three reveal">
            <div class="section-three-content">
                <a href="https://beta.tourism.gov.ph/">
                    <button class="learn-more reveal">
                <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                        <span class="button-text">Visit DOT</span>
                    </button>
                </a>
            </div>
        </section>
        <section id="main-section-four">
            <div class="section-four-content reveal">
                <iframe class=""
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1798.495476911029!2d123.75269689706518!3d13.164611110302028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a1019ff1121457%3A0x35ded5732d3c097d!2sDEPARTMENT%20OF%20TOURISM!5e0!3m2!1sen!2sph!4v1651315936270!5m2!1sen!2sph"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
        <h2 class="section-title reveal">Frequently Asked Questions (FAQs)</h2>
    </section>


    {{--    ABOUT-MOBILE--}}

    <section id="about-mobile">
        <section id="about-bg">
            <img src="{{ asset('img/about/about-bg-mobile.jpg') }}">
            <h1 class="about-title reveal">ABOUT</h1>
            <h2 class="about-subtitle reveal">#<span class="auto-type-mobile"></span></h2>
        </section>
        <section id="main-section-one">
            <div class="section-one-content reveal">
                <img src="{{ asset('img/icons/LOGO-BANNER-1.png') }}" class="about-image">
            </div>
            <div class="section-one-content reveal">
                <p class="about-content-one">
                    A responsive web-based application which aims to promote
                    the tourism of the Province of Albay, especially the new and emerging destinations, as well as the unpopular
                    wonders in this area. Being one of the most affected sectors — the tourism industry has been facing a lot of
                    problems for the past years since the emergence of the Coronavirus Disease 2019 (COVID-19). Thus, to aid the
                    economic recovery of the tourism sector, the developers opted to develop an application equipped with features
                    that could help you in browsing for more destinations and will surely bring you the best of Albay.
                </p>
            </div>
        </section>
        <h2 class="section-title reveal">Department of Tourism</h2>
        <section id="main-section-two">
            <div class="section-two-content-middle reveal">
                <img src="{{ asset('img/about/Department of Tourism.png') }}" class="about-dot-image">
            </div>
            <div class="section-two-content-left reveal">
                <h3 class="content-title">Mission</h3>
                <p class="about-content-two">
                    The Department of Tourism (DOT) shall be the primary government agency charged with the
                    responsibility to encourage, promote, and develop tourism as a major socio-economic activity
                    to generate foreign currency and employment and to spread the benefits of tourism to both the
                    private and public sector.
                </p>
            </div>
            <div class="section-two-content-right reveal">
                <h3 class="content-title">Vision</h3>
                <p class="about-content-two">
                    To develop a globally competitive, environmentally sustainable and socially
                    responsible tourism industry that promotes inclusive growth through employment generation
                    and equitable distribution of income thereby contributing to building a foundation for a high
                    trusted society.
                </p>
            </div>
        </section>
        <section id="main-section-three reveal">
            <div class="section-three-content">
                <a href="https://beta.tourism.gov.ph/">
                    <button class="learn-more reveal">
                <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                        <span class="button-text">Visit DOT</span>
                    </button>
                </a>
            </div>
        </section>
        <section id="main-section-four">
            <div class="section-four-content reveal">
                <iframe class=""
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1798.495476911029!2d123.75269689706518!3d13.164611110302028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a1019ff1121457%3A0x35ded5732d3c097d!2sDEPARTMENT%20OF%20TOURISM!5e0!3m2!1sen!2sph!4v1651315936270!5m2!1sen!2sph"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
        <h2 class="section-title reveal">Frequently Asked Questions (FAQs)</h2>
    </section>
    <section class="faq-section section-p1 mt-2">
        <div class='faq mt-4 reveal'>
            <input id='faq-a' type='checkbox'>
            <label for='faq-a'>
                <p class="faq-heading">Is this only available in the Province of Albay?</p>
                <div class='faq-arrow'></div>
                <p class="faq-text">Yes, Lakbay Agapay is only available in the Province of Albay. This website is developed to promote the tourism in the said province. Thus, this will only cater the destinations found here as well as the unpopular ones. Albay-based tour operators are also only the ones allowed in this website.</p>
            </label>
            <input id='faq-b' type='checkbox'>
            <label for='faq-b'>
                <p class="faq-heading">How do I transact with tour operators and destination owners?</p>
                <div class='faq-arrow'></div>
                <p class="faq-text">Lakbay Agapay has a messaging feature in which you can message your desired destination or your preferred tour operator. In messaging a destination, you first need to log in on the website or sign in if you still do not have an account. After doing so, you can access the "Discover" page, click your desired destination and you will be redirected to its details where the messaging feature can be found. The same goes in messaging tour operators in the "Tour Operator" page.</p>
            </label>
            <input id='faq-c' type='checkbox'>
            <label for='faq-c'>
                <p class="faq-heading">Can I make a reservation on the desired destination or tour package that I want in this website?</p>
                <div class='faq-arrow'></div>
                <p class="faq-text">Yes, you can make a reservation on your desired destination or tour package by messaging its owner through this website.</p>
            </label>
            <input id='faq-d' type='checkbox'>
            <label for='faq-d'>
                <p class="faq-heading">Can I send a list of my favorite spots to my preferred tour operator?</p>
                <div class='faq-arrow'></div>
                <p class="faq-text">Yes, you can send a list of your favorite spots to tour operators. Just go to the "My Favorite Spots" page and in there, you can see a "copy" button in which you can copy the names of the destination and the link to their site. With this, you can now send the list that you copied to your preferred tour operator.</p>
            </label>
            <input id='faq-e' type='checkbox'>
            <label for='faq-e'>
                <p class="faq-heading">What are some of the best travel locations that most people have not heard of?</p>
                <div class='faq-arrow'></div>
                <p class="faq-text">Lakbay Agapay is equipped with features that will help you in finding your desired locations easily. The "Discover" page has a filter function wherein you can filter the "Hidden Gems" location.</p>
            </label>
            <input id='settings' type='checkbox'>
            <input id='faq-f' type='checkbox'>
        </div>
    </section>
    <section class="contact">
        <div class="contact-title">
            <h4><strong>Emergency Hotlines</strong></h4>
        </div>
        <div class="contact-body">
            <div class="row">
                <div class="row-item">
                    <img src="{{ asset('img/about/bfp.png') }}" alt="bfp">
                    <div class="row-item-text">
                        <h6>BFP ALBAY</h6>
                        <p>0919 992 5484</p>
                        <p>0917 893 2416</p>
                    </div>
                </div>
                <div class="row-item">
                    <img src="{{ asset('img/about/albay.jpg') }}" alt="albayems">
                    <div class="row-item-text">
                        <h6>ALBAY EMS</h6>
                        <p>0918 911 9911</p>
                    </div>
                </div>
                <div class="row-item">
                    <img src="{{ asset('img/about/pagasa.png') }}" alt="pagasa">
                    <div class="row-item-text">
                        <h6>PAGASA ALBAY</h6>
                        <p>481 4472 /
                            481 4454-55</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row-item">
                    <img src="{{ asset('img/about/pnp.png') }}" alt="pnp">
                    <div class="row-item-text">
                        <h6>PNP ALBAY</h6>
                        <p>0998 598 5926</p>
                        <p>0926 625 6247</p>
                    </div>
                </div>
                <div class="row-item">
                    <img src="{{ asset('img/about/rdrrmc.png') }}" alt="rdrrmc">
                    <div class="row-item-text">
                        <h6>OCD/RDRRMC</h6>
                        <p>0917 574 7880</p>
                    </div>
                </div>
                <div class="row-item">
                    <img src="{{ asset('img/about/brtth.jpg') }}" alt="brtth">
                    <div class="row-item-text">
                        <h6>BRTTH HEMS</h6>
                        <p>732 5555 /
                            732 5501</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('specific-css-new')
    <style>
        .contact{
            display: flex;
            flex-direction: column;
        }
        .contact-title{
            text-align: center;
        }
        .contact-body{
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        .contact .contact-body .row{
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        .contact .contact-body .row .row-item{
            margin: 5px;
            width: 25%;
            height: 150px;
            background-color: #F8FAFC;
            text-align: center;
            color: #286E6C;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px #CED5DB solid;
            transition: 0.5s ease;
        }
        .contact .contact-body .row .row-item:hover{
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.3);
        }
        .contact .contact-body .row .row-item img{
            width: 50px;
            height: 50px;
            position: relative !important;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }
        .contact .contact-body .row .row-item .row-item-text{
            margin: 0 0 0 15px !important;
            text-align: initial;
        }
        .contact .contact-body .row .row-item .row-item-text p{
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            color: #17252A;
        }
        @media screen and (max-width:477px){
            .contact .contact-body .row .row-item{
                width: 90%;
                margin: 5px 10px;
            }
            .contact .contact-body .row{
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
@endpush

@push('scripts-tourist-new')
    <script>
        $(document).ready(function() {
            const typed = new Typed(".auto-type", {
                strings: ["FindUs", "GetInTouch", "MeetDOT"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            const typed = new Typed(".auto-type-mobile", {
                strings: ["FindUs", "GetInTouch", "MeetDOT"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });
        });
    </script>
@endpush
