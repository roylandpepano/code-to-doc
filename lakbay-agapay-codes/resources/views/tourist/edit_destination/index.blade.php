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
            <p class="text-white">Suggest To Edit Destination</p>
        </div>
    </section>
    <div class="go-back-button mt-5">
        <button type="button" style="max-height: 40px" class="btn btn-primary go-back-btn mt-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Go Back on Previous Page"
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
                                        @if($owned == 0 && $user->user_type != "Tour Operator")
                                            <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">Owner?</button>
                                            <button class="multisteps-form__progress-btn" type="button" title="Details">Details</button>
                                        @else
                                            <button class="multisteps-form__progress-btn js-active" type="button" title="Details">Details</button>
                                        @endif
                                        <button class="multisteps-form__progress-btn" type="button" title="Location">Location</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Contact">Contact</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Others">Others</button>
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
                                    <form class="multisteps-form__form" id="add_form" action="{{ route('tourist.edit', $request->dest_id) }}" method="POST" enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf
{{--                                    Owner--}}
                                        @if($owned == 0 && $user->user_type != "Tour Operator")
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
                                        @endif
{{--                                        Details--}}
                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white @if($owned == 1 || $user->user_type == "Tour Operator") js-active @endif " data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Destination Details</h3>
                                            <div class="multisteps-form__content">
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
                                                    @if($owned == 0) <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button> @endif
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
                                                    <i class="fas fa-check fa-md"></i> Submit</button>
                                            </div>
                                        </div>

                                        <!-- Update Modal -->
                                        <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="approvetLabel" data-backdrop="static"
                                             data-keyboard="false">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="contactLabel"><strong>Submit Edit Suggestion</strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md">
                                                                    <h5>Do you wish to submit this edit suggestion?</h5>
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
            //Animation
            const typed = new Typed(".auto-type", {
                strings: ["Suggest", "Recommend", "Destination"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });
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
        });
        //============================================ EDIT DESTINATION REQUEST SUMMARY

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
    </script>
@endpush
