@extends('layouts.admin')

@section('preloader')

@endsection

@section('sidebar')
@endsection

@section('content')
    <head>
        <style>
            label{
                font-weight: bold;
            }
            html {
                box-sizing: border-box;
                /*font-size: 100%;*/
            }
            .images-preview-div img
            {
                padding: 5px;
                max-width: 300px;
                max-height: 400px;
            }
        </style>
    </head>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 header-show">
                    <div class="col-sm-4">
                        <h1 class="header-show">{{ $request->operator_company }}</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-4" style="display:flex; justify-content: center; align-items: center; text-align: center">
                        <h4 class="header-show text-warning">• Pending New Tour Operator Request •</h4>
                    </div>
                    <div class="col-sm-4 header-btn">
                        @if ($errors->any())
                            <button type="button" style="max-height: 40px" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Go Back on Previous Page"
                                    onclick="location.href='{{ route('admin.requests.new_tour_operator.index') }}'">
                                <i class="fa-solid fa-circle-arrow-left mr-2"></i>Go Back</button>
                        @else
                            <button type="button" style="max-height: 40px" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Go Back on Previous Page"
                                    onclick="location.href='{{ url()->previous() }}'">
                                <i class="fa-solid fa-circle-arrow-left mr-2"></i>Go Back</button>
                        @endif
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

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
                                            <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">User Info</button>
                                            <button class="multisteps-form__progress-btn" type="button" title="Details">Details</button>
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
                                                Please fill all the required fields.
                                                <span class="text-danger">@error('reason'){{ $message }}@enderror</span>
                                            </div>
                                        @endif
                                        <form class="multisteps-form__form" id="add_form" action="{{ route('admin.approve.new_tour_operator.requests', $request->to_id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="slideHorz">
                                                <h3 class="multisteps-form__title">User Who Submitted</h3>
                                                <br/>
                                                <div class="multisteps-form__content " style="font-size: large">
                                                    <div class="user-info">
                                                        <div class="col-lg-4 col-sm-6 user-pic" style="text-align: center">
                                                            <div class="rounded-circle">
                                                                <img src="{{ asset($request->user_picture) }}" alt="profile_pic" style="object-fit:cover;">
                                                            </div>
                                                            <span><strong>{{ $request->user_fname }} {{ $request->user_lname }}</strong></span>
                                                            <span>A {{ $request->user_type }}</span>
                                                        </div>
                                                        <div class="col-lg-8 col-sm-6">
                                                            <span>Address: <strong>{{ $request->user_address }}</strong></span>
                                                            <br>
                                                            <span>Email: <strong>{{ $request->user_email }}</strong></span>
                                                            <br>
                                                            <span>Phone: <strong>{{ $request->user_phone }}</strong></span>
                                                            <br>
                                                            <span>Logged In Using: <strong>{{ $request->user_logged_in_using }}</strong></span>
                                                            <br>
                                                            <span>Joined: <strong>{{ \Carbon\Carbon::parse($request->created_at)->isoFormat('LLLL') }}</strong></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                                    <h3 class="multisteps-form__title">Tour Operator Details</h3>
                                                    <div class="multisteps-form__content">
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Preview Image</label>
                                                            </div>
                                                            <div class="picture form-row" id="picture">
                                                                <input id="hidden_input" name="hidden_input" type="text" value="true" hidden/>
                                                                <div class="col-12">
                                                                    <img src="{{ asset($request->operator_main_picture) }}" class="col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto">
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
                                                                    <img src="" id="new_image" class="new_image col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;">
                                                                </div>
                                                                <div class="col-12 pt-2">
                                                                    <button class="btn btn-warning" id="restore1" type="button" style="width: 100%">
                                                                        <i class="fas fa-trash-restore fa-lg mr-2"></i> Restore Image
                                                                    </button>
                                                                    <span class="text-danger error-text image_one_error"></span>
                                                                </div>
                                                                <div class="col-auto pt-2" style="width: 80%">
                                                                    <input name="image" class="multisteps-form__input form-control" id="formFile1" type="file" accept="image/*" onchange="previewFile(this);"/>
                                                                    <span class="text-danger">@error('image'){{ $message }}@enderror</span>
                                                                </div>
                                                                <div class="col-auto pt-2" style="width: 20%">
                                                                    <button class="btn btn-secondary" style="width: 100%;" id="reset1" type="button">
                                                                        <i class="fas fa-times fa-lg mx-auto"></i>
                                                                    </button>
                                                                    <span class="text-danger error-text image_one_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Company Name</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" id="operator_company" name="operator_company" type="text" value="{{ $request->operator_company }}"/>
                                                                <span class="text-danger">@error('operator_company'){{ $message }}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Is this still operating?</label>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" value="0" name="operator_operating" id="flexRadioDefault2"  @if($request->operator_operating == '0') checked @endif/>
                                                                    <label class="form-check-label" for="flexRadioDefault2"> Yes </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" value="1" name="operator_operating" id="flexRadioDefault1" @if($request->operator_operating == '1') checked @endif/>
                                                                    <label class="form-check-label" for="flexRadioDefault1"> No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4" >
                                                            <div class="col-12">
                                                                <label>Proof of Ownership (Business Permit):<text style="color: red">*</text></label>
                                                                <div style="float:left; width: 80%; margin-left: 2%; color: grey"> Uploaded File: <a href="{{asset($request->operator_business_permit)}}">{{$request->operator_business_permit}}</a>
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
                                                                <label>Location</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" id="operator_location" name="operator_location" value="{{ $request->operator_location }}" type="text"/>
                                                                <span class="text-danger">@error('operator_location'){{ $message }}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>City or Municipality</label>
                                                            </div>
                                                            <div class="col">
                                                                <select class="multisteps-form__select form-select" id="operator_city" name="operator_city">
                                                                    <option>Select</option>
                                                                    <option @if( $request->operator_city =="Bacacay") selected @endif>Bacacay</option>
                                                                    <option @if( $request->operator_city =="Camalig") selected @endif>Camalig</option>
                                                                    <option @if( $request->operator_city =="Daraga") selected @endif>Daraga</option>
                                                                    <option @if( $request->operator_city =="Guinobatan") selected @endif>Guinobatan</option>
                                                                    <option @if( $request->operator_city =="Jovellar") selected @endif>Jovellar</option>
                                                                    <option @if( $request->operator_city =="Legazpi") selected @endif>Legazpi</option>
                                                                    <option @if( $request->operator_city =="Libon") selected @endif>Libon</option>
                                                                    <option @if( $request->operator_city =="Ligao") selected @endif>Ligao</option>
                                                                    <option @if( $request->operator_city =="Malilipot") selected @endif>Malilipot</option>
                                                                    <option @if( $request->operator_city =="Malinao") selected @endif>Malinao</option>
                                                                    <option @if( $request->operator_city =="Manito") selected @endif>Manito</option>
                                                                    <option @if( $request->operator_city =="Oas") selected @endif>Oas</option>
                                                                    <option @if( $request->operator_city =="Pio Duran") selected @endif>Pio Duran</option>
                                                                    <option @if( $request->operator_city =="Polangui") selected @endif>Polangui</option>
                                                                    <option @if( $request->operator_city =="RapuRapu") selected @endif>RapuRapu</option>
                                                                    <option @if( $request->operator_city =="Santo Domingo") selected @endif>Santo Domingo</option>
                                                                    <option @if( $request->operator_city =="Tabaco") selected @endif>Tabaco</option>
                                                                    <option @if( $request->operator_city =="Tiwi") selected @endif>Tiwi</option>
                                                                </select>
                                                                <span class="text-danger">@error('operator_city'){{ $message }}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Description</label>
                                                            </div>
                                                            <div class="col">
                                                                <textarea class="multisteps-form__textarea form-control" name="operator_description">{{ $request->operator_description }}</textarea>
                                                                <span class="text-danger">@error('operator_description'){{ $message }}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="button-row d-flex mt-4">
                                                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                        </div>
                                                    </div>
                                                </div>
{{--    Photos --}}
                                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                                    <h3 class="multisteps-form__title">Photos</h3>
                                                    <div class="multisteps-form__content">
                                                        <div class="form-row" id="multi-image-div">
                                                            @foreach($images as $image)
                                                                <img src="{{ asset($image->operator_image) }}" class="col-3 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 200px; width: auto">
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
                                                        <div class="row">
                                                            <div class="button-row d-flex mt-4 col-12">
                                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                                <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
{{--    Contact Information--}}
                                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                                    <h3 class="multisteps-form__title">Contact Information</h3>
                                                    <div class="multisteps-form__content">
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Email</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" id="operator_email" name="operator_email" type="text" value="{{ $request->operator_email }}"/>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>Phone</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" id="operator_phone" name="operator_phone" type="text" value="{{ $request->operator_phone_number }}"/>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>Facebook</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" name="operator_fb" type="text" value="{{ $request->operator_fb }}"/>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>Twitter</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" name="operator_twt" type="text" value="{{ $request->operator_twitter }}"/>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>Instagram</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" name="operator_ig" type="text" value="{{ $request->operator_instagram }}"/>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>Website</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" name="operator_web" type="text" value="{{ $request->operator_website}}"/>
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
                                                                    <textarea class="multisteps-form__textarea form-control" name="operator_services">{{ $request->operator_services }}</textarea>
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
                                                        <div class="row">
                                                            @forelse($packages as $package)
                                                                <div class="multisteps-form__content" id="increase_package">
                                                                    <div class="form-row mt-4">
                                                                        <div class="col-12">
                                                                            <label>Package Name</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <input class="multisteps-form__input form-control package_name" value="{{ $package->package_name }}" id="package_name" name="package_name[]" type="text" placeholder="Package Name"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row mt-3">
                                                                        <div class="col-12">
                                                                            <label>Description</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <textarea class="multisteps-form__input form-control" name="package_description[]" placeholder="Package Description">{{ $package->package_description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row mt-3">
                                                                        <div class="col-12">
                                                                            <label>Minimum Fee</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <textarea class="multisteps-form__input form-control" name="package_minimum_fee[]" type="text" placeholder="Package Fee">{{ $package->package_minimum_fee }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row mt-3">
                                                                        <div class="col-12">
                                                                            <label>Rate</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <textarea class="multisteps-form__input form-control" name="package_rate[]" type="text" placeholder="Number of Pax">{{ $package->package_rate }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row mt-3">
                                                                        <div class="col-12">
                                                                            <label>Inclusions</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <textarea class="multisteps-form__input form-control" name="package_inclusions[]" placeholder="Package Inclusions">{{ $package->package_inclusions }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row mt-3">
                                                                        <div class="col-12">
                                                                            <label>Itinerary</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <textarea class="multisteps-form__input form-control" name="package_itinerary[]" placeholder="Package Itinerary">{{ $package->package_itinerary }}</textarea>
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
                                                                            <textarea class="multisteps-form__input form-control" name="package_minimum_fee[]" type="text" placeholder="Minimum Fee"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row mt-3">
                                                                        <div class="col-12">
                                                                            <label>Rate</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <textarea class="multisteps-form__input form-control" name="package_rate[]" type="text" placeholder="Rate"></textarea>
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
                                                                <div class="picture form-row mb-3" id="picture">
                                                                    <div class="col-12">
                                                                        <img src="{{ asset($request->operator_main_picture) }}" class="col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto">
                                                                    </div>
                                                                </div>
                                                                <h3><strong id="to_company">{{ $request->operator_company }}</strong></h3>
                                                                <span><strong id="to_city">{{ $request->operator_city }}</strong></span>
                                                                <br/>
                                                                <span id="to_email" style="color: dodgerblue">{{ $request->operator_email }}</span>
                                                                <br/>
                                                                <span id="to_phone" style="color: dodgerblue">{{ $request->operator_phone_number }}</span>
                                                                <br/>
                                                                <span id="to_location">{{ $request->operator_location }}</span>
                                                                <br>
                                                                <span class="col-auto"><strong>Packages:</strong> <span id="package">{{ $packages->count() }}</span></span>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="button-row d-flex mt-4">
                                                        <button class="btn btn-primary js-btn-prev mr-auto" type="button" title="Prev">Prev</button>
                                                        <button class="btn btn-danger mr-2" type="button"
                                                                name="reject" title="Send"
                                                                data-bs-toggle="modal" data-bs-target="#reject">
                                                            <i class="fas fa-times fa-md"></i> Reject</button>
                                                        <button class="btn btn-success mr-2" type="button"
                                                                name="approve" title="Send"
                                                                data-bs-toggle="modal" data-bs-target="#approve">
                                                            <i class="fas fa-check fa-md"></i> Approve</button>
                                                    </div>
                                                </div>

                                                <!-- Approve Modal -->
                                                <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="approvetLabel" data-backdrop="static"
                                                     data-keyboard="false">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="contactLabel"><strong>Approve Destination</strong></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                    <div class="row">
                                                                        <div class="col-md">
                                                                            <h5>Do you wish to approve this request?</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary ml-0 cancel" type="button" aria-hidden="true" data-dismiss="modal">Cancel</button>
                                                                <button class="btn btn-success mr-0" type="submit" name="submit" title="Send" value="approve"><i class="fas fa-check fa-md"></i> Approve</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Reject Modal -->
                                                <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="rejectLabel" data-backdrop="static"
                                                     data-keyboard="false">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="contactLabel"><strong>Reject Destination</strong></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                    <div class="row">
                                                                        <div class="col-md">
                                                                            <h5>Reason for rejecting: </h5>
                                                                            <textarea class="form-control col-12" style="height: 120px" id="reason" name="reason"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary ml-0 cancel" type="button" aria-hidden="true" data-dismiss="modal">Cancel</button>
                                                                <button class="btn btn-danger mr-0" type="submit" name="submit" title="Send" value="reject"><i class="fas fa-times fa-md"></i> Reject</button>
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
    </div>
    <!-- /.content-wrapper -->

@endsection

@push('css')
    <style>
        /* Multi Step Form */
        body a {
            color: inherit;
            text-decoration: none;
        }

        .content {
            width: 95%;
            margin: 0 auto 50px;
        }

        .multisteps-form__progress {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
        }

        .multisteps-form__progress-btn {
            transition-property: all;
            transition-duration: 0.15s;
            transition-timing-function: linear;
            transition-delay: 0s;
            position: relative;
            padding-top: 20px;
            color: rgba(108, 117, 125, 0.7);
            text-indent: -9999px;
            border: none;
            background-color: transparent;
            outline: none !important;
            cursor: pointer;
        }

        @media (min-width: 500px) {
            .multisteps-form__progress-btn {
                text-indent: 0;
            }
        }
        .multisteps-form__progress-btn:before {
            position: absolute;
            top: 0;
            left: 50%;
            display: block;
            width: 13px;
            height: 13px;
            content: '';
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            transition: all 0.15s linear 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
            transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
            transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
            border: 2px solid currentColor;
            border-radius: 50%;
            background-color: #fff;
            box-sizing: border-box;
            z-index: 3;
        }
        .multisteps-form__progress-btn:after {
            position: absolute;
            top: 5px;
            left: calc(-50% - 13px / 2);
            transition-property: all;
            transition-duration: 0.15s;
            transition-timing-function: linear;
            transition-delay: 0s;
            display: block;
            width: 100%;
            height: 2px;
            content: '';
            background-color: currentColor;
            z-index: 1;
        }
        .multisteps-form__progress-btn:first-child:after {
            display: none;
        }
        .multisteps-form__progress-btn.js-active {
            color: #007bff;
        }
        .multisteps-form__progress-btn.js-active:before {
            -webkit-transform: translateX(-50%) scale(1.2);
            transform: translateX(-50%) scale(1.2);
            background-color: currentColor;
        }

        .multisteps-form__form {
            position: relative;
        }

        .multisteps-form__panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
            opacity: 0;
            visibility: hidden;
        }
        .multisteps-form__panel.js-active {
            height: auto;
            opacity: 1;
            visibility: visible;
        }

        .multisteps-form__panel[data-animation="slideHorz"] {
            left: 50px;
        }
        .multisteps-form__panel[data-animation="slideHorz"].js-active {
            transition-property: all;
            transition-duration: 0.25s;
            transition-timing-function: cubic-bezier(0.2, 1.13, 0.38, 1.43);
            transition-delay: 0s;
            left: 0;
        }

        /*Google Maps API*/
        html {
            box-sizing: border-box;
            /*font-size: 100%;*/
        }
        #container {
            height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        #map {
            height: 100%;
            width: 100%;
        }
    </style>
@endpush

@push('scripts')
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
                document.getElementById("add_form").style.height = "1400px";
                $("#reset2").prop("disabled",true);
            });
        });
    </script>
    <script>
        function previewFile(input){
            $('.new_image_div').show();
            let file = $("input[type=file]").get(0).files[0];

            if(file){
                let reader = new FileReader();

                reader.onload = function(){
                    $(".new_image").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
        $(document).ready(function() {
            //Image
            $('#remove1').click(function (){
                $('.picture').hide(100);
                $('.upload').show(200);
                document.getElementById('hidden_input').value = "false";
            });
            $('#restore1').click(function (){
                $('.upload').hide(100);
                $('.picture').show(200);
                document.getElementById('hidden_input').value = "true";
                $('#reset1').click();
            });
            $('#reset1').click(function(){
                let image_one = document.getElementById('formFile1');
                image_one.value = image_one.defaultValue;
                $('.new_image_div').hide(100);
            });

            $(".cancel").click(function () {
                $('#reject').modal('hide');
                $('#approve').modal('hide');
            });

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
                                                            <input class="multisteps-form__input form-control package_name" name="package_name[]" id="package_name" type="text" placeholder="Package Name"/>
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
                                                            <textarea class="multisteps-form__input form-control" name="package_minimum_fee[]" type="text" placeholder="Minimum Fee"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="col-12">
                                                            <label>Rate</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__input form-control" name="package_rate[]" type="text" placeholder="Rate"></textarea>
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
            $(document).on('click','.clear_package_btn', function(e){
                e.preventDefault();
                let pkg = document.getElementsByName("package_name[]");
                let description = document.getElementsByName("package_description[]");
                let pax = document.getElementsByName("package_number_of_pax[]");
                let fee = document.getElementsByName("package_fee[]");
                let inclusion = document.getElementsByName("package_inclusions[]");
                let itinerary = document.getElementsByName("package_itinerary[]");
                let count = pkg.length;
                pkg[count-1].value = "";
                description[count-1].value = "";
                fee[count-1].value = "";
                pax[count-1].value = "";
                inclusion[count-1].value = "";
                itinerary[count-1].value = "";
            });
            //Remove Inserted Fields
            $(document).on('click','.remove_package_btn', function(e){
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
                height_decrease('increase_package');
            });
            //============================================ NEW DESTINATION REQUEST SUMMARY

            $('#operator_company').keyup(function() {
                document.getElementById('to_company').innerHTML = document.getElementById('operator_company').value;
            });
            $('#operator_location').keyup(function() {
                document.getElementById('to_location').innerHTML = document.getElementById('operator_location').value;
            });
            $('#operator_email').keyup(function() {
                document.getElementById('to_email').innerHTML = document.getElementById('operator_email').value;
            });
            $('#operator_phone').keyup(function() {
                document.getElementById('to_phone').innerHTML = document.getElementById('operator_phone').value;
            });
            $('#operator_city').change(function() {
                document.getElementById('to_city').innerHTML = document.getElementById('operator_city').value;
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
        });

    </script>
@endpush