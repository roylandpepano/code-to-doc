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
        <img src="{{ asset('img/discover/discover-bg.jpg') }}" class="img-banner-show">
        <img src="{{ asset('img/discover/discover-bg-mobile.jpg') }}" class="img-banner-show-mobile">
        <div class="header show-animation"  style="">
            <h2 class="text-white">#<span class="auto-type"></span></h2>
            <p class="text-white">Edit Your Destination</p>
        </div>
    </section>
    <div class="go-back-button">
        <button type="button" style="max-height: 40px" class="btn btn-primary go-back-btn mt-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Go Back on Previous Page"
                onclick="history.back()">
            <i class="fa-solid fa-circle-arrow-left mr-2"></i>Go Back</button>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="content">
                <div class="content__inner">
                    <div class="container overflow-hidden">
                        <br/>
                        <div class="multisteps-form">
                            <div class="row">
                                <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
                                    <div class="multisteps-form__progress">
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="Details">Details</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Location">Location</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Contact">Contact</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Others">Others</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Activity">Activity</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Amenity">Amenity</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Packages">Packages</button>
                                        <button class="multisteps-form__progress-btn" id="summary" type="button" title="Summary">Summary</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-8 m-auto">
                                    @if ($errors->any())
                                        <div class="alert alert-danger col-12">
                                            Please fill all the required fields.
                                            <span class="text-danger">@error('reason'){{ $message }}@enderror</span>
                                        </div>
                                    @endif
                                    <form class="multisteps-form__form" id="add_form" action="{{ route('owner.update', $request->dest_id) }}" method="POST" enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf

                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Destination Details</h3>
                                            <div class="multisteps-form__content">
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Company Logo/Image: </label>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="picture form-row" id="picture">
                                                            <input id="hidden_input" name="hidden_input" type="text" value="true" hidden/>
                                                            <div class="col-12">
                                                                <img src="{{ asset($request->dest_main_picture) }}" class="col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto" alt="submitted-logo">
                                                                <input type="hidden" value="{{ asset($request->dest_main_picture) }}" name="past-pic" onchange="previewFile(this);">
                                                            </div>
                                                            <div class="col-12 pt-2">
                                                                <button class="btn btn-danger" id="remove1" type="button" style="width: 100%">
                                                                    <i class="fas fa-times fa-lg mr-2"></i> Remove Image
                                                                </button>
                                                                <span class="text-danger error-text image_one_error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="upload form-row" id="upload" style="display: none">
                                                            <div class="new_image_div col-12" id="new_image_div" style=" display: none;">
                                                                <img src="" id="new_image" class="new_image col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;" alt="new-image">
                                                            </div>
                                                            <div class="col-12 pt-2">
                                                                <button class="btn btn-warning" id="restore1" type="button" style="width: 100%">
                                                                    <i class="fas fa-trash-restore fa-lg mr-2"></i> Restore Image
                                                                </button>
                                                                <span class="text-danger error-text image_one_error"></span>
                                                            </div>
                                                            <div class="col-auto pt-2" style="width: 80%">
                                                                <input name="image" class="multisteps-form__input form-control" id="formFile1" type="file" accept="image/*" onchange="previewFile(this);">
                                                                <span class="text-danger">@error('image'){{ $message }}@enderror</span>
                                                            </div>
                                                            <div class="col-auto pt-2" style="width: 20%">
                                                                <button class="btn btn-outline-danger" style="width: 100%;" id="reset1" type="button">
                                                                    <i class="fas fa-times fa-lg mx-auto"></i>
                                                                </button>
                                                                <span class="text-danger error-text image_one_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Is this still operating?</label>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="yes" name="dest_operating" id="flexRadioDefault2"  @if($request->dest_operating == '0') checked @endif/>
                                                            <label class="form-check-label" for="flexRadioDefault2"> Yes </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="no" name="dest_operating" id="flexRadioDefault1" @if($request->dest_operating == '1') checked @endif/>
                                                            <label class="form-check-label" for="flexRadioDefault1"> No </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4" >
                                                    <div class="col-12">
                                                        <label>Proof of Ownership (Business Permit):</label>
                                                        <div style="float:left; width: 80%; margin-left: 2%; color: grey"> Uploaded File: <a href="{{asset($request->dest_business_permit)}}">{{$request->dest_business_permit}}</a>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-secondary" style="float:left; width: 18%;" id="update_btn" type="button">Update</button>
                                                        </div>
                                                    </div>
                                                    <div id="update" style="display: none; width: 100%; margin-top: 1%">
                                                        <div class="col-auto mt-2" style="width: 80%; float: left;">
                                                            <input name="business_permit" value="{{ old('business_permit') }}" class="multisteps-form__input form-control" id="proofFile" type="file" accept="file/*">
                                                            <span class="text-danger">@error('business_permit'){{ $message }}@enderror</span>
                                                        </div>
                                                        <div class="col-auto pt-2" style="width: 20%; float: left">
                                                            <button class="btn btn-outline-danger" style="width: 100%;" id="reset" type="button">
                                                                <i class="fas fa-times fa-lg mx-auto"></i>
                                                            </button>
                                                            <span class="text-danger error-text image_one_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Destination Name</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" id="destination_name" name="destination_name" type="text" value="{{ $request->dest_name }}"/>
                                                        <span class="text-danger">@error('destination_name'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Description</label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="multisteps-form__textarea form-control" id="destination_description" name="destination_description">{{ $request->dest_description }}</textarea>
                                                        <span class="text-danger">@error('destination_description'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Date Established</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" name="dest_date_opened" value="{{ $request->dest_date_opened }}" type="date"/>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Working Hours</label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="multisteps-form__textarea form-control" id="destination_working_hours" name="destination_working_hours">{{ $request->dest_working_hours }}</textarea>
                                                        <span class="text-danger">@error('destination_working_hours'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Category</label>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-select" name="dest_category" aria-label="Default select example">
                                                            <option selected>{{ $request->dest_category }}</option>
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

                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Where is this Located?</h3>
                                            <div class="multisteps-form__content">
                                                <div class="row">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Destination Address</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" id="destination_address" name="destination_address" type="text" value="{{ $request->dest_address }}"/>
                                                            <span class="text-danger">@error('destination_address'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>City or Municipality</label>
                                                        </div>
                                                        <div class="col">
                                                            <select class="multisteps-form__select form-select" id="destination_city" name="destination_city">
                                                                <option>Select</option>
                                                                <option @if( $request->dest_city =="Bacacay") selected @endif>Bacacay</option>
                                                                <option @if( $request->dest_city =="Camalig") selected @endif>Camalig</option>
                                                                <option @if( $request->dest_city =="Daraga") selected @endif>Daraga</option>
                                                                <option @if( $request->dest_city =="Guinobatan") selected @endif>Guinobatan</option>
                                                                <option @if( $request->dest_city =="Jovellar") selected @endif>Jovellar</option>
                                                                <option @if( $request->dest_city =="Legazpi") selected @endif>Legazpi</option>
                                                                <option @if( $request->dest_city =="Libon") selected @endif>Libon</option>
                                                                <option @if( $request->dest_city =="Ligao") selected @endif>Ligao</option>
                                                                <option @if( $request->dest_city =="Malilipot") selected @endif>Malilipot</option>
                                                                <option @if( $request->dest_city =="Malinao") selected @endif>Malinao</option>
                                                                <option @if( $request->dest_city =="Manito") selected @endif>Manito</option>
                                                                <option @if( $request->dest_city =="Oas") selected @endif>Oas</option>
                                                                <option @if( $request->dest_city =="Pio Duran") selected @endif>Pio Duran</option>
                                                                <option @if( $request->dest_city =="Polangui") selected @endif>Polangui</option>
                                                                <option @if( $request->dest_city =="RapuRapu") selected @endif>RapuRapu</option>
                                                                <option @if( $request->dest_city =="Santo Domingo") selected @endif>Santo Domingo</option>
                                                                <option @if( $request->dest_city =="Tabaco") selected @endif>Tabaco</option>
                                                                <option @if( $request->dest_city =="Tiwi") selected @endif>Tiwi</option>
                                                            </select>
                                                            <span class="text-danger">@error('destination_city'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4" id="container">
                                                        <div class="col-12">
                                                            <label>Pin the Location</label>
                                                        </div>
                                                        <div class="col" id="map">Loading Map</div>
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

                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Contact Information</h3>
                                            <div class="multisteps-form__content">
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" id="destination_email" name="dest_email" type="text" value="{{ $request->dest_email }}"/>
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Phone</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" id="destination_phone" name="dest_phone" type="text" value="{{ $request->dest_phone }}"/>
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Facebook</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" name="dest_fb" type="text" value="{{ $request->dest_fb }}"/>
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Twitter</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" name="dest_twt" type="text" value="{{ $request->dest_twt }}"/>
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Instagram</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" name="dest_ig" type="text" value="{{ $request->dest_ig }}"/>
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Website</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" name="dest_web" type="text" value="{{ $request->dest_web}}"/>
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

                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Other Details</h3>
                                            <div class="multisteps-form__content">
                                                <div class="form-row" id="multi-image-div">
                                                    @foreach($images as $image)
                                                        <img src="{{ asset($image->dest_image) }}" class="col-3 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 300px; width: auto">
                                                    @endforeach
                                                </div>
                                                <div class="form-row mt-4" id="images-preview-height">
                                                    <div class="col-12">
                                                        <div class="images-preview-div" id="images-preview-div"> </div>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Upload Images <text style="color: red">*</text></label>
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
                                                        <label>Entrance Fee</label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="multisteps-form__textarea form-control" name="destination_entrance_fee">{{ $request->dest_entrance_fee }}</textarea>
                                                        <span class="text-danger">@error('destination_entrance_fee'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Direction</label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="multisteps-form__textarea form-control" name="dest_direction">{{ $request->dest_direction }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Fare Estimation</label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="multisteps-form__textarea form-control" name="dest_fare">{{ $request->dest_fare }}</textarea>
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
                                                <div class="row">
                                                    @forelse($activities as $activity)
                                                        <div class="multisteps-form__content" id="increase_activity">
                                                            <div class="form-row mt-4">
                                                                <div class="col-12">
                                                                    <label>Activity</label>
                                                                </div>
                                                                <div class="col">
                                                                    <input class="multisteps-form__input form-control activity_name" id="activity_name" value="{{ $activity->activity }}" name="activity[]" type="text" placeholder="Activity Name"/>
                                                                    <span class="text-danger">@error('activity'){{ $message }}@enderror</span>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Description</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="activity_description[]" placeholder="Activity Description">{{ $activity->activity_description }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Fee</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="activity_fee[]" type="text" placeholder="Activity Fee">{{ $activity->activity_fee }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Pax</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="activity_number_of_pax[]" type="text" placeholder="Number of Pax">{{ $activity->activity_number_of_pax }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                @if($loop->iteration != $loop->last)
                                                                    <button class="btn btn-danger remove_activity_btn" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                @endif
                                                                @if($loop->last)
                                                                    <button class="btn btn-danger clear_activity_btn mr-auto" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                    <button class="btn btn-warning add_activity_btn" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @empty
                                                        {{--                                                            If activity is empty, show blank form--}}
                                                        <div class="multisteps-form__content" id="increase_activity">
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
                                                                <button class="btn btn-warning add_activity_btn ml-auto" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
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
                                                <div class="row">
                                                    @forelse($amenities as $amenity)
                                                        <div class="multisteps-form__content" id="increase_amenity">
                                                            <div class="form-row mt-4">
                                                                <div class="col-12">
                                                                    <label>Amenity</label>
                                                                </div>
                                                                <div class="col">
                                                                    <input class="multisteps-form__input form-control amenity_name" value="{{ $amenity->amenity }}" id="amenity_name" name="amenity[]" type="text" placeholder="Amenity Name"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Description</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="amenity_description[]" placeholder="Amenity Description">{{ $amenity->amenity_description }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Fee</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="amenity_fee[]" type="text" placeholder="Amenity Fee">{{ $amenity->amenity_fee }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                @if($loop->iteration != $loop->last)
                                                                    <button class="btn btn-danger remove_amenity_btn" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                @endif
                                                                @if($loop->last)
                                                                    <button class="btn btn-danger clear_amenity_btn mr-auto" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                    <button class="btn btn-warning add_amenity_btn" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @empty
                                                        {{--                                                            If amenity is empty, show blank form--}}
                                                        <div class="multisteps-form__content" id="increase_amenity">
                                                            <div class="form-row mt-4">
                                                                <div class="col-12">
                                                                    <label>Amenity</label>
                                                                </div>
                                                                <div class="col">
                                                                    <input class="multisteps-form__input form-control amenity_name" name="amenity[]" id="amenity_name" type="text" placeholder="Amenity Name"/>
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
                                                                <button class="btn btn-warning add_amenity_btn" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
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
                                                <div class="row">
                                                    @forelse($packages as $package)
                                                        <div class="multisteps-form__content" id="increase_package">
                                                            <div class="form-row mt-4">
                                                                <div class="col-12">
                                                                    <label>Package Name</label>
                                                                </div>
                                                                <div class="col">
                                                                    <input class="multisteps-form__input form-control package_name" value="{{ $package->dest_pkg_name }}" id="package_name" name="dest_pkg_name[]" type="text" placeholder="Package Name"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Description</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="dest_pkg_description[]" placeholder="Package Description">{{ $package->dest_pkg_description }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Minimum Fee</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="dest_pkg_min_fee[]" type="text" placeholder="Package Minimum Fee">{{ $package->dest_pkg_min_fee }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Rates</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="dest_pkg_rate[]" type="text" placeholder="Package Rates">{{ $package->dest_pkg_rate }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Inclusions</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="dest_pkg_inclusions[]" placeholder="Package Inclusions">{{ $package->dest_pkg_inclusions }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                @if($loop->iteration != $loop->last)
                                                                    <button class="btn btn-danger remove_package_btn" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                @endif
                                                                @if($loop->last)
                                                                    <button class="btn btn-danger clear_package_btn mr-auto" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                    <button class="btn btn-warning add_package_btn" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="multisteps-form__content" id="increase_package">
                                                            <div class="form-row mt-4">
                                                                <div class="col-12">
                                                                    <label>Package Name</label>
                                                                </div>
                                                                <div class="col">
                                                                    <input class="multisteps-form__input form-control package_name" name="dest_pkg_name[]" id="package_name" type="text" placeholder="Package Name"/>
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
                                                                <button class="btn btn-warning add_package_btn" type="button"><i class="fas fa-plus fa-md"></i> Add entry</button>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">
                                                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                    <button class="btn btn-primary ml-auto js-btn-next" id="summary" type="button" title="Next">Next</button>
                                                    {{--                                                        <input type="submit" value="Submit" class="btn btn-success w-25 mx-auto" id="add_btn"/>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Summary</h3>
                                            <br/>
                                            <div class="multisteps-form__content " style="font-size: large; text-align: center">
                                                <div class="user-info">
                                                    <div class="col-12" style="align-items: center">
                                                        <img src="{{ url($request->user_picture) }}" alt="profile_pic" class="rounded-circle" style="height: 130px; width: 130px">
                                                        <br><br/>
                                                        <h5><strong>{{ $request->user_fname }} {{ $request->user_lname }}</strong></h5>
                                                        <span><strong>{{ $request->user_type }}</strong></span>
                                                        <br><hr>
                                                        <img id="original_logo" src="{{ url($request->dest_main_picture) }}" alt="Logo" class="bg-white img-thumbnail rounded" style="max-height: 250px;">
                                                        <div class="new_image_div col-12" id="new_image_div" style=" display: none;">
                                                            <img src="" id="new_image" class="new_image col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;">
                                                        </div>
                                                        <br>
                                                        <h3><strong id="dest_name">{{ $request->dest_name }}</strong></h3>
                                                        <span><strong id="dest_city">{{ $request->dest_city }}</strong></span>
                                                        <br/>
                                                        <span id="dest_address">{{ $request->dest_address }}</span>
                                                        <br>
                                                        <span id="dest_working_hours">{{ $request->dest_working_hours }}</span>
                                                        <br/>
                                                        <span id="dest_email" style="color: dodgerblue">{{ $request->dest_email }}</span>
                                                        <br>
                                                        <span id="dest_phone" style="color: dodgerblue">{{ $request->dest_phone }}</span>
                                                        <br/>
                                                        <span class="col-auto"><strong>Activities:</strong> <span id="activity">{{ $activities->count() }}</span></span>
                                                        <span class="col-auto ml-auto mr-auto"><strong>Amenities:</strong> <span id="amenity">{{ $amenities->count() }}</span></span>
                                                        <span class="col-auto"><strong>Packages:</strong> <span id="package">{{ $packages->count() }}</span></span>
                                                        <br>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn btn-primary js-btn-prev mr-auto" type="button" title="Prev">Prev</button>
                                                <button class="btn btn-success mr-2" type="button"
                                                        name="approve" title="Send"
                                                        data-bs-toggle="modal" data-bs-target="#approve">
                                                    <i class="fas fa-check fa-md"></i> Update</button>
                                            </div>
                                        </div>

                                        <!-- Update Modal -->
                                        <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="approvetLabel" data-backdrop="static"
                                             data-keyboard="false">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="contactLabel"><strong>Update Destination</strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md">
                                                                    <h5>Do you wish to update this page?</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary ml-0 cancel" type="button" aria-hidden="true" data-dismiss="modal">No</button>
                                                        <button class="btn btn-success mr-0" type="submit" name="submit" title="Send" value="update"><i class="fas fa-check fa-md"></i> Yes</button>
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
        </div>
    </section>
@endsection

@push('specific-css')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <style>
        .go-back-btn{
            margin-left: 21%;
            margin-bottom: 1%;
        }
        .images-preview-div img
        {
            padding: 5px;
            max-width: 300px;
            max-height: 400px;
        }

        /* Phone */
        @media screen and (max-width:477px) {

        }
    </style>
@endpush

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
                $("#multi-image-div").hide(1000);
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
                $("#multi-image-div").show(1000);
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
                $('#original_logo').hide();
            } else{
                // document.getElementById("add_form").style.height = '650px';
                $('#original_logo').show();
                $('.new_image_div').hide();
                $("#reset1").prop("disabled",true);
            }
        }
        $(document).ready(function() {
            //Animation
            const typed = new Typed(".auto-type", {
                strings: ["Modify", "Enhance", "Update"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });
            $(".cancel").click(function () {
                $('#reject').modal('hide');
                $('#approve').modal('hide');
            });
            // to show the update business permit option
            document.getElementById('update_btn').onclick= function() {
                if (this.innerHTML=="Update"){
                    this.innerHTML = "Cancel";
                    $('#update').show();
                }
                else
                {
                    this.innerHTML = "Update";
                    $('#update').hide();
                }
            };
            //clear coordinates
            $(".clear").click(function(){
                document.getElementById("latitude").value = "13.143986664725428";
                document.getElementById("longitude").value = "123.72595988123209";

                $("#info").hide(300);
                document.getElementById("info").innerHTML = "";
                $(".clear").hide(300);
            });
            //Image
            $('#remove1').click(function (){
                $('#picture').hide(100);
                $('#upload').show(200);
                document.getElementById('hidden_input').value = "false";
            });
            $('#restore1').click(function (){
                $('#upload').hide(100);
                $('#picture').show(200);
                document.getElementById('hidden_input').value = "true";
                $('#reset1').click();
            });
            $('#reset1').click(function(){
                let image_one = document.getElementById('formFile1');
                image_one.value = image_one.defaultValue;
                $('.new_image_div').hide(100);
                $('#original_logo').show();
            });
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
            //Clear Last Field
            $(document).on('click','.clear_activity_btn', function(e){
                e.preventDefault();
                let activity = document.getElementsByName("activity[]");
                let description = document.getElementsByName("activity_description[]");
                let pax = document.getElementsByName("activity_number_of_pax[]");
                let fee = document.getElementsByName("activity_fee[]");
                let count = activity.length;
                activity[count-1].value = "";
                description[count-1].value = "";
                pax[count-1].value = "";
                fee[count-1].value = "";
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
            //Clear Last Field
            $(document).on('click','.clear_amenity_btn', function(e){
                e.preventDefault();
                let amenity = document.getElementsByName("amenity[]");
                let description = document.getElementsByName("amenity_description[]");
                let fee = document.getElementsByName("amenity_fee[]");
                let count = amenity.length;
                amenity[count-1].value = "";
                description[count-1].value = "";
                fee[count-1].value = "";
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
            //Clear Last Field
            $(document).on('click','.clear_package_btn', function(e){
                e.preventDefault();
                let pkg = document.getElementsByName("dest_pkg_name[]");
                let description = document.getElementsByName("dest_pkg_description[]");
                let pax = document.getElementsByName("dest_pkg_number_of_pax[]");
                let fee = document.getElementsByName("dest_pkg_fee[]");
                let inclusion = document.getElementsByName("dest_pkg_inclusions[]");
                let count = pkg.length;
                pkg[count-1].value = "";
                description[count-1].value = "";
                fee[count-1].value = "";
                pax[count-1].value = "";
                inclusion[count-1].value = "";
            });
            //Remove Inserted Fields
            $(document).on('click','.remove_package_btn', function(e){
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
                height_decrease('increase_package');
            });
        });
        if("{{$request->dest_latitude}}" != 13.143986664725428 && "{{$request->dest_longitude}}" != 123.72595988123209){
            document.getElementById("latitude").value = "{{$request->dest_latitude}}";
            document.getElementById("longitude").value = "{{$request->dest_longitude}}";
        }

        //Show Destination Map
        function initMapShowAdmin() {
            //Map Settings
            let mapOptions = {
                center: { lat: {{$request->dest_latitude}}, lng: {{$request->dest_longitude}} },
                zoom: 13,
                mapId: "e3a69f21a8a07bc3",
            };
            //Displaying map to div
            let map = new google.maps.Map(document.getElementById("map"), mapOptions);

            //Creating Map Marker
            //Marker Settings
            let markerOptions = {
                position: { lat: {{$request->dest_latitude}}, lng: {{$request->dest_longitude}} },
                map: map,
                optimized: false, //Enables event
                icon: {
                    url:'{{ asset('img/location.png') }}',
                    scaledSize: new google.maps.Size(38, 50),
                    anchor: new google.maps.Point(19.45, 51.5), //pinpoint location
                },
                title: "{{$request->dest_name}}",
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

            //Marker Animation Stop
            setTimeout(() => {
                marker.setAnimation(null);
                //Hide animation #
                document.getElementById("info").innerHTML = marker.getAnimation();
            },3000);

            //============================================ NEW DESTINATION REQUEST SUMMARY

            $('#destination_name').keyup(function() {
                document.getElementById('dest_name').innerHTML = document.getElementById('destination_name').value;
            });
            $('#destination_description').keyup(function() {
                document.getElementById('dest_description').innerHTML = document.getElementById('destination_description').value;
            });
            $('#destination_address').keyup(function() {
                document.getElementById('dest_address').innerHTML = document.getElementById('destination_address').value;
            });
            $('#destination_working_hours').keyup(function() {
                document.getElementById('dest_working_hours').innerHTML = document.getElementById('destination_working_hours').value;
            });
            $('#destination_email').keyup(function() {
                document.getElementById('dest_email').innerHTML = document.getElementById('destination_email').value;
            });
            $('#destination_phone').keyup(function() {
                document.getElementById('dest_phone').innerHTML = document.getElementById('destination_phone').value;
            });
            $('#destination_city').change(function() {
                document.getElementById('dest_city').innerHTML = document.getElementById('destination_city').value;
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
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbV7DVh7RNb9up1QQt0zFabQZdcDmzgM8&map_ids=e3a69f21a8a07bc3 &callback=initMapShowAdmin"></script>
@endpush
