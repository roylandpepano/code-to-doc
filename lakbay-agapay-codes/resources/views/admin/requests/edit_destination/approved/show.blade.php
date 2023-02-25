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
                        <h4 class="header-show text-success">• Approved Edit Destination Request •</h4>
                    </div>
                    <div class="col-sm-4 header-btn">
                        @if ($errors->any())
                            <button type="button" style="max-height: 40px" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Go Back on Previous Page"
                                    onclick="location.href='{{ route('admin.requests.edit_destination.approved.index') }}'">
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
                                            </div>
                                        @endif
                                        <form class="multisteps-form__form" id="add_form" action="{{ route('admin.approve.edit_destination.requests', [$request->destination_id, $request->user_id]) }}" method="POST" enctype="multipart/form-data">
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
                                                <h3 class="multisteps-form__title">ORIGINAL Destination Details</h3>
                                                <div class="multisteps-form__content">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Destination Name</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" id="destination_name" name="destination_name" type="text" value="{{ $request->dest_name }}" readonly/>
                                                            <span class="text-danger">@error('destination_name'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Is this still operating?</label>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="0" name="dest_operating" id="flexRadioDefault2"  @if($request->dest_operating == '0') checked @endif readonly/>
                                                                <label class="form-check-label" for="flexRadioDefault2"> Yes </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="1" name="dest_operating" id="flexRadioDefault1" @if($request->dest_operating == '1') checked @endif readonly/>
                                                                <label class="form-check-label" for="flexRadioDefault1"> No </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4" >
                                                        <div class="col-12">
                                                            <label>Proof of Ownership (Business Permit):</label>
                                                            <div style="float:left; width: 80%; margin-left: 2%; color: grey"> Uploaded File: <a href="{{asset($request->dest_business_permit)}}">{{$request->dest_business_permit}}</a>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="business_permit" value="{{$request->dest_business_permit}}" hidden />
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__textarea form-control" name="destination_description" readonly>{{ $request->dest_description }}</textarea>
                                                            <span class="text-danger">@error('destination_description'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Date Established</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="destination_date_opened" value="{{ $request->dest_date_opened }}" type="date" readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Working Hours</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__textarea form-control" name="destination_working_hours" readonly>{{ $request->dest_working_hours }}</textarea>
                                                            <span class="text-danger">@error('destination_working_hours'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Category</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_category" value="{{ $request->dest_category }}" type="text" readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="button-row d-flex mt-4">
                                                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                        <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                    </div>
                                                </div>

                                                {{--                                                SUGGESTED DETAILS--}}

                                                <div class="mt-4 p-4 rounded bg-dark">
                                                    <h3 class="multisteps-form__title">APPROVED SUGGESTED Destination Details</h3>
                                                    <div class="multisteps-form__content">
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Destination Name</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" type="text" value="{{ $destination->dest_name }}" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Is this still operating?</label>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" value="0" id="flexRadioDefault2"  @if($destination->dest_operating == '0') checked @endif readonly/>
                                                                    <label class="form-check-label" for="flexRadioDefault2"> Yes </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" value="1" id="flexRadioDefault1" @if($destination->dest_operating == '1') checked @endif readonly/>
                                                                    <label class="form-check-label" for="flexRadioDefault1"> No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4" >
                                                            <div class="col-12">
                                                                <label>Proof of Ownership (Business Permit):</label>
                                                                <div style="float:left; width: 80%; margin-left: 2%; color: grey"> Uploaded File: <a href="{{asset($destination->dest_business_permit)}}">{{$destination->dest_business_permit}}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Description</label>
                                                            </div>
                                                            <div class="col">
                                                                <textarea class="multisteps-form__textarea form-control" readonly>{{ $destination->dest_description }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Date Established</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control"value="{{ $destination->dest_date_opened }}" type="date" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Working Hours</label>
                                                            </div>
                                                            <div class="col">
                                                                <textarea class="multisteps-form__textarea form-control" readonly>{{ $destination->dest_working_hours }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Category</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" value="{{ $destination->dest_category }}" type="text" readonly/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                                <h3 class="multisteps-form__title">ORIGINAL Location</h3>
                                                <div class="multisteps-form__content">
                                                    <div class="row">
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Destination Address</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" id="destination_address" name="destination_address" type="text" value="{{ $request->dest_address }}" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>City or Municipality</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" name="destination_city" value="{{ $request->dest_city }}" type="text" readonly/>
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

                                                {{--                                                ORIGINAL LOCATION--}}

                                                <div class="mt-4 p-4 rounded bg-dark">
                                                    <h3 class="multisteps-form__title">APPROVED SUGGESTED Location</h3>
                                                    <div class="multisteps-form__content">
                                                        <div class="row">
                                                            <div class="form-row mt-4">
                                                                <div class="col-12">
                                                                    <label>Destination Address</label>
                                                                </div>
                                                                <div class="col">
                                                                    <input class="multisteps-form__input form-control" type="text" value="{{ $destination->dest_address }}" readonly/>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-4">
                                                                <div class="col-12">
                                                                    <label>City or Municipality</label>
                                                                </div>
                                                                <div class="col">
                                                                    <input class="multisteps-form__input form-control" value="{{ $destination->dest_city }}" type="text" readonly/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                                <h3 class="multisteps-form__title">ORIGINAL Contact Information</h3>
                                                <div class="multisteps-form__content">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Email</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_email" type="text" value="{{ $request->dest_email }}" readonly/>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Phone</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_phone" type="text" value="{{ $request->dest_phone }}" readonly/>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Facebook</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_fb" type="text" value="{{ $request->dest_fb }}" readonly/>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Twitter</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_twt" type="text" value="{{ $request->dest_twt }}" readonly/>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Instagram</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_ig" type="text" value="{{ $request->dest_ig }}" readonly/>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Website</label>
                                                        </div>
                                                        <div class="col">
                                                            <input class="multisteps-form__input form-control" name="dest_web" type="text" value="{{ $request->dest_web}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="button-row d-flex mt-4 col-12">
                                                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                        <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                    </div>
                                                </div>

                                                {{--                                                ORIGINAL Contacts--}}

                                                <div class="mt-4 p-4 rounded bg-dark">
                                                    <h3 class="multisteps-form__title">APPROVED SUGGESTED Contact Information</h3>
                                                    <div class="multisteps-form__content">
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Email</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control"type="text" value="{{ $destination->dest_email }}" readonly/>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>Phone</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" type="text" value="{{ $destination->dest_phone }}" readonly/>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>Facebook</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" type="text" value="{{ $destination->dest_fb }}" readonly/>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>Twitter</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" type="text" value="{{ $destination->dest_twt }}" readonly/>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>Instagram</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" type="text" value="{{ $destination->dest_ig }}" readonly/>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>Website</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="multisteps-form__input form-control" type="text" value="{{ $destination->dest_web}}" readonly/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                                <h3 class="multisteps-form__title">ORIGINAL Other Details</h3>
                                                <div class="multisteps-form__content">
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Entrance Fee</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__textarea form-control" name="destination_entrance_fee" readonly>{{ $request->dest_entrance_fee }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Direction</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__textarea form-control" name="dest_direction" readonly>{{ $request->dest_direction }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-4">
                                                        <div class="col-12">
                                                            <label>Fare Estimation</label>
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="multisteps-form__textarea form-control" name="dest_fare" readonly>{{ $request->dest_fare }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="button-row d-flex mt-4">
                                                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                        <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                    </div>
                                                </div>

                                                {{--                                                ORIGINAL Other Details--}}

                                                <div class="mt-4 p-4 rounded bg-dark">
                                                    <h3 class="multisteps-form__title">APPROVED SUGGESTED Other Details</h3>
                                                    <div class="multisteps-form__content">
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Entrance Fee</label>
                                                            </div>
                                                            <div class="col">
                                                                <textarea class="multisteps-form__textarea form-control" readonly>{{ $destination->dest_entrance_fee }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Direction</label>
                                                            </div>
                                                            <div class="col">
                                                                <textarea class="multisteps-form__textarea form-control" readonly>{{ $destination->dest_direction }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mt-4">
                                                            <div class="col-12">
                                                                <label>Fare Estimation</label>
                                                            </div>
                                                            <div class="col">
                                                                <textarea class="multisteps-form__textarea form-control" readonly>{{ $destination->dest_fare }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                                <h3 class="multisteps-form__title">Summary</h3>
                                                <br/>
                                                <div class="multisteps-form__content " style="font-size: large; text-align: center">
                                                    <div class="user-info">
                                                        <div class="col-12" style="align-items: center">
                                                            <img src="{{ $request->user_picture }}" alt="profile_pic" class="rounded-circle" style="height: 130px; width: 130px">
                                                            <br><br/>
                                                            <h5><strong>{{ $request->user_fname }} {{ $request->user_lname }}</strong></h5>
                                                            <span><strong>{{ $request->user_type }}</strong></span>
                                                            <br><hr>
                                                            <h3><strong id="dest_name">{{ $request->dest_name }}</strong></h3>
                                                            <span><strong id="dest_city">{{ $request->dest_city }}</strong></span>
                                                            <br/>
                                                            <span id="dest_address">{{ $request->dest_address }}</span>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-row d-flex mt-4">
                                                    <button class="btn btn-primary js-btn-prev mr-auto" type="button" title="Prev">Prev</button>
                                                    <button class="btn btn-success mr-2" type="button"
                                                            name="restore" title="Send"
                                                            data-bs-toggle="modal" data-bs-target="#restore">
                                                        <i class="fas fa-clock-rotate-left fa-md"></i> Restore Original</button>
                                                </div>
                                            </div>

                                            <!-- Restore Modal -->
                                            <div class="modal fade" id="restore" tabindex="-1" role="dialog" aria-labelledby="rejectLabel" data-backdrop="static"
                                                 data-keyboard="false">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="contactLabel"><strong>Restore Destination</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <h5>Reason for restoring: </h5>
                                                                        <textarea class="form-control col-12" style="height: 120px" id="reason" name="reason"></textarea>
                                                                        <span class="text-danger">@error('reason'){{ $message }}@enderror</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary ml-0 cancel" type="button" aria-hidden="true" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-danger mr-0" type="submit" name="submit" title="Send" value="restore"><i class="fas fa-times fa-md"></i> Restore</button>
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
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $(':radio:not(:checked)').attr('disabled', true);
            $(".cancel").click(function () {
                $('#restore').modal('hide');
            });
        });
        //============================================ NEW DESTINATION REQUEST SUMMARY

        $('#destination_name').keyup(function() {
            document.getElementById('dest_name').innerHTML = document.getElementById('destination_name').value;
        });
        $('#destination_address').keyup(function() {
            document.getElementById('dest_address').innerHTML = document.getElementById('destination_address').value;
        });
        $('#destination_city').change(function() {
            document.getElementById('dest_city').innerHTML = document.getElementById('destination_city').value;
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbV7DVh7RNb9up1QQt0zFabQZdcDmzgM8&map_ids=e3a69f21a8a07bc3 &callback=initMapShowAdmin"></script>

@endpush
