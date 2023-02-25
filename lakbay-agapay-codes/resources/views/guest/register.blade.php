<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lakbay Agapay') }}</title>
    <link rel="icon" href="{{ asset('img/icons/LOGO-1.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    {{--Street View--}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    {{--    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>--}}

    {{--  Bootstrap  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media_query.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/solid.css">
    @stack('specific-css')

    <!-- Fetch Online -->

    <!-- FontAwesome JS -->
    <script src="https://kit.fontawesome.com/2fb013f950.js" crossorigin="anonymous"></script>
    <!-- FontAwesome CSS -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<div id="progress">
    <span id="progress-value"><i class="fa-solid fa-arrow-up"></i></span>
</div>
<div id="app">

    <main class="py-4">

    <section id="show-header-banner">
        <img src="{{ asset('img/about/about-bg-2.jpg') }}" class="img-banner-show">
        <img src="{{ asset('img/about/about-bg-mobile.jpg') }}" class="img-banner-show-mobile">
        <div class="header show-animation"  style="">
            <h2 class="text-white">#<span class="auto-type"></span></h2>
            <p class="text-white">Sign up with your details.</p>
        </div>
    </section>

    <div class="content mt-5">
        <div class="content__inner">
            <div class="container overflow-hidden">
                @if(session('error'))
                    <div class="alert alert-error">
                        {!! session('error') !!}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {!! session('success') !!}
                    </div>
                @endif
                <br/>
                <div class="multisteps-form">
                    {{--                        Progress Bar--}}
                    <div class="row" style="justify-content: center;">
                        <div class="col-5 col-lg-7 ml-auto mr-auto mb-4">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button" title="Profile">Profile Picture</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Personal">Personal Info</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Contact">Contact</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Type">User Type</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Auth">Email & Password</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-7 m-auto">
                            <form class="multisteps-form__form" action="{{ route('guest.create')}}" id="add_form" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{--                                    Profile Picture--}}
                                <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="slideHorz">
                                    <h3 class="multisteps-form__title">Profile Picture</h3>
                                    <div class="multisteps-form__content" style="font-size: large">
                                        <div class="form-row mt-4">
                                            <div class="col-12">
                                                <label>Image (1x1 picture) <text style="color: red">*</text></label>
                                            </div>
                                            <div class="new_image_div col-12" id="new_image_div" style=" display: none;">
                                                <img src="" id="new_image" class="new_image col-12 bg-white img-thumbnail rounded mx-auto d-block" style="max-height: 450px; width: auto;">
                                            </div>
                                            <div class="col-auto mt-2" style="width: 100%">
                                                <input name="profile_pic" class="multisteps-form__input form-control" id="formFile" type="file" accept="image/*" onchange="previewFile(this);">
                                                <span class="text-danger">@error('profile_pic'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                        </div>
                                    </div>
                                </div>
                                {{--                                    Personal Info--}}
                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                    <h3 class="multisteps-form__title">Personal Information</h3>
                                    <div class="multisteps-form__content">
                                        <div class="form-row mt-4">
                                            <div class="col-12">
                                                <label>First Name <text style="color: red">*</text></label>
                                            </div>
                                            <div class="col">
                                                <input class="multisteps-form__input form-control" type="text" name="first_name" placeholder="Juan" value="{{ old('first_name') }}">
                                                <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="form-row mt-4">
                                            <div class="col-12">
                                                <label>Middle Name <text style="color: red">*</text></label>
                                            </div>
                                            <div class="col">
                                                <input class="multisteps-form__input form-control" type="text" name="middle_name" placeholder="Dela" value="{{ old('middle_name') }}">
                                                <span class="text-danger">@error('middle_name'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="form-row mt-4">
                                            <div class="col-12">
                                                <label>Last Name <text style="color: red">*</text></label>
                                            </div>
                                            <div class="col">
                                                <input class="multisteps-form__input form-control" type="text" name="last_name" placeholder="Cruz" value="{{ old('last_name') }}">
                                                <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn btn-outline-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                        </div>
                                    </div>
                                </div>
                                {{--                                    Contact--}}
                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                    <h3 class="multisteps-form__title">Contact Information</h3>
                                    <div class="multisteps-form__content">
                                        <div class="row">
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Address <text style="color: red">*</text></label>
                                                </div>
                                                <div class="col">
                                                    <input class="multisteps-form__input form-control" type="text" name="address" placeholder="Zone 1, Barangay, Municipality, Province" value="{{ old('address') }}">
                                                    <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12">
                                                    <label>Phone Number <text style="color: red">*</text></label>
                                                </div>
                                                <div class="col">
                                                    <input class="multisteps-form__input form-control" type="phone" name="phone" placeholder="09123456789" value="{{ old('phone') }}">
                                                    <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="button-row d-flex mt-4 col-12">
                                                <button class="btn btn-outline-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                    User Type--}}
                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                    <h3 class="multisteps-form__title">User Type</h3>
                                    <div class="multisteps-form__content">
                                        <div class="form-row mt-4">
                                            <div class="col-12">
                                                <label>Are you a...? <text style="color: red">*</text></label>
                                            </div>
                                            <div class="col">
                                                    <select class="multisteps-form__select form-select" name="user_type">
                                                        <option selected>Choose...</option>
                                                        <option value="Tourist">Tourist</option>
                                                        <option value="Tour Operator">Tour Operator</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn btn-outline-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                        </div>
                                    </div>
                                {{--                                    Email & Password--}}
                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="slideHorz">
                                    <h3 class="multisteps-form__title">Email and Password</h3>
                                    <div class="multisteps-form__content">
                                        <div class="form-row mt-4">
                                            <div class="col-12">
                                                <label>Email <text style="color: red">*</text></label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="email" name="email" placeholder="juandelacruz@gmail.com" value="{{ old('email') }}">
                                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="form-row mt-4">
                                            <div class="col-12">
                                                <label>Password <text style="color: red">*</text></label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="password" name="password" placeholder="More than 8 characters" value="{{ old('password') }}">
                                                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="form-row mt-4">
                                            <div class="col-12">
                                                <label>Confirm Password <text style="color: red">*</text></label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password">
                                                <span class="text-danger">@error('confirm_password'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn btn-outline-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                            <input class="form-control" type="text" name="logged_using" value="Email" hidden>
                                            <input type="submit" value="Register" name="register" class="btn btn-success"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <p style="text-align: center;">or register with</p>
                        <div class="social-login" style="display: flex; justify-content: center; margin: 0 21.5% 0 21.5%;">
                            <button type="button" onclick="location.href='{{ route('google.login') }}'" class="btn google-login"><img class="mr-2" src="https://img.icons8.com/color/16/000000/google-logo.png">Google</button>
{{--                            <button class="btn btn-outline-primary" onclick="location.href='{{ route('facebook.login') }}'" style="width: 20%; margin-left: 5px;"><i class="fa-brands fa-facebook"></i>   Facebook</button>--}}
                        </div>
                    </div>
                    <div class="link login-link text-center mt-4">Already have an account? <a style="text-decoration: underline; color: #60D782;" href="{{ route('guest.login') }}">Login Now!</a></div>
                </div>
            </div>
        </div>
        <br/><br/>
    </div>
    </main>

    <footer class="footer">
        <div class="col">
            <img class="footer-logo mb-4" src="{{ asset('img/icons/LOGO-BANNER.jpg') }}" alt="logo">
            <h4>Contact</h4>
            <p><strong>Email Address: </strong> lakbay.agapay@gmail.com</p>
            <p><strong>Address: </strong> Legazpi City, Albay, Philippines</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <a href="https://www.facebook.com/profile.php?id=100086206800895"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/LakbayAgapay"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/lakbayagapay/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="col ml-5">
            <h4>Province of Albay</h4>
            <a href="https://beta.tourism.gov.ph/">DOT Website</a>
            <a href="https://albay.gov.ph/?page_id=1557">Tourism</a>
            <a href="https://albay.gov.ph/?page_id=18018">Festivals</a>
            <a href="https://albay.gov.ph/?page_id=18580">Culture, Arts and History</a>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="{{ route('guest.about') }}">About Us</a>
            <a href="{{ route('privacy') }}">Privacy Policy</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="{{ route('guest.login') }}">Sign In</a>
        </div>

        <div class="copyright ml-3">
            <p>&copy; 2022, Lakbay Agapay</p>
        </div>
    </footer>
</div>
@push('specific-css')
    <style>
        div.button-row{
            display: flex;
            justify-content: space-between;
        }
        label{
            font-weight: bold;
        }
        .form-group button{
            height: auto;
            width: 100%;
        }

        .google-login{
            background-color: white;
            border: 1px solid lightgray;
        }

        .google-login:hover{
            background-color: lightgray;
            border: 1px solid lightgray;
        }
    </style>
@endpush

@push('scripts-tourist-show')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            //Animation
            const typed = new Typed(".auto-type", {
                strings: ["Greetings!", "BeAmazed", "ExploreAlbay"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });
        });
        function previewFile(input){
            //Add new entry increases/decreases form size
            if(document.getElementById("formFile").files.length !== 0){
                document.getElementById("add_form").style.height = '261px';
                let increase =  parseInt(document.getElementById('add_form').offsetHeight) + 450;
                let size1 = (increase.toString()).concat("px");
                document.getElementById("add_form").style.height = size1;

                let file = $("input[type=file]").get(0).files[0];
                if(file){
                    let reader = new FileReader();
                    reader.onload = function(){
                        $(".new_image").attr("src", reader.result);
                    }
                    reader.readAsDataURL(file);
                }
                $('.new_image_div').show();
            } else{
                document.getElementById("add_form").style.height = '261px';
                $('.new_image_div').hide();
            }
        }
    </script>
@endpush
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('js/packages/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/packages/typed-2.0.12.js') }}"></script>
<script src="{{ asset('js/packages/vanilla_tilt.js') }}"></script>
<script src="{{ asset('js/packages/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/function.js') }}"></script>
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/scroll-top.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
@stack('scripts-tourist-show')
</body>
</html>

