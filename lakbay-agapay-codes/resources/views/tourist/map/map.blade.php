@extends('layouts.tourist-new')

@section('content-tourist-new')

    <header>
        <div class="nav-bar">
            <img src="{{ asset('img/icons/LOGO-1.png') }}" class="img-logo">
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

    {{--  Desktop Mode  --}}
    <div class="desktop-map">
        <section id="discover-and-tourop-bg-desktop">
            <img src="{{ asset('img/map/map.jpg') }}">
            <h1 class="discover-and-tourop-title reveal">Map</h1>
            <h2 class="discover-and-tourop-subtitle reveal">#<span class="auto-type"></span></h2>
        </section>
        <section id="discover-and-tourop-banner-desktop">
            <div class="banner-container-gradient">
                <div class="banner-container">
                    <div class="banner-content-left reveal">
                        <p style="font-size: 14px;">
                            Navigate the map here in Albay with Lakbay Agapay. Searching for destinations has never been
                            made so easy before. Now with Lakbay Agapay, you can now explore different destinations of your go-to places here in
                            the province and experience the breathtaking beauty of Albay.
                        </p>
                        <div class="btn-explore">
                            <a href="#map"><button class="explore-more" style="font-size: 12px;"><i class="fa-solid fa-angles-down"></i> Explore More</button></a>
                        </div>
                    </div>
                    <div class="banner-content-right">
                        <h3 class="banner-content-title reveal">Suggested Places</h3>
                        <div class="pictures-featured">
                            <div class="picture-box">
                                <a href="{{ route('tourist.discover.show',$rand1->id) }}"><img src="{{ asset($rand1->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                            <div class="picture-box">
                                <a href="{{ route('tourist.discover.show',$rand2->id) }}"><img src="{{ asset($rand2->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                            <div class="picture-box">
                                <a href="{{ route('tourist.discover.show',$rand3->id) }}"><img src="{{ asset($rand3->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{--  Mobile Mode  --}}
    <div class="mobile-map">
        <section id="discover-and-tourop-bg-mobile">
            <section id="discover-and-tourop-bg">
                <img src="{{ asset('img/map/map-mobile.jpg') }}">
                <h1 class="discover-and-tourop-title reveal">Map</h1>
                <h2 class="discover-and-tourop-subtitle reveal">#<span class="auto-type-mobile"></span></h2>
            </section>
        </section>
        <section id="discover-and-tourop-banner-mobile">
            <div class="banner-container-gradient">
                <div class="banner-container">
                    <div class="banner-content-left reveal">
                        <p style="font-size: 14px;">
                            Navigate the map here in Albay with Lakbay Agapay. Searching for destinations has never been
                            made so easy before. Now with Lakbay Agapay, you can now explore different destinations of your go-to places here in
                            the province and experience the breathtaking beauty of Albay.
                        </p>
                        <div class="btn-explore">
                            <a href="#map"><button class="explore-more" style="font-size: 12px;"><i class="fa-solid fa-angles-down"></i> Explore More</button></a>
                        </div>
                    </div>
                    <div class="banner-content-right">
                        <h3 class="banner-content-title reveal">Suggested Places</h3>
                        <div class="pictures-featured">
                            <div class="picture-box">
                                <a href="{{ route('tourist.discover.show',$rand1->id) }}"><img src="{{ asset($rand1->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                            <div class="picture-box">
                                <a href="{{ route('tourist.discover.show',$rand2->id) }}"><img src="{{ asset($rand2->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                            <div class="picture-box">
                                <a href="{{ route('tourist.discover.show',$rand3->id) }}"><img src="{{ asset($rand3->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="banner-container-gradient-map">
        <div class="banner-container">
            <div class="map-frame shadow" id="map">Loading Map</div>
        </div>
    </div>
    @foreach($destinations as $destination)
        <input class="dest_id" type="text" value="{{ $destination->id }}" hidden />
        <input class="dest_name" type="text" value="{{ $destination->dest_name }}" hidden />
        <input class="dest_city" type="text" value="{{ $destination->dest_city }}" hidden />
        <input class="dest_rate" type="text" value="{{ $destination->dest_rating_average }}" hidden />
        <input class="dest_lat" type="text" value="{{ $destination->dest_latitude }}" hidden />
        <input class="dest_long" type="text" value="{{ $destination->dest_longitude }}" hidden />
        <input class="dest_img" type="text" value="{{ $destination->dest_main_picture }}" hidden />
    @endforeach
    <input id="counter" type="text" value="{{ $destinations->count() }}" hidden />

