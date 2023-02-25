@extends('layouts.admin')

@section('preloader')

@endsection

@section('sidebar')
@endsection

@section('content')

    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="toast" style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                <strong class="mr-auto">Successfully Signed In</strong>
            </div>
            <div class="toast-body">
                {{ \Illuminate\Support\Facades\Session::get('success') }}
            </div>
        </div>
    @elseif(\Illuminate\Support\Facades\Session::has('error'))
        <div class="toast" style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                <strong class="mr-auto">Error Message</strong>
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
        </style>
    </head>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 header-show">
                    {{--                    <div class="col-sm-4">--}}
                    {{--                        <h1 class="header-show">{{ $users->user_picture }}</h1>--}}
                    {{--                    </div><!-- /.col -->--}}
                    {{--                    <div class="col-sm-4" style="display:flex; justify-content: center; align-items: center;">--}}
                    {{--                        <span class="header-show">• {{$request->user_fname}} {{$request->user_lname}}, A {{ $request->user_type }} •</span>--}}
                    {{--                    </div>--}}
                    <div class="col-sm-12 header-btn">
                        <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Go Back on Previous Page"
                                onclick="location.href='{{ route('admin.users.super_admin_user.index') }}'">
                            <i class="fa-solid fa-circle-arrow-left mr-2"></i>Go Back</button>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div style="width: 90%; max-width: 700px; margin: auto;">
            <div class="shadow p-4 rounded bg-white mb-5">
                <h3 class="multisteps-form__title">User Info</h3>
                <br/>
                <div class="multisteps-form__content ">
                    <div class="user-info col-lg-12 col-sm-6">
                        <div class="col-6 user-pic mr-auto ml-auto">
                            <div class="rounded-circle">
                                <img src="{{ $users->user_picture }}" alt="profile_pic">
                            </div>
                            <h3><strong>{{ $users->user_fname }} {{ $users->user_lname }}</strong></h3>
                            <span>{{ $users->user_type }}</span>
                            <br/>
                        </div>

                        <div class="mb-4 ml-auto mr-auto" style="font-size: 18px">
                            <span>Address: <strong>{{ $users->user_address }}</strong></span>
                            <br>
                            <span>Email: <strong>{{ $users->user_email }}</strong></span>
                            <br>
                            <span>Phone: <strong>{{ $users->user_phone }}</strong></span>
                            <br>
                            <span>Logged In Using: <strong>{{ $users->user_logged_in_using }}</strong></span>
                            <br>
                            <span>Joined: <strong>{{ \Carbon\Carbon::parse($users->created_at)->isoFormat('LLLL') }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
@endpush
@push('scripts')
@endpush
