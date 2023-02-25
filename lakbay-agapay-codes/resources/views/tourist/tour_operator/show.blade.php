@extends('layouts.tourist-show')

@section('content-tourist-show')
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
        <img src="{{ asset('img/tour_operator/tour-op-bg-show.jpg') }}" class="img-banner-show">
        <img src="{{ asset('img/tour_operator/tour-op-bg-show-mobile.jpg') }}" class="img-banner-show-mobile">
    </section>
    <section id="show-main-section">
        <div id="d-item" class="section-p1 discover-item bg-white col-11 mb-5 pb-4 mx-auto shadow" style="border-radius: 9px">
            <div class="map-view col-sm-5">
                <img class=" pb-2 pt-2" src="{{ asset($operator_item->operator_main_picture) }}" alt="Loading..." style="max-width: 100%">
                <div class="contact-details">
                    @if($ownerID->user_type === 'Tour Operator')
                        <button id="chatify_to" data-id="{{ $ownerID->uid }}" data-action="0" type="button"
                                class="btn btn-primary message" style="width:100%;"><i class="fa-solid fa-envelope"></i> Message
                        </button>
                    @endif
                        <button id="btn-contact" type="button" class="btn btn-success btn-message" data-bs-toggle="modal"
                                data-bs-target="#contact"><i class="fa-solid fa-address-book"></i> Contact Info
                        </button>

                    <!-- Contact Modal -->
                    <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="contactLabel"
                         data-backdrop="static"
                         data-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="contactLabel"><strong>Contact Information</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md">
                                                <h5>Phone Number: </h5>
                                                <p>{{$operator_item->operator_phone_number}}</p>
                                            </div>
                                            <div class="col-md">
                                                <h5>Email Address: </h5>
                                                <p>{{$operator_item->operator_email}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span id="modal-nop">{{$operator_item->operator_location}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="place-details">
                <div class="pd-link">
                    <a href="{{ route('tourist.tour_operator') }}">Home </a>
                    <h5> / </h5>
                    <a href="/tourist/search-tour-operator?search={{ $operator_item->operator_city }}">{{$operator_item->operator_city}}</a>
                </div>
                <h4><strong>{{$operator_item->operator_company}}</strong>
                    <br>
                    @if(($operator_item->operator_operating) == 1)
                        <h6 style="width: fit-content; background: darkred; color: #fff; border-radius: 10px; padding: 8px;">NONOPERATIONAL</h6>
                        <br>
                    @endif
                </h4>
                <div class="star" style="margin-top: 40px;">
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
                    <div class="rating" style="margin-left: 0 !important;">
                        <!--   <div class="rating-bg" style="width: 90%;"></div> -->
                        <progress class="rating-bg" value="{{$rate_average}}" max="5"></progress>
                        <svg id="rate_scroll">
                            <use xlink:href="#fivestars"/>
                        </svg>
                    </div>
                </div>
                <h5 class="place-title">Description</h5>
                <p style="text-align: justify; white-space: pre-wrap;">{{$operator_item->operator_description}}</p>
                <h5 class="place-title">Services</h5>
                <p style="text-align: justify; white-space: pre-wrap;">{{$operator_item->operator_services}}</p>
                @if(($operator_item->operator_fb != "") || ($operator_item->operator_twitter != "") || ($operator_item->operator_instagram != "") || ($operator_item->operator_website != ""))
                    <h5 class="place-title">Links</h5>
                    <div>
                        @if ($operator_item->operator_fb != '')
                            <a href="{{$operator_item->operator_fb}}" type="button" class="btn btn btn-light btn-links"><i
                                    class="fab fa-facebook-f"></i></a>
                        @endif
                        @if ($operator_item->operator_twitter != '')
                            <a href="{{$operator_item->operator_twitter}}" type="button" class="btn btn btn-light btn-links"><i
                                    class="fab fa-twitter"></i></a>
                        @endif
                        @if ($operator_item->operator_instagram != '')
                            <a href="{{$operator_item->operator_instagram}}" type="button" class="btn btn btn-light btn-links"><i
                                    class="fab fa-instagram"></i></a>
                        @endif
                        @if ($operator_item->operator_website != '')
                            <a href="{{$operator_item->operator_website}}" type="button" class="btn btn btn-light btn-links"><i
                                    class="fa-solid fa-earth-asia"></i></a>
                        @endif
                    </div>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="GoogleStreetView" tabindex="-1" role="dialog" aria-labelledby="GoogleStreetView"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Street View
                                    of {{$operator_item->operator_company}}</h5>
                            </div>
                            <div class="modal-body">
                                <iframe src="{{$operator_item->operator_streetview}}" width="500vh" height="450vh"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="item-slider" class="image-slider">
        <div class="discover-pictures shadow">
            @foreach($operator_images as $operator_image)
                <img src="{{ asset($operator_image->operator_image) }}" alt="Loading...">
            @endforeach
        </div>
    </section>
    <br>

    <section id="item-slider" class="packages-box">
        <h3 style="text-align: center"><strong>Packages</strong></h3>
        <div class="packagespage shadow rounded bg-white">
            @include('to_packages')
        </div>
    </section>


    <div id="item-ratings" class="ratings-box mb-5">
        <div class="card shadow mb-4">
            <div class="card-header">Rate Your Experience</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating">{{$rate_average}}</span> / 5</b>
                        </h1>
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
                        <div class="rating">
                            <!--   <div class="rating-bg" style="width: 90%;"></div> -->
                            <progress class="rating-bg" value="{{$rate_average}}" max="5"></progress>
                            <svg>
                                <use xlink:href="#fivestars"/>
                            </svg>
                        </div>
                        <br>
                        @if($total > 1)
                            <h3><span id="total_review">{{$total}}</span> Reviews</h3>
                        @else
                            <h3><span id="total_review">{{$total}}</span> Review</h3>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <p>
                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_five_star_review">{{$count_five}}</span>)
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{$average_five}}%" role="progressbar"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="five_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_four_star_review">{{$count_four}}</span>)
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{$average_four}}%" role="progressbar"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="four_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_three_star_review">{{$count_three}}</span>)
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{$average_three}}%" role="progressbar"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="three_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_two_star_review">{{$count_two}}</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{$average_two}}%" role="progressbar"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="two_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_one_star_review">{{$count_one}}</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$average_one}}%"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="one_star_progress"></div>
                        </div>
                        </p>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3 class="mt-4 mb-3">Write Review Here</h3>
                        <button id="btn-review" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#review">Review
                        </button>

                        <!-- Review Modal -->
                        @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
                            <script>
                                $(function () {
                                    $('#review').modal('show');
                                });
                            </script>
                        @endif
                        @if ($findReview)
                            <div class="modal fade" id="review" tabindex="-1" role="dialog"
                                 aria-labelledby="reviewLabel" data-backdrop="static"
                                 data-keyboard="false">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="reviewLabel"><strong></strong></h4>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">x
                                            </button>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md">
                                                    <div class="modal-body, alert alert-danger alert-dismissible">
                                                        You have already submitted a review for this tour operator.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @else
                        <div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="reviewLabel"
                             data-backdrop="static"
                             data-keyboard="false">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modalLabel">
                                            <strong>{{$operator_item->operator_company}}</strong></h4>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">x</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <form method="POST" action="{{url('/add-rating')}}" name="ratingForm"
                                                  id="ratingForm" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="tour_operator_id"
                                                       value="{{$operator_item['id']}}">
                                                <h4>Rate</h4>
                                                <div class="rate">
                                                    <input type="radio" id="star5" name="rate" value="5"
                                                           @if(old('rate') == 5) checked @endif />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" name="rate" value="4"
                                                           @if(old('rate') == 4) checked @endif/>
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" name="rate" value="3"
                                                           @if(old('rate') == 3) checked @endif/>
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" name="rate" value="2"
                                                           @if(old('rate') == 2) checked @endif/>
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" name="rate" value="1"
                                                           @if(old('rate') == 1) checked @endif/>
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                                <br>
                                                <br>
                                                <span class="text-danger error-text rate_error"></span>
                                                <div class="form-group">
                                                    <h4>Review</h4>
                                                    <textarea style="resize: none" maxlength="500" rows="4" cols="50"
                                                              name="review" id="review" class="form-control"
                                                              placeholder="Type Review Here">{{ old('review') }}</textarea>
                                                </div>

                                                <div id="the-count">
                                                    <span id="current">0</span>
                                                    <span id="maximum">/ 500</span>
                                                </div>
                                                <span class="text-danger error-text review_error"></span>
                                                <br>
                                                <br>
                                                <div class="form-group">
                                                    <h8>You may add one to three photos:</h8>
                                                    <br>
                                                    <br>

                                                    <label style="width: 100%">
                                                        <div class="new_image1_div col-12" id="new_image1_div" style=" display: none;">
                                                            <img src="" id="new_image1" class="new_image1 col-12 bg-white img-thumbnail rounded mx-auto d-block" style="height: 200px; width: auto;">
                                                            <br>
                                                        </div>
                                                        <input style="float: left; width: 88%" name="image_one"
                                                               class="form-control" id="formFile1" type="file"
                                                               accept="image/*" onchange="previewFile1(this);">
                                                        <button class="btn btn-secondary"  style="float: left; margin-left: 2%; width: 10%;" id="reset1" type="button" disabled>
                                                            <i class="fas fa-times fa-lg mx-auto"></i>
                                                        </button>
                                                        <span class="text-danger error-text image_one_error"></span>
                                                    </label>
                                                    <br>

                                                    <label style="width: 100%">
                                                        <div class="new_image2_div col-12" id="new_image2_div" style=" display: none;">
                                                            <img src="" id="new_image2" class="new_image2 col-12 bg-white img-thumbnail rounded mx-auto d-block" style="height: 200px; width: auto;">
                                                            <br>
                                                        </div>
                                                        <input style="float: left; width: 88%" name="image_two"
                                                               class="form-control" id="formFile2" type="file"
                                                               accept="image/*" onchange="previewFile2(this);">
                                                        <button class="btn btn-secondary"  style="float: left; margin-left: 2%; width: 10%;" id="reset2" type="button" disabled>
                                                            <i class="fas fa-times fa-lg mx-auto"></i>
                                                        </button>
                                                        <span class="text-danger error-text image_two_error"></span>
                                                    </label>
                                                    <br>

                                                    <label style="width: 100%">
                                                        <div class="new_image3_div col-12" id="new_image3_div" style=" display: none;">
                                                            <img src="" id="new_image3" class="new_image3 col-12 bg-white img-thumbnail rounded mx-auto d-block" style="height: 200px; width: auto;">
                                                            <br>
                                                        </div>
                                                        <input style="float: left; width: 88%" name="image_three"
                                                               class="form-control" id="formFile3" type="file"
                                                               accept="image/*" onchange="previewFile3(this);">
                                                        <button class="btn btn-secondary"  style="float: left; margin-left: 2%; width: 10%;" id="reset3" type="button" disabled>
                                                            <i class="fas fa-times fa-lg mx-auto"></i>
                                                        </button>
                                                        <span class="text-danger error-text image_three_error"></span>
                                                    </label>
                                                    <br>


                                                </div>
                                                <div class="form-group text-center mt-4">
                                                    <button style="margin-bottom: 1%" type="submit" class="btn btn-primary" id="save_review">
                                                        Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endif
            </div>
        </div>
        <div>
        </div>
    </div>
    <section class="reviews shadow rounded">
        @include('reviews_pagination')
    </section>
    </section>

