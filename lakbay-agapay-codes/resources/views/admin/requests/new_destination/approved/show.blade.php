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
            .clear{
                color: #4286f4 !important;
                display: none;
            }
            .clear:hover{
                cursor: pointer;
                color: gray !important;
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
                height: 75%;
                width: 100%;
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
                        <h1 class="header-show">{{ $request->dest_name }}</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-4" style="display:flex; justify-content: center; align-items: center; text-align: center">
                        <h4 class="header-show text-success">• Approved New Destination Request •</h4>
                    </div>
                    <div class="col-sm-4 header-btn">
                        @if ($errors->any())
                            <button type="button" style="max-height: 40px" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Go Back on Previous Page"
                                    onclick="location.href='{{ route('admin.requests.new_destination.approved.index') }}'">
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
                                            <button class="multisteps-form__progress-btn" id="details" type="button" title="Details">Details</button>
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
                                        <form class="multisteps-form__form" id="add_form" action="{{ route('admin.approve.new_destination.requests', $request->dest_id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="slideHorz">
                                                <h3 class="multisteps-form__title col-sm-6">User Who Submitted</h3>
                                                <br/>
                                                <div class="multisteps-form__content " style="font-size: large">
                                                    <div class="user-info col-lg-12 col-sm-6">
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
                                                            <br>
                                                            <span>
                                                                User location is within the submitted destination location?
                                                                @if(str_contains($request->user_address, $request->dest_city))
                                                                    <strong>Yes</strong>
                                                                @else
                                                                    <strong>No</strong>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="button-row d-flex mt-4">
                                                        <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                                <h3 class="multisteps-form__title">Destination Details</h3>
                                                <div class="multisteps-form__content">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Preview Image</label>
                                                        </div>
                                                        <div class="picture form-row" id="picture">
                                                            <input id="hidden_input" name="hidden_input" type="text" value="true" hidden/>
                                                            <div class="col-12">
                                                                <img src="{{ asset($request->dest_main_picture) }}" class="col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto">
                                                            </div>
                                                            <div class="col-12 pt-2">
                                                                <button class="btn btn-danger" id="remove1" type="button" style="width: 100%" disabled>
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
                                                                <input name="image" class="multisteps-form__input form-control" id="formFile1" type="file" accept="image/*" onchange="previewFile(this);">
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
                                                            <label>Is this still operating?</label>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="0" name="dest_operating" id="flexRadioDefault2"  @if($request->dest_operating == '0') checked @endif disabled/>
                                                                <label class="form-check-label" for="flexRadioDefault2"> Yes </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="1" name="dest_operating" id="flexRadioDefault1" @if($request->dest_operating == '1') checked @endif disabled/>
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
                                                                <button class="btn btn-secondary" style="float:left; width: 18%;" id="update_btn" type="button" disabled>Update</button>
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
                                                            <input class="multisteps-form__input form-control" id="destination_name" name="destination_name" type="text" value="{{ $request->dest_name }}" disabled/>
                                                            <span class="text-danger">@error('destination_name'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__textarea form-control" id="destination_description" name="destination_description" disabled>{{ $request->dest_description }}</textarea>
                                                            <span class="text-danger">@error('destination_description'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Date Established</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_date_opened" value="{{ $request->dest_date_opened }}" type="date" disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Working Hours</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__textarea form-control" id="destination_working_hours" name="destination_working_hours" disabled>{{ $request->dest_working_hours }}</textarea>
                                                            <span class="text-danger">@error('destination_working_hours'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Category</label>
                                                        </div>
                                                        <div class="col">
                                                            <select class="form-select" name="dest_category" aria-label="Default select example" disabled>
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
                                                                <input class="multisteps-form__input form-control" id="destination_address" name="destination_address" type="text" value="{{ $request->dest_address }}" disabled/>
                                                                <span class="text-danger">@error('destination_address'){{ $message }}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>City or Municipality</label>
                                                            </div>
                                                            <div class="col">
                                                                <select class="multisteps-form__select form-select" id="destination_city" name="destination_city" disabled>
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
                                                            <div class="col" id="map">hello</div>
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
                                                            <input class="multisteps-form__input form-control" id="destination_email" name="dest_email" type="text" value="{{ $request->dest_email }}" disabled/>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Phone</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" id="destination_phone" name="dest_phone" type="text" value="{{ $request->dest_phone }}" disabled/>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Facebook</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_fb" type="text" value="{{ $request->dest_fb }}" disabled/>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Twitter</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_twt" type="text" value="{{ $request->dest_twt }}" disabled/>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Instagram</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_ig" type="text" value="{{ $request->dest_ig }}" disabled/>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Website</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_web" type="text" value="{{ $request->dest_web}}" disabled/>
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
                                                            <input class="multisteps-form__textarea form-control" type="file" id="images" name="images[]" multiple disabled>
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
                                                            <textarea class="multisteps-form__textarea form-control" name="destination_entrance_fee" disabled>{{ $request->dest_entrance_fee }}</textarea>
                                                            <span class="text-danger">@error('destination_entrance_fee'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Direction</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__textarea form-control" name="dest_direction" disabled>{{ $request->dest_direction }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Fare Estimation</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__textarea form-control" name="dest_fare" disabled>{{ $request->dest_fare }}</textarea>
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
                                                                        <input class="multisteps-form__input form-control activity_name" id="activity_name" value="{{ $activity->activity }}" name="activity[]" type="text" placeholder="Activity Name"  disabled/>
                                                                        <span class="text-danger">@error('activity'){{ $message }}@enderror</span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Description</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="activity_description[]" placeholder="Activity Description" disabled>{{ $activity->activity_description }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Fee</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="activity_fee[]" type="text" placeholder="Activity Fee" disabled>{{ $activity->activity_fee }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Pax</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="activity_number_of_pax[]" type="text" placeholder="Number of Pax" disabled>{{ $activity->activity_number_of_pax }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    @if($loop->iteration != $loop->last)
                                                                        <button class="btn btn-danger remove_activity_btn" type="button" disabled><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                    @endif
                                                                    @if($loop->last)
                                                                        <button class="btn btn-danger clear_activity_btn mr-auto" type="button" disabled><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                        <button class="btn btn-warning add_activity_btn" type="button" disabled><i class="fas fa-plus fa-md"></i> Add entry</button>
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
                                                                        <input class="multisteps-form__input form-control activity_name" id="activity_name" name="activity[]" type="text" placeholder="Activity Name" disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Description</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="activity_description[]" placeholder="Activity Description" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Fee</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="activity_fee[]" type="text" placeholder="Activity Fee" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Pax</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="activity_number_of_pax[]" type="text" placeholder="Number of Pax" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <button class="btn btn-warning add_activity_btn ml-auto" type="button" disabled><i class="fas fa-plus fa-md"></i> Add entry</button>
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
                                                                        <input class="multisteps-form__input form-control amenity_name" value="{{ $amenity->amenity }}" id="amenity_name" name="amenity[]" type="text" placeholder="Amenity Name"  disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Description</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="amenity_description[]" placeholder="Amenity Description" disabled>{{ $amenity->amenity_description }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Fee</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="amenity_fee[]" type="text" placeholder="Amenity Fee" disabled>{{ $amenity->amenity_fee }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    @if($loop->iteration != $loop->last)
                                                                        <button class="btn btn-danger remove_amenity_btn" type="button" disabled><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                    @endif
                                                                    @if($loop->last)
                                                                        <button class="btn btn-danger clear_amenity_btn mr-auto" type="button" disabled><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                        <button class="btn btn-warning add_amenity_btn" type="button" disabled><i class="fas fa-plus fa-md"></i> Add entry</button>
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
                                                                        <input class="multisteps-form__input form-control amenity_name" name="amenity[]" id="amenity_name" type="text" placeholder="Amenity Name" disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Description</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="amenity_description[]" placeholder="Amenity Description" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Fee</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="amenity_fee[]" type="text" placeholder="Amenity Fee" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <button class="btn btn-warning add_amenity_btn" type="button" disabled><i class="fas fa-plus fa-md"></i> Add entry</button>
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
                                                                        <input class="multisteps-form__input form-control package_name" value="{{ $package->dest_pkg_name }}" id="package_name" name="dest_pkg_name[]" type="text" placeholder="Package Name"  disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Description</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="dest_pkg_description[]" placeholder="Package Description" disabled>{{ $package->dest_pkg_description }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Minimum Fee</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="dest_pkg_min_fee[]" type="text" placeholder="Package Minimum Fee" disabled>{{ $package->dest_pkg_min_fee }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Rates</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="dest_pkg_rate[]" type="text" placeholder="Package Rates" disabled>{{ $package->dest_pkg_rate }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Inclusions</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="dest_pkg_inclusions[]" placeholder="Package Inclusions" disabled>{{ $package->dest_pkg_inclusions }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    @if($loop->iteration != $loop->last)
                                                                        <button class="btn btn-danger remove_package_btn" type="button" disabled><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                    @endif
                                                                    @if($loop->last)
                                                                        <button class="btn btn-danger clear_package_btn mr-auto" type="button" disabled><i class="fas fa-times fa-md"></i> Remove Entry</button>
                                                                        <button class="btn btn-warning add_package_btn" type="button" disabled><i class="fas fa-plus fa-md"></i> Add entry</button>
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
                                                                        <input class="multisteps-form__input form-control package_name" name="dest_pkg_name[]" id="package_name" type="text" placeholder="Package Name" disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Description</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="dest_pkg_description[]" placeholder="Package Description" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Minimum Fee</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="dest_pkg_min_fee[]" type="text" placeholder="Package Minimum Fee" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Rates</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="dest_pkg_rate[]" type="text" placeholder="Package Rates" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <div class="col-12">
                                                                        <label>Inclusions</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="multisteps-form__input form-control" name="dest_pkg_inclusions[]" placeholder="Package Inclusions" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mt-3">
                                                                    <button class="btn btn-warning add_package_btn" type="button" disabled><i class="fas fa-plus fa-md" disabled></i> Add entry</button>
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
                                                            <img src="{{ asset($request->user_picture) }}" alt="profile_pic" class="rounded-circle" style="height: 130px; width: 130px">
                                                            <br><br/>
                                                            <h5><strong>{{ $request->user_fname }} {{ $request->user_lname }}</strong></h5>
                                                            <span><strong>{{ $request->user_type }}</strong></span>
                                                            <br><hr>
                                                            <div class="picture form-row mb-0" id="picture">
                                                                <div class="col-12">
                                                                    <img src="{{ asset($request->dest_main_picture) }}" class="col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto">
                                                                </div>
                                                            </div>
                                                            <div class="upload form-row mb-0" id="upload" style="display: none">
                                                                <div class="new_image_div col-12" id="new_image_div" style=" display: none;">
                                                                    <img src="" id="new_image" class="new_image col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;">
                                                                </div>
                                                            </div>
                                                            <br/>
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
                                                            <span class="col-auto"><strong>Activities:</strong> <span id="activity">{{ $activities->count() }}</span></span>
                                                            <span class="col-auto ml-auto mr-auto"><strong>Amenities:</strong> <span id="amenity">{{ $amenities->count() }}</span></span>
                                                            <span class="col-auto"><strong>Packages:</strong> <span id="package">{{ $packages->count() }}</span></span>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <div class="multisteps-form__content m-auto dest-filter">
                                                        <!-- Default checked radio -->
                                                        <h3 class="multisteps-form__title">Filter</h3>
                                                        <div class="form-check mx-auto">
                                                            <input class="form-check-input" type="radio" value="none" name="filter" id="none"
                                                                   @if($request->hidden_gem==0 && $request->famous == 0)
                                                                   checked="checked"
                                                                   @endif
                                                                   disabled/>
                                                            <label class="form-check-label" for="none"> None </label>
                                                        </div>
                                                        <div class="form-check mx-2">
                                                            <input class="form-check-input" type="radio" value="hidden" name="filter" id="hidden"
                                                                   @if($request->hidden_gem==1)
                                                                       checked="checked"
                                                                   @endif
                                                                   disabled/>
                                                            <label class="form-check-label" for="hidden"> Hidden Gem </label>
                                                        </div>
                                                        <div class="form-check mx-2">
                                                            <input class="form-check-input" type="radio" value="famous" name="filter" id="famous"
                                                                   @if($request->famous==1)
                                                                       checked="checked"
                                                                   @endif
                                                                   disabled/>
                                                            <label class="form-check-label" for="famous"> Famous </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-row d-flex mt-4">
                                                    <button class="btn btn-primary js-btn-prev mr-auto" type="button" title="Prev">Prev</button>
                                                    <button class="btn btn-danger mr-2" type="button"
                                                            name="reject" title="Send" id="reject_btn" style="display: none"
                                                            data-bs-toggle="modal" data-bs-target="#reject">
                                                        <i class="fas fa-times fa-md"></i> Remove</button>
                                                    <button class="btn btn-success mr-2" type="button"
                                                            name="approve" title="Send" id="approve_btn" style="display: none"
                                                            data-bs-toggle="modal" data-bs-target="#approve">
                                                        <i class="fas fa-check fa-md"></i> Save</button>
                                                    <button class="btn btn-warning mr-0" type="button" name="submit" id="edit" title="Send" value="edit"><i class="fas fa-edit fa-md mr-2"></i> Edit</button>
                                                </div>
                                            </div>

                                            <!-- Approve Modal -->
                                            <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="approvetLabel" data-backdrop="static"
                                                 data-keyboard="false">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="contactLabel"><strong>Edit Destination</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <h5>Do you wish to save your changes?</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary ml-0 cancel" type="button" aria-hidden="true" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-success mr-0" type="submit" name="submit" title="Send" value="save"><i class="fas fa-check fa-md"></i> Save</button>
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
                                                            <h4 class="modal-title" id="contactLabel"><strong>Remove Destination</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <h5>Reason for removing: </h5>
                                                                        <textarea class="form-control col-12" style="height: 120px" id="reason" name="reason"></textarea>
                                                                        <span class="text-danger">@error('reason'){{ $message }}@enderror</span>
                                                                        <br/>
                                                                        <span style="color: gray;">Removed destinations will be moved to rejected list.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary ml-0 cancel" type="button" aria-hidden="true" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-danger mr-0" type="submit" name="submit" title="Send" value="remove"><i class="fas fa-times fa-md"></i> Remove</button>
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
                document.getElementById("add_form").style.height = "650px";
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
            $(".cancel").click(function () {
                $('#reject').modal('hide');
                $('#approve').modal('hide');
            });
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
                $('.reject').modal('hide');
                $('.approve').modal('hide');
            });
            //clear coordinates
            $(".clear").click(function(){
                document.getElementById("latitude").value = "13.143986664725428";
                document.getElementById("longitude").value = "123.72595988123209";

                $("#info").hide(300);
                document.getElementById("info").innerHTML = "";
                $(".clear").hide(300);
            });
            //EDIT
            $("#edit").click(function(){
                $("#reject_btn").show(100);
                $("#approve_btn").show(100);
                $("#edit").hide(100);

                // remove disabled attribute of all the disabled elements
                // using the :disabled selector
                let disabled_elems = '';
                $(":disabled").each(function () {
                    disabled_elems = $(this);
                    disabled_elems.prop('disabled', false);
                });
                $("#reset2").prop('disabled',true);
                $("#details").click();
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
                activity[count-1].removeAttribute("readonly");
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
                amenity[count-1].removeAttribute("readonly");
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
                pkg[count-1].removeAttribute("readonly");
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
            //============================================ NEW DESTINATION REQUEST SUMMARY
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
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbV7DVh7RNb9up1QQt0zFabQZdcDmzgM8&map_ids=e3a69f21a8a07bc3 &callback=initMapShowAdmin"></script>

@endpush
