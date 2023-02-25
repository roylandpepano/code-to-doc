@extends('layouts.guest-new')

@section('content-guest-new')
    <div id="login-desktop">
        <div class="main-container">
            <div class="container-login">
                <img src="{{ asset('img/login/Login-Banner.jpg') }} " class="login-banner">
            </div>
            <div class="container-login">
                <div class="row-login">
                    <div class="col-md-4 offset-md-4 form login-form">
                        <form action="{{ route('guest.user_login') }}" method="POST" autocomplete="off">
                            @csrf
                            <p class="text-title">Welcome to Lakbay Agapay!</p>
                            <h3 class="login-text-center">Already have an account?</h3>
                            <p class="login-subtext-center">Login with your email and password.</p>
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {!! session('error') !!}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {!! session('success') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Email Address">
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-start" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-control button" type="submit" name="login" value="Login">
                                <p class="login-subtext-center">or</p>
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="location.href='{{ route('google.login') }}'" class="btn google-login"><img class="mr-2" src="https://img.icons8.com/color/16/000000/google-logo.png">Continue with Google</button>
                                {{--                        <button type="button" onclick="location.href='{{ route('facebook.login') }}'" class="btn btn-outline-primary"><i class="fa-brands fa-facebook"></i>   Facebook</button>--}}
                            </div>
                            <div class="link forget-pass text-center mt-2"><a style="text-decoration: underline;" href="{{ route('password.forgot') }}">Forgot password?</a></div>
                            <div class="link login-link text-center">Not yet a member? <a style="text-decoration: underline;" href="{{ route('guest.register') }}">Create an account</a></div>
                        </form>
                        <div style="width:100%; display: flex; justify-content: center;" class="mt-2">
                            <button type="button" onclick="location.href='{{ route('index') }}'" class="btn home-login">HOME</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    MOBILE  --}}

    <div id="login-mobile">
        <div class="main-container">
            <div class="container-login">
                <img src="{{ asset('img/login/Login-Banner-Mobile.jpg') }} " class="login-banner">
            </div>
            <div class="container-login">
                <div class="row-login">
                    <div class="col-md-4 offset-md-4 form login-form">
                        <form action="{{ route('guest.user_login') }}" method="POST" autocomplete="off">
                            @csrf
                            <p class="text-title">Welcome to Lakbay Agapay!</p>
                            <h3 class="login-text-center">Already have an account?</h3>
                            <p class="login-subtext-center">Login with your email and password.</p>
                            @if(session('info'))
                                <div class="alert alert-info">
                                    {!! session('info') !!}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {!! session('success') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Email Address">
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-start" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-control button" type="submit" name="login" value="Login">
                                <p class="login-subtext-center">or</p>
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="location.href='{{ route('google.login') }}'" class="btn google-login"><img class="mr-2" src="https://img.icons8.com/color/16/000000/google-logo.png">Continue with Google</button>
                                {{--                        <button type="button" onclick="location.href='{{ route('facebook.login') }}'" class="btn btn-outline-primary"><i class="fa-brands fa-facebook"></i>   Facebook</button>--}}
                            </div>
                            <div class="link forget-pass text-center mt-2"><a style="text-decoration: underline;" href="{{ route('password.forgot') }}">Forgot password?</a></div>
                            <div class="link login-link text-center">Not yet a member? <a style="text-decoration: underline;" href="{{ route('guest.register') }}">Create an account</a></div>
                        </form>
                        <div style="width:100%; display: flex; justify-content: center;" class="mt-2">
                            <button type="button" onclick="location.href='{{ route('index') }}'" class="btn home-login mb-5">HOME</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>


@endsection

@push('specific-css-new')
    <link rel="stylesheet" href="{{ asset('css/login_style.css') }}">
@endpush

@push('scripts-guest')

@endpush