@endsection

@push('specific-css-new')
    <style>
        #map{
            height: 93vh;
            margin-top: 14vh;
        }
        table{
            text-align: center;
        }
        .navigation .nav-items a{
            margin-right: 45px !important;
        }
        section img {
            height: 98%;
        }
        .map-frame {
            border-radius: 0;
        }
        .banner-container-gradient-map{
            z-index: 0;
            content: '';
            position: absolute;
            width: 100%;
            height: 50px;
            margin-top: 20px;
            background: linear-gradient(transparent, var(--main-bg-color));
        }
        .footer{
            display: none;
        }
        #navbar-dropdown li{
            padding: 0 !important;
        }

        @media screen and (max-width:477px){
            .desktop-map{
                display: none;
            }

            #map{
                margin-top: 69vh;
                height: 93vh !important;
            }
        }
    </style>
@endpush

@push('scripts-tourist-new')
    <script>
        $(document).ready(function() {
            const typed = new Typed(".auto-type-mobile", {
                strings: ["BrowseAlbay", "NavigateAlbay", "ExploreAlbay"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });

            $(".toast").toast('show');
            $('[data-toggle=tooltip]').show();
        });
    </script>
    <script>
        $(document).ready(function () {
            const typed = new Typed(".auto-type", {
                strings: ["BrowseAlbay", "NavigateAlbay", "ExploreAlbay"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });

            $(".toast").toast('show');
            $('[data-toggle=tooltip]').show();
        });

        $("#category").popover({html:true, sanitize : false});
        $("#category-mobile").popover({html:true, sanitize : false});

        //Show Destination Map
        function initialize() {
            //MAP VIEW
            //Map Settings
            let mapOptions = {
                center: {lat: 13.143986664725428, lng: 123.72595988123209},
                zoom: 10,
                mapId: "e3a69f21a8a07bc3",
            };
            //Displaying map to div
            let map = new google.maps.Map(document.getElementById("map"), mapOptions);

            //Creating Map Marker
            let counter = document.getElementById('counter').value;
            for(let i = 0; i < counter; i++){
                let dest_lat = document.getElementsByClassName('dest_lat')[i].value;
                let dest_long = document.getElementsByClassName('dest_long')[i].value;
                let dest_name = document.getElementsByClassName('dest_name')[i].value;
                let dest_city = document.getElementsByClassName('dest_city')[i].value;
                let dest_rate = document.getElementsByClassName('dest_rate')[i].value;
                let dest_img = document.getElementsByClassName('dest_img')[i].value;
                let img = "{{ asset(':img') }}"
                img = img.replace(':img', dest_img);

                let dest_id = document.getElementsByClassName('dest_id')[i].value;
                let url = '{!! route('tourist.discover.show',':id') !!}'
                url = url.replace(':id', dest_id);
                //Marker Settings
                let markerOptions = {
                    position: {lat: parseFloat(dest_lat), lng: parseFloat(dest_long)},
                    map: map,
                    optimized: false, //Enables event
                    icon: {
                        url: '{{ asset('img/location.png') }}',
                        scaledSize: new google.maps.Size(38, 50),
                        anchor: new google.maps.Point(19.45, 51.5), //pinpoint location
                    },
                    title: "Click to view details",
                    animation: google.maps.Animation.BOUNCE,
                    draggable: false,
                };
                //Display Marker
                let marker = new google.maps.Marker(markerOptions);
                // marker.setLabel("yey"); //outside markerOptions

                //Marker Animation Stop
                setTimeout(() => {
                    marker.setAnimation(null);
                }, 2000);

                //Click!
                let infowindow = new google.maps.InfoWindow();
                let infowindow2 = new google.maps.InfoWindow();

                marker.addListener('click', function () {
                    infowindow.close();
                    infowindow2.open(map, marker);
                    infowindow2.setContent(`
                        <table style="width: 300px; max-height: 150px;">
                            <tr>
                                <td rowspan="4">
                                    <img class="ml-1 mr-1 rounded shadow" style="width: auto;height: auto; max-height: 150px; max-width:200px;" src="`+ img +`">
                                </td>
                                <td style="height: 10px"><h2 style="font-size: 15pt">`
                        + dest_name +
                        `</h2></td>
                            </tr>
                            <tr>
                                <td style="height: 10px"><h3 style="font-size: 10pt">`
                        + dest_city +
                        `</h3></td>
                            </tr>
                            <tr>
                                <td style="height: 10px">
                                    <svg style="display:none;">
                                        <defs>
                                            <symbol id="fivestars">
                                                <path
                                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                                    fill="white" fill-rule="evenodd"/>
                                                <path
                                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                                    fill="white" fill-rule="evenodd" transform="translate(24)"/>
                                                <path
                                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                                    fill="white" fill-rule="evenodd" transform="translate(48)"/>
                                                <path
                                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                                    fill="white" fill-rule="evenodd" transform="translate(72)"/>
                                                <path
                                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                                    fill="white" fill-rule="evenodd" transform="translate(96)"/>
                                            </symbol>
                                        </defs>
                                    </svg>
                                    <div class="rating" style="display: inline-block;  margin-top: 2%; margin-left: -1%;">
                                        <progress class="rating-bg" value="`+ dest_rate +`"
                                                  max="5"></progress>
                                        <svg>
                                            <use xlink:href="#fivestars"/>
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="`+url+`" class='btn btn-primary col-10 mb-3 mt-2'>View</a>
                                </td>
                            </tr>
                        </table>
                    `);
                });
                marker.addListener('mouseover', function () {
                    infowindow2.close();
                    infowindow.open(map, marker);
                    infowindow.setContent(`
                        <table style="width: 300px; max-height: 150px;">
                            <tr><td colspan="2"><b style="background-color: #FFC107; color: black" class="p-1 rounded shadow" >click marker to pin</b></td></tr>
                            <tr>
                                <td rowspan="4">
                                    <img class="ml-1 mr-1 rounded shadow" style="width: auto;height: auto; max-height: 150px; max-width:200px;" src="`+ img +`">
                                </td>
                                <td style="height: 10px"><h2 style="font-size: 15pt">`
                        + dest_name +
                        `</h2></td>
                            </tr>
                            <tr>
                                <td style="height: 10px"><h3 style="font-size: 10pt">`
                        + dest_city +
                        `</h3></td>
                            </tr>
                            <tr>
                                <td style="height: 10px">
                                    <svg style="display:none;">
                                        <defs>
                                            <symbol id="fivestars">
                                                <path
                                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                                    fill="white" fill-rule="evenodd"/>
                                                <path
                                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                                    fill="white" fill-rule="evenodd" transform="translate(24)"/>
                                                <path
                                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                                    fill="white" fill-rule="evenodd" transform="translate(48)"/>
                                                <path
                                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                                    fill="white" fill-rule="evenodd" transform="translate(72)"/>
                                                <path
                                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                                    fill="white" fill-rule="evenodd" transform="translate(96)"/>
                                            </symbol>
                                        </defs>
                                    </svg>
                                    <div class="rating" style="display: inline-block;  margin-top: 2%; margin-left: -1%;">
                                        <progress class="rating-bg" value="`+ dest_rate +`"
                                                  max="5"></progress>
                                        <svg>
                                            <use xlink:href="#fivestars"/>
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="`+url+`" class='btn btn-primary col-10 mb-3 mt-2'>View</a>
                                </td>
                            </tr>
                        </table>
                    `);
                });
                marker.addListener("mouseout", function () {
                    infowindow.close();
                });
            }
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbV7DVh7RNb9up1QQt0zFabQZdcDmzgM8&map_ids=e3a69f21a8a07bc3&callback=initialize&v=weekly"
        defer></script>
@endpush
