@extends('layouts.tourist-show')

@section('content-tourist-show')
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <div class="toast" style=" position: absolute; right: 0;">
            <div class="toast-header">
                <strong class="mr-auto">Error!</strong>
            </div>
            <div class="toast-body">
                {{ \Illuminate\Support\Facades\Session::get('error') }}
            </div>
        </div>
    @endif
    <head>
        <style>
            label{
                font-weight: bold;
            }
            .clear{
                color: #4286f4 !important;
                display: none;
            }
            .clear:hover{
                cursor: pointer;
                color: gray !important;
            }
            .images-preview-div img
            {
                padding: 5px;
                max-width: 300px;
                max-height: 400px;
            }
        </style>
    </head>
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
        <img src="{{ asset('img/discover/discover-bg.jpg') }}" class="img-banner-show">
        <img src="{{ asset('img/discover/discover-bg-mobile.jpg') }}" class="img-banner-show-mobile">
        <div class="header show-animation"  style="">
            <h2 class="text-white">#<span class="auto-type"></span></h2>
            <p class="text-white">Add a Destination</p>
        </div>
    </section>
    <section id="" class="d-section-p1 pt-5">
        <div class="content">
            <div class="content__inner">
                <div class="container overflow-hidden">
                    <br/>
                    <div class="multisteps-form">
{{--                        Progress Bar--}}
                        <div class="row">
                            <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
                                <div class="multisteps-form__progress">
                                    <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">Owner?</button>
                                    <button class="multisteps-form__progress-btn" type="button" title="Address">Details</button>
                                    <button class="multisteps-form__progress-btn" type="button" title="Order Info">Location</button>
                                    <button class="multisteps-form__progress-btn" type="button" title="Others">Contact</button>
                                    <button class="multisteps-form__progress-btn" type="button" title="Message">Others</button>
                                    <button class="multisteps-form__progress-btn" type="button" title="Order Info">Activities</button>
                                    <button class="multisteps-form__progress-btn" type="button" title="Others">Amenities</button>
                                    <button class="multisteps-form__progress-btn" type="button" title="Message">Packages</button>
                                    <button class="multisteps-form__progress-btn" id="summary" type="button" title="Summary">Summary</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-8 m-auto">
                                @if ($errors->any())
                                    <div class="alert alert-danger col-12">
                                        Please fill all the required fields.
                                    </div>
                                @endif
                                <form class="multisteps-form__form" action="{{ route('tourist.create') }}" id="add_form" method="POST" enctype="multipart/form-data">
                                    @csrf
{{--                                    Owner--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="slideHorz">
                                        <h3 class="multisteps-form__title">Are you the owner of this destination?</h3>
                                        <div class="multisteps-form__content" style="font-size: medium">
                                            <input type="hidden" value="0" name="dest_operating" id="dest_operating"/>
                                            <!-- Default checked radio -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="no" name="owner" id="flexRadioDefault1" @if(old('owner') == 'no') checked @endif/>
                                                <label class="form-check-label" for="flexRadioDefault1"> No </label>
                                            </div>
                                            <!-- Default radio -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="yes" name="owner" id="flexRadioDefault2"  @if(old('owner') == 'yes') checked @endif/>
                                                <label class="form-check-label" for="flexRadioDefault2"> Yes </label>
                                            </div>

                                            <div class="multisteps-form__content" id="image_increase">
                                            <div style="display: none" id="validate" class="form-row mt-1">
                                                <div>
                                                    <label>Proof of Ownership (Business Permit):<text style="color: red">*</text></label>
                                                </div>
                                                <div class="new_image_proof_div col-12" id="new_image_proof_div" style=" display: none;">
                                                    <img src="" id="new_image_proof" class="new_image_proof col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;">
                                                </div>
                                                <div class="col-auto mt-2" style="width: 85%">
                                                    <input name="business_permit" value="{{ old('business_permit') }}" class="multisteps-form__input form-control" id="proofFile"  type="file" accept="file/*">
                                                    <span class="text-danger">@error('business_permit')The business permit field is required when you're an owner. @enderror</span>
                                                </div>
                                                <div class="col-auto mt-2" style="width: 15%">
                                                    <button class="btn btn-secondary"  style="width: 100%;" id="reset" type="button" disabled>
                                                        <i class="fas fa-times fa-lg mx-auto"></i>
                                                    </button>
                                                    <span class="text-danger error-text image_one_error"></span>
                                                </div>
                                            </div>
                                                <div class="row">
                                                    <div class="button-row d-flex mt-4 col-12">
                                                        <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next" style="margin-bottom: 3%;">Next</button>
                                                    </div>
                                                </div>
                                                </div>
                                        </div>
                                    </div>
{{--                                    Destination Details--}}
                                 <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz" style="margin-bottom: 450px">
                                        <h3 class="multisteps-form__title">Destination Details</h3>
                                        <div class="multisteps-form__content" id="image_increase">
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Preview Image: <text style="color: red">*</text></label>
                                                </div>
                                                <div class="new_image_div col-12" id="new_image_div" style=" display: none;">
                                                    <img src="" id="new_image" class="new_image col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;">
                                                </div>
                                                <div class="col-auto mt-2" style="width: 85%">
                                                    <input name="image" value="{{ old('image') }}" class="multisteps-form__input form-control" id="formFile1" type="file" accept="image/*"  onchange="previewFile(this);">
                                                    <span class="text-danger">@error('image'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-auto mt-2" style="width: 15%">
                                                    <button class="btn btn-secondary"  style="width: 100%;" id="reset1" type="button" disabled>
                                                        <i class="fas fa-times fa-lg mx-auto"></i>
                                                    </button>
                                                    <span class="text-danger error-text image_one_error"></span>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Destination Name <text style="color: red">*</text></label>
                                                </div>
                                                <div class="col">
                                                    <input class="multisteps-form__input form-control destination_name" id="destination_name" name="destination_name" type="text" value="{{ old('destination_name') }}" placeholder="Destination Name"/>
                                                    <span class="text-danger">@error('destination_name'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Description <text style="color: red">*</text></label>
                                                </div>
                                                <div class="col">
                                                    <textarea class="multisteps-form__textarea form-control destination_description" id="destination_description" name="destination_description" placeholder="Destination Description">{{ old('destination_description') }}</textarea>
                                                    <span class="text-danger">@error('destination_description'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Date Established</label>
                                                </div>
                                                <div class="col">
                                                    <input class="multisteps-form__input form-control" name="dest_date_opened" value="{{ old('dest_date_opened') }}" type="date"/>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Working Hours <text style="color: red">*</text></label>
                                                </div>
                                                <div class="col">
                                                    <textarea class="multisteps-form__textarea form-control destination_working_hours" id="destination_working_hours" name="destination_working_hours" placeholder="Mon-Sun 6:00am-8:00pm">{{ old('destination_working_hours') }}</textarea>
                                                    <span class="text-danger">@error('destination_working_hours'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Category</label>
                                                </div>
                                                <div class="col">
                                                    <select class="form-select" name="dest_category" aria-label="Default select example">
                                                        <option selected>Category</option>
                                                        <option value="Art Gallery">Art Gallery</option>
                                                        <option value="Beach">Beach</option>
                                                        <option value="Cave">Cave</option>
                                                        <option value="Cliff">Cliff</option>
                                                        <option value="Culture">Culture</option>
                                                        <option value="Entertainment">Entertainment</option>
                                                        <option value="Farm">Farm</option>
                                                        <option value="Forest">Forest</option>
                                                        <option value="Hill">Hill</option>
                                                        <option value="Historical">Historical</option>
                                                        <option value="Island">Island</option>
                                                        <option value="Lake">Lake</option>
                                                        <option value="Monument">Monument</option>
                                                        <option value="Mountain">Mountain</option>
                                                        <option value="Museum">Museum</option>
                                                        <option value="Private Park">Private Park</option>
                                                        <option value="Public Park">Public Park</option>
                                                        <option value="Secluded">Secluded</option>
                                                        <option value="Sport">Sport</option>
                                                        <option value="Swimming Pool">Swimming Pool</option>
                                                        <option value="Waterfall">Waterfall</option>
                                                        <option value="Wildlife">Wildlife</option>
                                                        <option value="Zoo">Zoo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
{{--                                    Location--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                        <h3 class="multisteps-form__title">Where is this Located?</h3>
                                        <div class="multisteps-form__content">
                                            <div class="row">
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Destination Address <text style="color: red">*</text></label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control destination_address" id="destination_address" name="destination_address" value="{{ old('destination_address') }}" type="text" placeholder="Address"/>
                                                        <span class="text-danger">@error('destination_address'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>City or Municipality <text style="color: red">*</text></label>
                                                    </div>
                                                    <select class="multisteps-form__select form-select destination_city" id="destination_city" name="destination_city">
                                                        <option>Select</option>
                                                        <option @if(old('destination_city')=='Bacacay') selected @endif>Bacacay</option>
                                                        <option @if(old('destination_city')=='Camalig') selected @endif>Camalig</option>
                                                        <option @if(old('destination_city')=='Daraga') selected @endif>Daraga</option>
                                                        <option @if(old('destination_city')=='Guinobatan') selected @endif>Guinobatan</option>
                                                        <option @if(old('destination_city')=='Jovellar') selected @endif>Jovellar</option>
                                                        <option @if(old('destination_city')=='Legazpi') selected @endif>Legazpi</option>
                                                        <option @if(old('destination_city')=='Libon') selected @endif>Libon</option>
                                                        <option @if(old('destination_city')=='Ligao') selected @endif>Ligao</option>
                                                        <option @if(old('destination_city')=='Malilipot') selected @endif>Malilipot</option>
                                                        <option @if(old('destination_city')=='Malinao') selected @endif>Malinao</option>
                                                        <option @if(old('destination_city')=='Manito') selected @endif>Manito</option>
                                                        <option @if(old('destination_city')=='Oas') selected @endif>Oas</option>
                                                        <option @if(old('destination_city')=='Pio Duran') selected @endif>Pio Duran</option>
                                                        <option @if(old('destination_city')=='Polangui') selected @endif>Polangui</option>
                                                        <option @if(old('destination_city')=='RapuRapu') selected @endif>RapuRapu</option>
                                                        <option @if(old('destination_city')=='Santo Domingo') selected @endif>Santo Domingo</option>
                                                        <option @if(old('destination_city')=='Tabaco') selected @endif>Tabaco</option>
                                                        <option @if(old('destination_city')=='Tiwi') selected @endif>Tiwi</option>
                                                    </select>
                                                    <span class="text-danger">@error('destination_city'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="form-row mt-4" id="container">
                                                    <div class="col-12">
                                                        <label>Pin the Location</label>
                                                    </div>
                                                    <div class="col" id="map"></div>
                                                    <p id="info" style="color: gray"></p>
                                                    <a class="clear">Clear pinned location</a>
                                                    <input class="longlat" type="text" id="latitude" name="latitude" value="13.143986664725428" hidden/>
                                                    <input class="longlat" type="text" id="longitude" name="longitude" value="123.72595988123209" hidden/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">
                                                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                    <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
{{--                                    Contact Info--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                        <h3 class="multisteps-form__title">Contact Information</h3>
                                        <div class="multisteps-form__content">
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col">
                                                    <input class="multisteps-form__input form-control destination_email" id="destination_email" name="dest_email" type="text" placeholder="Email" value="{{ old('dest_email') }}"/>
                                                </div>
                                                <div class="col-12">
                                                    <label>Phone</label>
                                                </div>
                                                <div class="col">
                                                    <input class="multisteps-form__input form-control destination_phone" id="destination_phone" name="dest_phone" type="text" placeholder="Phone" value="{{ old('dest_phone') }}"/>
                                                </div>
                                                <div class="col-12">
                                                    <label>Facebook</label>
                                                </div>
                                                <div class="col">
                                                    <input class="multisteps-form__input form-control" name="dest_fb" type="text" placeholder="Link" value="{{ old('dest_fb') }}"/>
                                                </div>
                                                <div class="col-12">
                                                    <label>Twitter</label>
                                                </div>
                                                <div class="col">
                                                    <input class="multisteps-form__input form-control" name="dest_twt" type="text" placeholder="Link" value="{{ old('dest_twt') }}"/>
                                                </div>
                                                <div class="col-12">
                                                    <label>Instagram</label>
                                                </div>
                                                <div class="col">
                                                    <input class="multisteps-form__input form-control" name="dest_ig" type="text" placeholder="Link" value="{{ old('dest_ig') }}"/>
                                                </div>
                                                <div class="col-12">
                                                    <label>Website</label>
                                                </div>
                                                <div class="col">
                                                    <input class="multisteps-form__input form-control" name="dest_web" type="text" placeholder="Link" value="{{ old('dest_web') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="button-row d-flex mt-4 col-12">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
{{--                                    Other Details--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                        <h3 class="multisteps-form__title">Other Details</h3>
                                        <div class="multisteps-form__content">
                                            <div class="form-row mt-4" id="images-preview-height">
                                                <div class="col-12">
                                                    <div class="images-preview-div" id="images-preview-div"> </div>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Upload Images <text style="color: red">*</text></label>
                                                    <text>(Do not include preview image)</text>
                                                </div>
                                                <div class="col-auto mt-2" style="width: 85%">
                                                    <input class="multisteps-form__textarea form-control" type="file" id="images" name="images[]" multiple>
                                                    <span class="text-danger">@error('images'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-auto mt-2" style="width: 15%">
                                                    <button class="btn btn-secondary"  style="width: 100%;" id="reset2" type="button" disabled>
                                                        <i class="fas fa-times fa-lg mx-auto"></i>
                                                    </button>
                                                    <span class="text-danger error-text image_one_error"></span>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Entrance Fee <text style="color: red">*</text></label>
                                                </div>
                                                <div class="col">
                                                    <textarea class="multisteps-form__textarea form-control" name="destination_entrance_fee" placeholder="Adult - Php100">{{ old('destination_entrance_fee') }}</textarea>
                                                    <span class="text-danger">@error('destination_entrance_fee'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Direction</label>
                                                </div>
                                                <div class="col">
                                                    <textarea class="multisteps-form__textarea form-control" name="dest_direction" placeholder="How to go here?">{{ old('dest_direction') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Fare Estimation</label>
                                                </div>
                                                <div class="col">
                                                    <textarea class="multisteps-form__textarea form-control" name="dest_fare" placeholder="Estimated Fare">{{ old('dest_fare') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
{{--                                    Activities--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                        <h3 class="multisteps-form__title">Activities</h3>
                                        <div id="show_activity">
                                            @if(old('activity'))
                                                @for( $i =0; $i < count(old('activity')); $i++)
                                            <div class="row">
                                                <div class="multisteps-form__content" id="increase_activity">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Activity</label>
                                                        </div>
                                                        <div class="col">
                                                                <input class="multisteps-form__input form-control activity_name" id="activity_name" name="activity[]" type="text" placeholder="Activity Name" value="{{ old('activity.'.$i) }}"/>
                                                            <span class="text-danger">@error('activity[]'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="activity_description[]" placeholder="Activity Description">{{ old('activity_description.'.$i) }}</textarea>
                                                            <span class="text-danger">@error('activity_description[]'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Fee</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="activity_fee[]" type="text" placeholder="Activity Fee">{{ old('activity_fee.'.$i) }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Pax</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="activity_number_of_pax[]" type="text" placeholder="Number of Pax">{{ old('activity_number_of_pax.'.$i) }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        @if($i != count(old('activity'))-1) <button class="btn btn-danger remove_activity_btn" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button> @else
                                                            <button class="btn btn-warning add_activity_btn" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button> @endif
                                                    </div>
                                                </div>
                                            </div>
                                                @endfor
                                            @else
                                            <div class="row">
                                                <div class="multisteps-form__content" id="increase_activity">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Activity</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control activity_name" id="activity_name" name="activity[]" type="text" placeholder="Activity Name"/>
                                                            <span class="text-danger">@error('activity[]'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="activity_description[]" placeholder="Activity Description"></textarea>
                                                            <span class="text-danger">@error('activity_description[]'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Fee</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="activity_fee[]" type="text" placeholder="Activity Fee"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Pax</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="activity_number_of_pax[]" type="text" placeholder="Number of Pax"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <button class="btn btn-warning add_activity_btn" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                        </div>
                                    </div>
{{--                                    Amenities--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                        <h3 class="multisteps-form__title">Amenities</h3>
                                        <div id="show_amenity">
                                            @if(old('amenity'))
                                                @for( $i =0; $i < count(old('amenity')); $i++)
                                            <div class="row">
                                                <div class="multisteps-form__content" id="increase_amenity">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Amenity</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control amenity_name" id="amenity_name" name="amenity[]" type="text" placeholder="Amenity Name" value="{{ old('amenity.'.$i) }}"/>
                                                            <span class="text-danger">@error('amenity[]'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="amenity_description[]" placeholder="Amenity Description">{{ old('amenity_description.'.$i) }}</textarea>
                                                            <span class="text-danger">@error('amenity_description[]'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Fee</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="amenity_fee[]" type="text" placeholder="Amenity Fee">{{ old('amenity_fee.'.$i) }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        @if($i != count(old('amenity'))-1) <button class="btn btn-danger remove_amenity_btn" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button> @else
                                                            <button class="btn btn-warning add_amenity_btn" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button> @endif
                                                    </div>
                                                </div>
                                            </div>
                                                @endfor
                                            @else
                                            <div class="row">
                                                <div class="multisteps-form__content" id="increase_amenity">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Amenity</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control amenity_name" id="amenity_name" name="amenity[]" type="text" placeholder="Amenity Name"/>
                                                            <span class="text-danger">@error('amenity[]'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="amenity_description[]" placeholder="Amenity Description"></textarea>
                                                            <span class="text-danger">@error('amenity_description[]'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Fee</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="amenity_fee[]" type="text" placeholder="Amenity Fee"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <button class="btn btn-warning add_amenity_btn" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                        </div>
                                    </div>
{{--                                    Packages--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                        <h3 class="multisteps-form__title">Packages</h3>
                                        <div id="show_package">
                                            @if(old('dest_pkg_name'))
                                                @for( $i =0; $i < count(old('dest_pkg_name')); $i++)
                                            <div class="row">
                                                <div class="multisteps-form__content" id="increase_package">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Package</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control package_name" id="package_name" name="dest_pkg_name[]" type="text" placeholder="Package Name" value="{{ old('dest_pkg_name.'.$i) }}"/>
                                                            <span class="text-danger">@error('dest_pkg_name[]'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_description[]" placeholder="Package Description">{{ old('dest_pkg_description.'.$i) }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Minimum Fee</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_min_fee[]" type="text" placeholder="Php 599">{{ old('dest_pkg_min_fee.'.$i) }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Rates</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_rate[]" type="text" placeholder="3 Pax (Php 599 Per Pax)">{{ old('dest_pkg_rate.'.$i) }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Inclusions</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_inclusions[]" placeholder="Package Inclusions">{{ old('dest_pkg_inclusions.'.$i) }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        @if($i != count(old('dest_pkg_name'))-1) <button class="btn btn-danger remove_package_btn" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button> @else
                                                            <button class="btn btn-warning add_package_btn" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button> @endif
                                                    </div>
                                                </div>
                                            </div>
                                                @endfor
                                            @else
                                            <div class="row">
                                                <div class="multisteps-form__content" id="increase_package">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Package</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control package_name" id="package_name" name="dest_pkg_name[]" type="text" placeholder="Package Name"/>
                                                            <span class="text-danger">@error('dest_pkg_name[]'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_description[]" placeholder="Package Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Minimum Fee</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_min_fee[]" type="text" placeholder="Php 599"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Rates</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_rate[]" type="text" placeholder="3 Pax (Php 599 Per Pax)"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Inclusions</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_inclusions[]" placeholder="Package Inclusions"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <button class="btn btn-warning add_package_btn" id="testing" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="button-row d-flex mt-4" style="justify-content: space-between;">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                <button class="btn btn-primary ml-auto js-btn-next" id="summary" type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
{{--                                    Summary--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                        <h3 class="multisteps-form__title">Summary</h3>
                                        <br/>
                                        <div class="multisteps-form__content " style="font-size: large; text-align: center">
                                            <div class="user-info">
                                                <div class="col-12" style="align-items: center">
                                                    <div class="new_image_div col-12" id="new_image_div" style=" display: none;">
                                                        <img src="" id="new_image" class="new_image col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;">
                                                    </div>
                                                    <h3><strong id="dest_name"><span style="color: lightgrey">Destination Name</span></strong></h3>
                                                    <span id="dest_description"><span style="color: lightgrey">Description</span></span>
                                                    <br/>
                                                    <span><span style="color: lightgrey"><strong id="dest_city">City</strong></span></span>
                                                    <br/>
                                                    <span id="dest_address"><span style="color: lightgrey">Address</span></span>
                                                    <br>
                                                    <span id="dest_working_hours"><span style="color: lightgrey">Working Hours</span></span>
                                                    <br>
                                                    <span id="dest_email" style="color: dodgerblue"><span style="color: lightgrey">Email</span></span>
                                                    <br>
                                                    <span id="dest_phone" style="color: dodgerblue"><span style="color: lightgrey">Phone Number</span></span>
                                                    <br/>
                                                    <span class="col-auto"><strong>Activities:</strong> <span id="activity"></span></span>
                                                    <span class="col-auto ml-auto mr-auto"><strong>Amenities:</strong> <span id="amenity"></span></span>
                                                    <span class="col-auto"><strong>Packages:</strong> <span id="package"></span></span>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn btn-primary js-btn-prev mr-auto" type="button" title="Prev">Prev</button>
                                            <button class="btn btn-success mr-2" type="button"
                                                    name="approve" title="Send"
                                                    data-bs-toggle="modal" data-bs-target="#approve">
                                                <i class="fas fa-check fa-md"></i> Submit</button>
                                        </div>
                                    </div>

                                    <!-- Approve Modal -->
                                    <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="approvetLabel" data-backdrop="static"
                                         data-keyboard="false">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="contactLabel"><strong>Submit Destination</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <h5>Do you wish to submit this request?</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary ml-0 cancel" type="button" aria-hidden="true" data-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-success mr-0" type="submit" name="submit" title="Send" value="approve"><i class="fas fa-check fa-md"></i> Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts-tourist-show')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(function() {
// Multiple images preview with JavaScript
            let previewImages = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    let filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images').on('change', function() {
                document.getElementById("images-preview-div").innerHTML = "";

                let $fileUpload = $("#images");

                if(document.getElementById("images").files.length === 0){
                    $("#reset2").prop("disabled",true);
                    document.getElementById("images-preview-div").innerHTML = "";
                    document.getElementById("add_form").style.height = "650px";
                }else if (parseInt($fileUpload.get(0).files.length) > 5){
                    alert("Only 5 images are allowed.");
                    let images = document.getElementById('images');
                    images.value = images.defaultValue;
                }else{
                    previewImages(this, 'div.images-preview-div');
                    document.getElementById("add_form").style.height = "1450px";
                    $("#reset2").prop("disabled",false);
                }
            });

            $('#reset2').on('click', function (){
                document.getElementById("images-preview-div").innerHTML = "";
                let images = document.getElementById('images');
                images.value = images.defaultValue;
                document.getElementById("add_form").style.height = "650px";
                $("#reset2").prop("disabled",true);
            });
        });
    </script>
    <script>
        function previewFile(input){
            //Add new entry increases/decreases form size
            if (document.getElementById("formFile1").files.length !== 0) {
            let increase =  parseInt(document.getElementById('add_form').offsetHeight) + 450;
            let size1 = (increase.toString()).concat("px");
            document.getElementById("add_form").style.height = size1;

            let file = $("#formFile1").get(0).files[0];
            if(file){
                let reader = new FileReader();
                reader.onload = function(){
                    $(".new_image").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
            $('.new_image_div').show();
            } else{
                document.getElementById("add_form").style.height = '650px';
                $('.new_image_div').hide();
                $("#reset1").prop("disabled",true);
            }
        }
        function previewProof(input){
            //Add new entry increases/decreases form size
            let increase =  parseInt(document.getElementById('add_form').offsetHeight) + 450;
            let size1 = (increase.toString()).concat("px");
            document.getElementById("add_form").style.height = size1;

            let file = $("#proofFile").get(0).files[0];
            if(file){
                let reader = new FileReader();
                reader.onload = function(){
                    $(".new_image_proof").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
            $('.new_image_proof_div').show();
        }
        $(document).ready(function() {
            // to show the add business permit option to owners
            document.getElementById('flexRadioDefault1').onchange= function() {
                $('#validate').hide();
            };
            document.getElementById('flexRadioDefault2').onchange= function() {
                $('#validate').show();
            };

            if(document.getElementById('flexRadioDefault2').checked == true) {
                $('#validate').show();
                if(!$("#business_permit").is(':not(:empty)')){
                    $('#permit_error').show();
                }
            }
            //Enable remove image only if there is an image
            $("#formFile1").change(function (){
                if(document.getElementById("formFile1").files.length != 0){
                    $("#reset1").prop("disabled",false);
                }
            });
            $("#proofFile").change(function (){
                if(document.getElementById("proofFile").files.length != 0){
                    $("#reset").prop("disabled",false);
                }
            });
            //Animation
            const typed = new Typed(".auto-type", {
                strings: ["Improve", "Uncover", "Explore"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });
            $(".cancel").click(function () {
                $('#reject').modal('hide');
                $('#approve').modal('hide');
            });
            //clear coordinates
            $(".clear").click(function(){
                document.getElementById("latitude").value = "13.143986664725428";
                document.getElementById("longitude").value = "123.72595988123209";

                $("#info").hide(300);
                document.getElementById("info").innerHTML = "";
                $(".clear").hide(300);
            });
            //Image
            document.getElementById('reset').onclick= function() {
                let image_one = document.getElementById('proofFile');
                image_one.value = image_one.defaultValue;
                $('.new_image_proof_div').hide(100);
                //Add new entry increases/decreases form size
                let increase =  parseInt(document.getElementById('add_form').offsetHeight) - 450;
                let size = (increase.toString()).concat("px");
                document.getElementById("add_form").style.height = size;
                $("#reset").prop("disabled",true);
            }
            document.getElementById('reset1').onclick= function() {
                let image_one = document.getElementById('formFile1');
                image_one.value = image_one.defaultValue;
                $('.new_image_div').hide(100);
                //Add new entry increases/decreases form size
                let increase =  parseInt(document.getElementById('add_form').offsetHeight) - 450;
                let size = (increase.toString()).concat("px");
                document.getElementById("add_form").style.height = size;
                $("#reset1").prop("disabled",true);
            }

            if( ("{{ old('latitude') }}" != 13.143986664725428 && "{{ old('longitude') }}" != 123.72595988123209) && ("{{ old('latitude') }}" != "" && "{{ old('longitude') }}" != "") ) {
                document.getElementById("latitude").value = "{{ old('latitude') }}";
                document.getElementById("longitude").value = "{{ old('longitude') }}";
            }
            //Add new entry increases/decreases form size
            function height_increase(id){
                let increase =  parseInt(document.getElementById('add_form').offsetHeight) + parseInt(document.getElementById(id).offsetHeight);
                let size = (increase.toString()).concat("px");
                document.getElementById("add_form").style.height = size;
            }
            function height_decrease(id){
                let decrease =  parseInt(document.getElementById('add_form').offsetHeight) - parseInt(document.getElementById(id).offsetHeight);
                let size = (decrease.toString()).concat("px");
                document.getElementById("add_form").style.height = size;
            }

            //Add New Activity Fields
            $(".add_activity_btn").click(function(e){
                e.preventDefault();
                $("#show_activity").prepend(`<div class="row append_item">
                                            <div class="multisteps-form__content">
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Activity</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control activity_name" id="activity_name" name="activity[]" type="text" placeholder="Activity Name"/>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col-12">
                                                        <label>Description</label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="multisteps-form__input form-control" name="activity_description[]" placeholder="Activity Description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col-12">
                                                        <label>Fee</label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="multisteps-form__input form-control" name="activity_fee[]" type="text" placeholder="Activity Fee"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col-12">
                                                        <label>Pax</label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="multisteps-form__input form-control" name="activity_number_of_pax[]" type="text" placeholder="Number of Pax"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <button class="btn btn-danger remove_activity_btn" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                </div>
                                            </div>
                                        </div>`);
                height_increase('increase_activity');
            });
            //Remove Inserted Fields
            $(document).on('click','.remove_activity_btn', function(e){
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
                height_decrease('increase_activity');
            });

            //Add New Amenity Fields
            $(".add_amenity_btn").click(function(e){
                e.preventDefault();
                $("#show_amenity").prepend(`<div class="row append_item">
                                                <div class="multisteps-form__content">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Amenity</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control amenity_name" id="amenity_name" name="amenity[]" type="text" placeholder="Amenity Name"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="amenity_description[]" placeholder="Amenity Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Fee</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="amenity_fee[]" type="text" placeholder="Amenity Fee"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <button class="btn btn-danger remove_amenity_btn" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                    </div>
                                                </div>
                                            </div>`);
                height_increase('increase_amenity');
            });
            //Remove Inserted Fields
            $(document).on('click','.remove_amenity_btn', function(e){
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
                height_decrease('increase_amenity');
            });

            //Add New Package Fields
            $(".add_package_btn").click(function(e){
                e.preventDefault();
                $("#show_package").prepend(`<div class="row append_item">
                                                <div class="multisteps-form__content">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Package Name</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control package_name" id="package_name" name="dest_pkg_name[]" type="text" placeholder="Package Name"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_description[]" placeholder="Package Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Minimum Fee</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_min_fee[]" type="text" placeholder="Package Minimum Fee"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Rates</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_rate[]" type="text" placeholder="Package Rates"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Inclusions</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="dest_pkg_inclusions[]" placeholder="Package Inclusions"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <button class="btn btn-danger remove_package_btn" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                    </div>
                                                </div>
                                            </div>`);
                height_increase('increase_package');
            });
            //Remove Inserted Fields
            $(document).on('click','.remove_package_btn', function(e){
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
                height_decrease('increase_package');
            });
            //============================================ NEW DESTINATION REQUEST SUMMARY

            $(window).on("load", function () {
                if((document.getElementById('destination_name').value) != '')
                    document.getElementById('dest_name').innerHTML = document.getElementById('destination_name').value;
                if((document.getElementById('destination_description').value) != '')
                    document.getElementById('dest_description').innerHTML = document.getElementById('destination_description').value;
                if((document.getElementById('destination_address').value) != '')
                    document.getElementById('dest_address').innerHTML = document.getElementById('destination_address').value;
                if((document.getElementById('destination_working_hours').value) != '')
                    document.getElementById('dest_working_hours').innerHTML = document.getElementById('destination_working_hours').value;
                if((document.getElementById('destination_email').value) != '')
                    document.getElementById('dest_email').innerHTML = document.getElementById('destination_email').value;
                if((document.getElementById('destination_phone').value) != '')
                    document.getElementById('dest_phone').innerHTML = document.getElementById('destination_phone').value;
                if((document.getElementById('destination_city').value) != 'Select')
                    document.getElementById('dest_city').innerHTML = document.getElementById('destination_city').value;
            });
            $('#destination_name').keyup(function() {
                if((document.getElementById('destination_name').value) == ''){
                    document.getElementById('dest_name').innerHTML = "Destination Name";
                    document.getElementById('dest_name').style.color = 'lightgrey';
                }else{
                    document.getElementById('dest_name').innerHTML = document.getElementById('destination_name').value;
                    document.getElementById('dest_name').style.color = 'black';
                }
            });
            $('#destination_description').keyup(function() {
                if((document.getElementById('destination_description').value) == ''){
                    document.getElementById('dest_description').innerHTML = "Description";
                    document.getElementById('dest_description').style.color = 'lightgrey';
                }else{
                    document.getElementById('dest_description').innerHTML = document.getElementById('destination_description').value;
                    document.getElementById('dest_description').style.color = 'black';
                }
            });
            $('#destination_address').keyup(function() {
                if((document.getElementById('destination_address').value) == ''){
                    document.getElementById('dest_address').innerHTML = "Address";
                    document.getElementById('dest_address').style.color = 'lightgrey';
                }else{
                    document.getElementById('dest_address').innerHTML = document.getElementById('destination_address').value;
                    document.getElementById('dest_address').style.color = 'black';
                }
            });
            $('#destination_working_hours').keyup(function() {
                if((document.getElementById('destination_working_hours').value) == ''){
                    document.getElementById('dest_working_hours').innerHTML = "Working Hours";
                    document.getElementById('dest_working_hours').style.color = 'lightgrey';
                }else{
                    document.getElementById('dest_working_hours').innerHTML = document.getElementById('destination_working_hours').value;
                    document.getElementById('dest_working_hours').style.color = 'black';
                }
            });
            $('#destination_email').keyup(function() {
                if((document.getElementById('destination_email').value) == ''){
                    document.getElementById('dest_email').innerHTML = "Email";
                    document.getElementById('dest_email').style.color = 'lightgrey';
                }else{
                    document.getElementById('dest_email').innerHTML = document.getElementById('destination_email').value;
                    document.getElementById('dest_email').style.color = 'dodgerblue';
                }
            });
            $('#destination_phone').keyup(function() {
                if((document.getElementById('destination_phone').value) == ''){
                    document.getElementById('dest_phone').innerHTML = "Phone";
                    document.getElementById('dest_phone').style.color = 'lightgrey';
                }else{
                    document.getElementById('dest_phone').innerHTML = document.getElementById('destination_phone').value;
                    document.getElementById('dest_phone').style.color = 'dodgerblue';
                }
            });
            $('#destination_city').change(function() {
                if((document.getElementById('destination_city').value) == 'Select'){
                    document.getElementById('dest_city').innerHTML = "City";
                    document.getElementById('dest_city').style.color = 'lightgrey';
                }else{
                    document.getElementById('dest_city').innerHTML = document.getElementById('destination_city').value;
                    document.getElementById('dest_city').style.color = 'black';
                }
            });

            let activity_count;
            let amenity_count;
            let package_count;
            $('button#summary').click(function() {
                //Counting Activity Input
                activity_count=0;
                let a = $('input[class*="activity_name"]').length;
                for (i=0; i<a; i++){
                    if(document.getElementsByClassName("activity_name")[i].value.length != 0){
                        activity_count++;
                    }
                }
                //Counting Amenity Input
                amenity_count=0;
                let b = $('input[class*="amenity_name"]').length;
                for (i=0; i<b; i++){
                    if(document.getElementsByClassName("amenity_name")[i].value.length != 0){
                        amenity_count++;
                    }
                }
                //Counting Package Input
                package_count=0;
                let c = $('input[class*="package_name"]').length;
                for (i=0; i<c; i++){
                    if(document.getElementsByClassName("package_name")[i].value.length != 0){
                        package_count++;
                    }
                }
                document.getElementById('activity').innerHTML = activity_count;
                document.getElementById('amenity').innerHTML = amenity_count;
                document.getElementById('package').innerHTML = package_count;
            });
        });

        //-----------------------Google Maps JS
        //Add Destination
        function initMap() {
            //Map Settings
            let mapOptions = {
                center: { lat: 13.143986664725428, lng: 123.72595988123209 },
                zoom: 11,
                mapId: "e3a69f21a8a07bc3",
            };
            //Displaying map to div
            let map = new google.maps.Map(document.getElementById("map"), mapOptions);

            //Creating Map Marker
            //Marker Settings
            let markerOptions = {
                position: { lat: 13.143986664725428 , lng: 123.72595988123209 },
                map: map,
                optimized: false, //Enables event
                icon: {
                    url:'{{ asset('img/location.png') }}',
                    scaledSize: new google.maps.Size(38, 50),
                    anchor: new google.maps.Point(19.45, 51.5), //pinpoint location
                },
                title: "Pin this location",
                animation: google.maps.Animation.BOUNCE,
                draggable: true,
            };
            //Display Marker
            let marker = new google.maps.Marker(markerOptions);
            // marker.setLabel("yey"); //outside markerOptions

            //event listener - Actions when clicked = display latitude and longitude
            marker.addListener("mouseup", (googleMapsEvent) => {
                document.getElementById("info").innerHTML =
                    // "latitude: " +
                    googleMapsEvent.latLng.lat() +
                    ","+
                    // "longitude: " +
                    googleMapsEvent.latLng.lng();
                document.getElementById("latitude").value = googleMapsEvent.latLng.lat();
                document.getElementById("longitude").value = googleMapsEvent.latLng.lng();
                $("#info").show();
                $(".clear").show();
            });

                // document.getElementById("info").innerHTML = marker.getAnimation(); //display animation #
            //Marker Animation Stop
            setTimeout(() => {
                marker.setAnimation(null);
                //Hide animation #
                document.getElementById("info").innerHTML = marker.getAnimation();
            },3000);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbV7DVh7RNb9up1QQt0zFabQZdcDmzgM8&map_ids=e3a69f21a8a07bc3 &callback=initMap"></script>

@endpush