@endsection

@push('specific-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
        @media screen and (min-width: 992px) {
            #d-item {
                margin-top: 0 !important;
            }

            .discover-item {
                padding: 0 !important;
            }

            .section-p1 {
                padding: 45px 70px !important;
            }
            .col-11{
                width: 82.666667%;
            }
            .image-slider{
                padding: 0 8.6%;
            }
            .packages-box{
                padding: 0 8.6%;
            }
            .ratings-box{
                padding: 0 8.6%;
            }
        }

        @media screen and (min-width: 477px){

        }
    </style>
@endpush

@push('scripts-tourist-show')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        function previewFile1(input){
            //Add new entry increases/decreases form size
            let increase =  parseInt(document.getElementById('ratingForm').offsetHeight) + 200;
            let size1 = (increase.toString()).concat("px");
            document.getElementById("ratingForm").style.height = size1;

            let file = $("#formFile1").get(0).files[0];
            if(file){
                let reader = new FileReader();
                reader.onload = function(){
                    $(".new_image1").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
            $('.new_image1_div').show();
        }
        function previewFile2(input){
            //Add new entry increases/decreases form size
            let increase =  parseInt(document.getElementById('ratingForm').offsetHeight) + 200;
            let size1 = (increase.toString()).concat("px");
            document.getElementById("ratingForm").style.height = size1;

            let file = $("#formFile2").get(0).files[0];
            if(file){
                let reader = new FileReader();
                reader.onload = function(){
                    $(".new_image2").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
            $('.new_image2_div').show();
        }
        function previewFile3(input){
            //Add new entry increases/decreases form size
            let increase =  parseInt(document.getElementById('ratingForm').offsetHeight) + 200;
            let size1 = (increase.toString()).concat("px");
            document.getElementById("ratingForm").style.height = size1;

            let file = $("#formFile3").get(0).files[0];
            if(file){
                let reader = new FileReader();
                reader.onload = function(){
                    $(".new_image3").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
            $('.new_image3_div').show();
        }
        $(document).ready(function() {
            //Rating Scroll on click
            $("#rate_scroll").click(function() {
                $('html, body').animate({
                    scrollTop: $("#item-ratings").offset().top
                }, 0);
            });
            $('textarea').keyup(function(event) {
                let characterCount = $(this).val().length,
                    current = $('#current'),
                    maximum = 500,
                    theCount = $('#the-count');

                current.text(characterCount);
            })

            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();

                let url = $(this).attr('href');
                getReviews(url);
                window.history.pushState("", "", url);
            });

            function getReviews(url) {
                $.ajax({
                    url: url,
                    data: { id: 0 }
                }).done(function (data) {
                    $('.reviews').html(data);
                }).fail(function () {
                    alert('Reviews could not be loaded.');
                });
            }

            $(document).on('click', '.pagination a', function (e) {
                let url = $(this).attr('href');
                getPackages(url);
                window.history.pushState("", "", url);
            });

            function getPackages(url) {
                $.ajax({
                    url: url,
                    data: { id: 1 }
                }).done(function (data) {
                    $('.packagespage').html(data);

                }).fail(function () {
                    alert('Packages could not be loaded.');
                });
            }
            document.getElementById('reset1').onclick = function () {
                let image_one = document.getElementById('formFile1');
                image_one.value = image_one.defaultValue;
                $('.new_image1_div').hide(100);
                //Add new entry increases/decreases form size
                let increase =  parseInt(document.getElementById('ratingForm').offsetHeight) - 200;
                let size = (increase.toString()).concat("px");
                document.getElementById("ratingForm").style.height = size;
                $("#reset1").prop("disabled",true);
            }
            document.getElementById('reset2').onclick = function () {
                let image_one = document.getElementById('formFile2');
                image_one.value = image_one.defaultValue;
                $('.new_image2_div').hide(100);
                //Add new entry increases/decreases form size
                let increase =  parseInt(document.getElementById('ratingForm').offsetHeight) - 200;
                let size = (increase.toString()).concat("px");
                document.getElementById("ratingForm").style.height = size;
                $("#reset2").prop("disabled",true);
            }
            document.getElementById('reset3').onclick = function () {
                let image_one = document.getElementById('formFile3');
                image_one.value = image_one.defaultValue;
                $('.new_image3_div').hide(100);
                //Add new entry increases/decreases form size
                let increase =  parseInt(document.getElementById('ratingForm').offsetHeight) - 200;
                let size = (increase.toString()).concat("px");
                document.getElementById("ratingForm").style.height = size;
                $("#reset3").prop("disabled",true);
            }


            //Enable remove image only if there is an image
            $("#formFile1").change(function (){
                if(document.getElementById("formFile1").files.length != 0){
                    $("#reset1").prop("disabled",false);
                }
            });
            $("#formFile2").change(function (){
                if(document.getElementById("formFile2").files.length != 0){
                    $("#reset2").prop("disabled",false);
                }
            });
            $("#formFile3").change(function (){
                if(document.getElementById("formFile3").files.length != 0){
                    $("#reset3").prop("disabled",false);
                }
            });


            $("#ratingForm").on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function () {
                        $(document).find('span.error-text').text('');
                    },
                    success: function (data) {
                        if (data.status == 0) {
                            $.each(data.error, function (prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            swal({title: "Success!", text: "Your review has been saved successfully.", type: "success"},
                                function () {
                                    location.reload();
                                }
                            );
                        }
                    }
                });
            });

            @if (count($errors) > 0)
            $('#review').modal('show');
            @endif

            if ('rate' != '' && 'review' != '') {
                $('#review').modal('hide');
            }

            //show and hide all packages
            $(".view").click(function () {
                $(".hidden").toggle(300);
                $(".view").toggle(300);
            });
            //show and hide inclusions
            $(".read_more").click(function () {
                $("p[id='" + this.id + "']").toggle(300);
                $(this).text(function (i, text) {
                    return text === "Read More →" ? "Read Less ←" : "Read More →";
                });
            });
        });
    </script>
    <script>
        function routerPush(title, url) {
            $("meta[name=url]").attr("content", url);
            return window.history.replaceState({}, title || document.title, url);
        }

        const url = "/chatify";

        $(document).ready(function () {
            $("#chatify_to").on("click", function () {
                const uid = $('#chatify_to').data('id');
                console.log(uid);
                routerPush(document.title, `${url}/${uid}`);
                location.reload();
            });
        });
    </script>


@endpush
