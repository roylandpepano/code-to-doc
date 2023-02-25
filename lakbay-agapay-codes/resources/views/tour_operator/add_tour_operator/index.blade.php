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
        <img src="{{ asset('img/tour_operator/tour-op-bg-1.jpg') }}" class="img-banner-show">
        <img src="{{ asset('img/tour_operator/tour-op-bg-mobile.jpg') }}" class="img-banner-show-mobile">
        <div class="header show-animation"  style="">
            <h2 class="text-white">#<span class="auto-type"></span></h2>
            <p class="text-white">Add a Tour Operator</p>
        </div>
    </section>
    <head>
        <style>
            label{
                font-weight: bold;
            }
            .images-preview-div img
            {
                padding: 5px;
                max-width: 300px;
                max-height: 400px;
            }
        </style>
    </head>
    @if(session('success'))
        <div class="toast bg-success text-white fade" role="status" aria-live="polite"  aria-atomic="true" data-delay="8000" id="showToast" style="z-index: 5;position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                <i class="fa-sharp fa-solid fa-circle rounded mr-2"></i>
                <strong class="mr-auto">Notification</strong>
                <small>seconds ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {!! session('success') !!}
            </div>
        </div>
    @endif
    <div class="manage mt-5">
        <button type="button" style="max-height: 40px" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Manage Page"
                onclick="location.href='{{ route('tour_operator.index') }}'">Manage Page<i class="fa-solid fa-circle-arrow-right ml-2"></i></button>
    </div>
    <!-- Main content -->
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
                                        <button class="multisteps-form__progress-btn js-active" type="button" id="details" title="Details">Details</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Photos">Photos</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Contact">Contact</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Location">Services</button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Packages">Packages</button>
                                        <button class="multisteps-form__progress-btn" id="summary" type="button" title="Summary">Summary</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-8 m-auto">
                                    @if ($errors->any())
                                        <div class="alert alert-danger col-12">
                                            Please make sure all the necessary fields are filled with appropriate data.
                                            <span class="text-danger">@error('reason'){{ $message }}@enderror</span>
                                        </div>
                                    @endif
                                    <form class="multisteps-form__form" id="add_form" action="{{ route('tour_operator.create') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Tour Operator Details</h3>
                                            <div class="multisteps-form__content">
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Company Logo/Image: <text style="color: red">*</text></label>
                                                    </div>
                                                    <div class="new_image_div col-12" id="new_image_div" style="display: none;">
                                                        <img src="" id="new_image" class="new_image col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;" alt="Logo">
                                                    </div>
                                                    <div class="col-auto mt-2" style="width: 100%">
                                                        <input name="image" value="{{ old('image') }}" class="multisteps-form__input form-control" id="formFile1" type="file" accept="image/*" onchange="previewFile(this);">
                                                        <span class="text-danger">@error('image'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Company Name <text style="color: red">*</text></label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" id="operator_company" name="operator_company" type="text" value="{{ old('operator_company') }}"/>
                                                        <span class="text-danger">@error('operator_company'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="0" name="operator_operating" id="operator_operating"/>
                                                <div class="multisteps-form__content" id="image_increase">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Proof of Ownership (Business Permit):<text style="color: red">*</text></label>
                                                        </div>
                                                        <div class="new_image_proof_div col-12" id="new_image_proof_div" style=" display: none;">
                                                            <img src="" id="new_image_proof" class="new_image_proof col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;">
                                                        </div>
                                                        <div class="col-auto mt-2" style="width: 85%">
                                                            <input name="business_permit" value="{{ old('business_permit') }}" class="multisteps-form__input form-control" id="proofFile" type="file" accept="file/*">
                                                            <span class="text-danger">@error('business_permit'){{ $message }}@enderror</span>
                                                        </div>
                                                        <div class="col-auto mt-2" style="width: 15%">
                                                            <button class="btn btn-secondary"  style="width: 100%;" id="reset1" type="button" disabled>
                                                                <i class="fas fa-times fa-lg mx-auto"></i>
                                                            </button>
                                                            <span class="text-danger error-text image_one_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Location <text style="color: red">*</text></label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="multisteps-form__textarea form-control" id="operator_location" name="operator_location" >{{ old('operator_location') }}</textarea>
                                                        <span class="text-danger">@error('operator_location'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>City or Municipality <text style="color: red">*</text></label>
                                                    </div>
                                                    <div class="col">
                                                        <select class="multisteps-form__select form-select operator_city" id="operator_city" name="operator_city">
                                                            <option >Select</option>
                                                            <option @if(old('operator_city')=='Bacacay') selected @endif>Bacacay</option>
                                                            <option @if(old('operator_city')=='Camalig') selected @endif>Camalig</option>
                                                            <option @if(old('operator_city')=='Daraga') selected @endif>Daraga</option>
                                                            <option @if(old('operator_city')=='Guinobatan') selected @endif>Guinobatan</option>
                                                            <option @if(old('operator_city')=='Jovellar') selected @endif>Jovellar</option>
                                                            <option @if(old('operator_city')=='Legazpi') selected @endif>Legazpi</option>
                                                            <option @if(old('operator_city')=='Libon') selected @endif>Libon</option>
                                                            <option @if(old('operator_city')=='Ligao') selected @endif>Ligao</option>
                                                            <option @if(old('operator_city')=='Malilipot') selected @endif>Malilipot</option>
                                                            <option @if(old('operator_city')=='Malinao') selected @endif>Malinao</option>
                                                            <option @if(old('operator_city')=='Manito') selected @endif>Manito</option>
                                                            <option @if(old('operator_city')=='Oas') selected @endif>Oas</option>
                                                            <option @if(old('operator_city')=='Pio Duran') selected @endif>Pio Duran</option>
                                                            <option @if(old('operator_city')=='Polangui') selected @endif>Polangui</option>
                                                            <option @if(old('operator_city')=='RapuRapu') selected @endif>RapuRapu</option>
                                                            <option @if(old('operator_city')=='Santo Domingo') selected @endif>Santo Domingo</option>
                                                            <option @if(old('operator_city')=='Tabaco') selected @endif>Tabaco</option>
                                                            <option @if(old('operator_city')=='Tiwi') selected @endif>Tiwi</option>
                                                        </select>
                                                        <span class="text-danger">@error('operator_city'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Description <text style="color: red">*</text></label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="multisteps-form__textarea form-control" name="operator_description" >{{ old('operator_description') }}</textarea>
                                                        <span class="text-danger">@error('operator_description'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="button-row d-flex mt-4">
                                                    <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                </div>
                                            </div>
                                        </div>
{{--    Photos --}}
                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Photos</h3>
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
                                                <div class="row">
                                                    <div class="button-row d-flex mt-4 col-12">
                                                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                        <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--    Contact Information --}}
                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Contact Information</h3>
                                            <div class="multisteps-form__content">
                                                <div class="form-row mt-4">
                                                    <div class="col-12">
                                                        <label>Email <text style="color: red">*</text></label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" id="operator_email" name="operator_email" type="text" value="{{ old('operator_email') }}" />
                                                        <span class="text-danger">@error('operator_email'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Phone <text style="color: red">*</text></label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" id="operator_phone" name="operator_phone" type="text" value="{{ old('operator_phone') }}" />
                                                        <span class="text-danger">@error('operator_phone'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Facebook</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" name="operator_fb" type="text" value="" />
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Twitter</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" name="operator_twt" type="text" value="" />
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Instagram</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" name="operator_ig" type="text" value="" />
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Website</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="multisteps-form__input form-control" name="operator_web" type="text" value="" />
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
                                            <h3 class="multisteps-form__title">Services</h3>
                                            <div class="multisteps-form__content">
                                                <div class="row">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Services</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__textarea form-control" name="operator_services" style="height: 90vh;"></textarea>
                                                            <span class="text-danger">@error('operator_services'){{ $message }}@enderror</span>
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
                                        {{--                                    Packages--}}
                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Packages</h3>
                                            <div id="show_package">
                                                @if(old('package_name'))
                                                    @for( $i =0; $i < count(old('package_name')); $i++)
                                                        <div class="row">
                                                            <div class="multisteps-form__content" id="increase_package">
                                                                <div class="form-row mt-4">
                                                                    <div class="col-12">
                                                                        <label>Package Name</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input class="multisteps-form__input form-control package_name" id="package_name" name="package_name[]" type="text" placeholder="Package Name"  value="{{ old('package_name.'.$i) }}"/>
                                                                        <span class="text-danger">@error('package_name[]'){{ $message }}@enderror</span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Description</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="package_description[]" placeholder="Package Description" >{{ old('package_description.'.$i) }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Minimum Fee</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="package_fee[]" type="text" placeholder="Package Minimum Fee" >{{ old('package_fee.'.$i) }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Rates</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="package_number_of_pax[]" type="text" placeholder="Package Rates" >{{ old('package_number_of_pax.'.$i) }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Inclusions</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="package_inclusions[]" placeholder="Package Inclusions" >{{ old('package_inclusions.'.$i) }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Itinerary</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="package_itinerary[]" placeholder="Package Itinerary" >{{ old('package_itinerary.'.$i) }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    @if($i != count(old('package_name'))-1) <button class="btn btn-danger remove_package_btn" type="button"><i class="fas fa-times fa-md"></i> Remove Entry</button> @else
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
                                                                    <label>Package Name</label>
                                                                </div>
                                                                <div class="col">
                                                                    <input class="multisteps-form__input form-control package_name" id="package_name" name="package_name[]" type="text" placeholder="Package Name"  />
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Description</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="package_description[]" placeholder="Package Description" ></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Minimum Fee</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="package_fee[]" type="text" placeholder="Package Minimum Fee" ></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Rates</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="package_number_of_pax[]" type="text" placeholder="Package Rates" ></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Inclusions</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="package_inclusions[]" placeholder="Package Inclusions" ></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <div class="col-12">
                                                                    <label>Itinerary</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea class="multisteps-form__input form-control" name="package_itinerary[]" placeholder="Package Itinerary" ></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-3">
                                                                <button class="btn btn-warning add_package_btn" type="button" ><i class="fas fa-plus fa-md"></i> Add entry</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">
                                                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                    <button class="btn btn-primary ml-auto js-btn-next" id="summary" type="button" title="Next">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                            <h3 class="multisteps-form__title">Summary</h3>
                                            <br/>
                                            <div class="multisteps-form__content " style="font-size: large; text-align: center">
                                                <div class="user-info">
                                                    <div class="col-12" style="align-items: center">
                                                        <div class="new_image_div col-12" id="new_image_div" style=" display: none;">
                                                            <img src="" id="new_image" class="new_image col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;">
                                                        </div>
                                                        <br>
                                                        <h5 style="color: lightgrey" id="to_name"><strong>Company Name</strong></h5>
                                                        <hr>
                                                        <span><span style="color: lightgrey"><strong id="to_city">City</strong></span></span>
                                                        <br/>
                                                        <span style="color: lightgrey" id="to_location">Location</span>
                                                        <br>
                                                        <span style="color: lightgrey" id="to_email" style="color: dodgerblue">Email</span>
                                                        <br/>
                                                        <span style="color: lightgrey" id="to_phone" style="color: dodgerblue">Phone Number</span>
                                                        <br/>
                                                        <span class="col-auto"><strong>Packages:</strong> <span id="package"></span></span>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn btn-primary js-btn-prev mr-auto" type="button" title="Prev">Prev</button>
                                                <button class="btn btn-success mr-0" data-bs-toggle="modal" data-bs-target="#submitModal" type="button" name="save" id="save" title="Save" value="Save"><i class="fas fa-check fa-md mr-2"></i> Submit</button>
                                            </div>
                                        </div>

                                        <!-- Approve Modal -->
                                        <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="approvetLabel" data-backdrop="static"
                                             data-keyboard="false">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="contactLabel"><strong>Submit Page</strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md">
                                                                    <h5>Do you wish to submit this page?</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary ml-0 cancel" type="button" aria-hidden="true" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success mr-0" type="submit" name="submit" title="Submit" value="submit"><i class="fas fa-check fa-md"></i> Submit</button>
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
    <!-- /.content -->
@endsection

@push('specific-css')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <style>
        .manage{
            display: flex;
            justify-content: flex-end;
            margin-right: 21.5%;
            margin-bottom: 1%;
        }

        /* Phone */
        @media screen and (max-width:477px) {
            .manage{
                display: flex;
                justify-content: center;
                margin-right: 0 !important;
                margin-top: 11%;
            }
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
        function previewFile(input) {
            //Add new entry increases/decreases form size
            if (document.getElementById("formFile1").files.length !== 0) {
                document.getElementById("add_form").style.height = '1200px';

                let file = $("input[type=file]").get(0).files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function () {
                        $(".new_image").attr("src", reader.result);
                    }
                    reader.readAsDataURL(file);
                }
                $('.new_image_div').show();
            } else{
                document.getElementById("add_form").style.height = '650px';
                $('.new_image_div').hide();
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

        $('#showToast').toast('show');

        $(document).ready(function() {
            const typed = new Typed(".auto-type", {
                strings: ["Exhibit", "Establish", "Guide"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });
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
            $(".cancel").click(function () {
                $('#submitModal').modal('hide');
            });

            //Add new entry increases/decreases form size
            function height_increase(id) {
                let increase = parseInt(document.getElementById('add_form').offsetHeight) + parseInt(document.getElementById(id).offsetHeight);
                let size = (increase.toString()).concat("px");
                document.getElementById("add_form").style.height = size;
            }

            function height_decrease(id) {
                let decrease = parseInt(document.getElementById('add_form').offsetHeight) - parseInt(document.getElementById(id).offsetHeight);
                let size = (decrease.toString()).concat("px");
                document.getElementById("add_form").style.height = size;
            }

            //Add New Package Fields
            $(".add_package_btn").click(function (e) {
                e.preventDefault();
                $("#show_package").prepend(`<div class="row append_item">
                                                <div class="multisteps-form__content">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Package Name</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control package_name" id="package_name" name="package_name[]" type="text" placeholder="Package Name"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="package_description[]" placeholder="Package Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Minimum Fee</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="package_fee[]" type="text" placeholder="Package Minimum Fee"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Rates</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="package_number_of_pax[]" type="text" placeholder="Package Rates"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Inclusions</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="package_inclusions[]" placeholder="Package Inclusions"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Itinerary</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="package_itinerary[]" placeholder="Package Itinerary"></textarea>
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
            $(document).on('click', '.clear_package_btn', function (e) {
                e.preventDefault();
                let pkg = document.getElementsByName("package_name[]");
                let description = document.getElementsByName("package_description[]");
                let pax = document.getElementsByName("package_number_of_pax[]");
                let fee = document.getElementsByName("package_fee[]");
                let inclusion = document.getElementsByName("package_inclusions[]");
                let itinerary = document.getElementsByName("package_itinerary[]");
                let count = pkg.length;
                pkg[count - 1].removeAttribute("readonly");
                pkg[count - 1].value = "";
                description[count - 1].value = "";
                fee[count - 1].value = "";
                pax[count - 1].value = "";
                inclusion[count - 1].value = "";
                itinerary[count - 1].value = "";
            });
            //Remove Inserted Fields
            $(document).on('click', '.remove_package_btn', function (e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
                height_decrease('increase_package');
            });

            let package_count;
            $('button#summary').click(function() {
                //Counting Package Input
                package_count=0;
                let c = $('input[class*="package_name"]').length;
                for (i=0; i<c; i++){
                    if(document.getElementsByClassName("package_name")[i].value.length != 0){
                        package_count++;
                    }
                }
                document.getElementById('package').innerHTML = package_count;
            });

            $(window).on("load", function () {
                if((document.getElementById('operator_company').value) !== '')
                    document.getElementById('to_name').innerHTML = document.getElementById('operator_company').value;
                if((document.getElementById('operator_location').value) !== '')
                    document.getElementById('to_location').innerHTML = document.getElementById('operator_location').value;
                if((document.getElementById('operator_email').value) !== '')
                    document.getElementById('to_email').innerHTML = document.getElementById('operator_email').value;
                if((document.getElementById('operator_phone').value) !== '')
                    document.getElementById('to_phone').innerHTML = document.getElementById('operator_phone').value;
                if((document.getElementById('operator_city').value) !== 'Select')
                    document.getElementById('to_city').innerHTML = document.getElementById('operator_city').value;
            });

            $('#operator_city').change(function() {
                if((document.getElementById('operator_city').value) === 'Select'){
                    document.getElementById('to_city').innerHTML = "City";
                    document.getElementById('to_city').style.color = 'lightgrey';
                }else{
                    document.getElementById('to_city').innerHTML = document.getElementById('operator_city').value;
                    document.getElementById('to_city').style.color = 'black';
                }
            });

            $('#operator_company').keyup(function() {
                if((document.getElementById('operator_company').value) === ''){
                    document.getElementById('to_name').innerHTML = "Destination Name";
                    document.getElementById('to_name').style.color = 'lightgrey';
                }else{
                    document.getElementById('to_name').innerHTML = document.getElementById('operator_company').value;
                    document.getElementById('to_name').style.color = 'black';
                }
            });

            $('#operator_location').keyup(function() {
                if((document.getElementById('operator_company').value) === ''){
                    document.getElementById('to_location').innerHTML = "Location";
                    document.getElementById('to_location').style.color = 'lightgrey';
                }else{
                    document.getElementById('to_location').innerHTML = document.getElementById('operator_location').value;
                    document.getElementById('to_location').style.color = 'black';
                }
            });

            $('#operator_email').keyup(function() {
                if((document.getElementById('operator_email').value) === ''){
                    document.getElementById('to_email').innerHTML = "Location";
                    document.getElementById('to_email').style.color = 'lightgrey';
                }else{
                    document.getElementById('to_email').innerHTML = document.getElementById('operator_email').value;
                    document.getElementById('to_email').style.color = 'black';
                }
            });

            $('#operator_phone').keyup(function() {
                if((document.getElementById('operator_phone').value) === ''){
                    document.getElementById('to_phone').innerHTML = "Phone";
                    document.getElementById('to_phone').style.color = 'lightgrey';
                }else{
                    document.getElementById('to_phone').innerHTML = document.getElementById('operator_phone').value;
                    document.getElementById('to_phone').style.color = 'black';
                }
            });
            //Enable remove image only if there is an image
            $("#formFile1").change(function (){
                if(document.getElementById("formFile1").files.length != 0){
                    $("#reset").prop("disabled",false);
                }
            });
            $("#proofFile").change(function (){
                if(document.getElementById("proofFile").files.length != 0){
                    $("#reset1").prop("disabled",false);
                }
            });

            //Image
            document.getElementById('reset').onclick= function() {
                let image_one = document.getElementById('formFile1');
                image_one.value = image_one.defaultValue;
                $('.new_image_div').hide(100);
                //Add new entry increases/decreases form size
                let increase =  parseInt(document.getElementById('add_form').offsetHeight) - 450;
                let size = (increase.toString()).concat("px");
                document.getElementById("add_form").style.height = size;
                $("#reset").prop("disabled",true);
            }
            document.getElementById('reset1').onclick= function() {
                let image_one = document.getElementById('proofFile');
                image_one.value = image_one.defaultValue;
                $('.new_image_proof_div').hide(100);
                //Add new entry increases/decreases form size
                let increase =  parseInt(document.getElementById('add_form').offsetHeight) - 450;
                let size = (increase.toString()).concat("px");
                document.getElementById("add_form").style.height = size;
                $("#reset1").prop("disabled",true);
            }
        });
    </script>
@endpush
