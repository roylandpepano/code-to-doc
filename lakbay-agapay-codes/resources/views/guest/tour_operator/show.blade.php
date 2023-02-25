@extends('layouts.guest-show')

@section('content-guest-show')
    <header>
        <div class="nav-bar">
            <img src="{{ asset('img/icons/LOGO-1.png') }}" class="img-logo">
            {{--            <a href="" class="logo">Logo</a>--}}
            <div class="navigation">
                <div class="nav-items">
                    <i class="uil uil-times nav-close-btn"></i>
                    <a href="{{ route('index') }}"><i class="uil uil-home"></i>Home</a>
                    <a href="{{ route('guest.discover') }}"><i class="uil uil-search"></i>Discover</a>
                    <a href="{{ route('guest.tour_operator') }}"><i class="uil uil-users-alt"></i>Tour Operator</a>
                    <a href="{{ route('guest.map') }}"><i class="uil uil-map"></i>Map</a>
                    <a href="{{ route('guest.about') }}"><i class="uil uil-circle"></i>About</a>
                    <a type="button" class="btn btn-primary-signin" href="{{ route('guest.login') }}">Sign In</a>
                </div>
            </div>
            <i class="uil uil-apps nav-menu-btn"></i>
        </div>
    </header>
    <section id="show-header-banner">
        <img src="{{ asset('img/tour_operator/tour-op-bg-show.jpg') }}" class="img-banner-show">
        <img src="{{ asset('img/tour_operator/tour-op-bg-show-mobile.jpg') }}" class="img-banner-show-mobile">
    </section>
    <section id="show-main-section">
        <section id="d-item" class="section-p1 discover-item bg-white col-11 mb-5 pb-5 mx-auto shadow"
                 style="border-radius: 9px">
            <div class="map-view col-sm-5">
                <img class=" pb-2 pt-2" src="{{ asset($operator_item->operator_main_picture) }}" alt="Loading..." style="max-width: 100%">
                <div class="contact-details">
                    <button id="btn-contact" type="button" class="btn btn-success btn-message" data-bs-toggle="modal"
                            data-bs-target="#contact"><i class="fa-solid fa-address-book"></i> Contact Info
                    </button>

                <!-- Contact Modal -->
                <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="contactLabel"
                     data-backdrop="static"
                     data-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="contactLabel"><strong>Contact Information</strong></h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md">
                                            <h5>Phone Number: </h5>
                                            <p>{{$operator_item->operator_phone_number}}</p>
                                        </div>
                                        <div class="col-md">
                                            <h5>Email Address: </h5>
                                            <p>{{$operator_item->operator_email}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <span id="modal-nop">{{$operator_item->operator_location}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="place-details">
            <div class="pd-link">
                <a href="{{ route('guest.tour_operator') }}">Home </a>
                <h5> / </h5>
                <a href="/guest/search-tour-operator?search={{ $operator_item->operator_city }}">{{$operator_item->operator_city}}</a>
            </div>
            <h4><strong>{{$operator_item->operator_company}}</strong>
                <br>
                @if(($operator_item->operator_operating) == 1)
                    <h6 style="width: fit-content; background: darkred; color: #fff; border-radius: 10px; padding: 8px;">NONOPERATIONAL</h6>
                    <br>
                @endif
            </h4>
            <div class="star" style="margin-top: 40px;">
                <svg style="display:none;">
                    <defs>
                        <symbol id="fivestars">
                            <path
                                d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                fill="white" fill-rule="evenodd"/>
                            <path
                                d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                fill="white" fill-rule="evenodd" transform="translate(24)"/>
                            <path
                                d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                fill="white" fill-rule="evenodd" transform="translate(48)"/>
                            <path
                                d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                fill="white" fill-rule="evenodd" transform="translate(72)"/>
                            <path
                                d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                fill="white" fill-rule="evenodd" transform="translate(96)"/>
                        </symbol>
                    </defs>
                </svg>
                <div class="rating" style="margin-left: 0 !important;">
                    <!--   <div class="rating-bg" style="width: 90%;"></div> -->
                    <progress class="rating-bg" value="{{$rate_average}}" max="5"></progress>
                    <svg id="rate_scroll">
                        <use xlink:href="#fivestars"/>
                    </svg>
                </div>
            </div>
            <h5 class="place-title">Description</h5>
            <p style="text-align: justify; white-space: pre-wrap;">{{$operator_item->operator_description}}</p>
            <h5 class="place-title">Services</h5>
            <p style="text-align: justify; white-space: pre-wrap;">{{$operator_item->operator_services}}</p>
            @if(($operator_item->operator_fb != "") || ($operator_item->operator_twitter != "") || ($operator_item->operator_instagram != "") || ($operator_item->operator_website != ""))
                <h5 class="place-title">Links</h5>
                <div>
                   @if ($operator_item->operator_fb != '')
                        <a href="{{$operator_item->operator_fb}}" type="button" class="btn btn btn-light btn-links"><i
                                class="fab fa-facebook-f"></i></a>
                    @endif
                    @if ($operator_item->operator_twitter != '')
                        <a href="{{$operator_item->operator_twitter}}" type="button" class="btn btn btn-light btn-links"><i
                                class="fab fa-twitter"></i></a>
                    @endif
                    @if ($operator_item->operator_instagram != '')
                        <a href="{{$operator_item->operator_instagram}}" type="button" class="btn btn btn-light btn-links"><i
                                class="fab fa-instagram"></i></a>
                    @endif
                    @if ($operator_item->operator_website != '')
                        <a href="{{$operator_item->operator_website}}" type="button" class="btn btn btn-light btn-links"><i
                                class="fa-solid fa-earth-asia"></i></a>
                    @endif
                </div>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="GoogleStreetView" tabindex="-1" role="dialog" aria-labelledby="GoogleStreetView"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Street View
                                of {{$operator_item->operator_company}}</h5>
                        </div>
                        <div class="modal-body">
                            <iframe src="{{$operator_item->operator_streetview}}" width="500vh" height="450vh"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="item-slider" class="image-slider mb-3">
        <div class="discover-pictures shadow">
            @foreach($operator_images as $operator_image)
                <img src="{{ asset($operator_image->operator_image) }}" alt="Loading...">
            @endforeach
        </div>
    </section>
    <br>

    <section id="item-slider" class="packages-box">
        <h3 style="text-align: center"><strong>Packages</strong></h3>
        <div class="packagespage shadow rounded bg-white">
            @include('to_packages')
        </div>
    </section>

    <section id="item-ratings" class="ratings-box mb-5">
        <div class="card mb-4 shadow">
            <div class="card-header">Rate Your Experience</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating">{{$rate_average}}</span> / 5</b>
                        </h1>
                        <svg style="display:none;">
                            <defs>
                                <symbol id="fivestars">
                                    <path
                                        d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                        fill="white" fill-rule="evenodd"/>
                                    <path
                                        d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                        fill="white" fill-rule="evenodd" transform="translate(24)"/>
                                    <path
                                        d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                        fill="white" fill-rule="evenodd" transform="translate(48)"/>
                                    <path
                                        d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                        fill="white" fill-rule="evenodd" transform="translate(72)"/>
                                    <path
                                        d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24"
                                        fill="white" fill-rule="evenodd" transform="translate(96)"/>
                                </symbol>
                            </defs>
                        </svg>
                        <div class="rating">
                            <!--   <div class="rating-bg" style="width: 90%;"></div> -->
                            <progress class="rating-bg" value="{{$rate_average}}" max="5"></progress>
                            <svg>
                                <use xlink:href="#fivestars"/>
                            </svg>
                        </div>
                        <br>
                        @if($total > 1)
                            <h3><span id="total_review">{{$total}}</span> Reviews</h3>
                        @else
                            <h3><span id="total_review">{{$total}}</span> Review</h3>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <p>
                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_five_star_review">{{$count_five}}</span>)
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{$average_five}}%" role="progressbar"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="five_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_four_star_review">{{$count_four}}</span>)
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{$average_four}}%" role="progressbar"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="four_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_three_star_review">{{$count_three}}</span>)
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{$average_three}}%" role="progressbar"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="three_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_two_star_review">{{$count_two}}</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{$average_two}}%" role="progressbar"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="two_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_one_star_review">{{$count_one}}</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$average_one}}%"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="one_star_progress"></div>
                        </div>
                        </p>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3 class="mt-4 mb-3">Write Review Here</h3>
                        <button id="btn-review" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#review">Review
                        </button>
                        <div class="modal fade mt-5" id="review" style="max-height: 300px" tabindex="-1" role="dialog" aria-labelledby="reviewLabel"
                             data-backdrop="static"
                             data-keyboard="false">
                            <div class="modal-dialog modal-dialog-scrollable"  role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="reviewLabel"><strong>Login Required</strong></h4>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">x</button>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="modal-body, alert alert-info alert-dismissible mt-3">
                                                    <br>
                                                    <h7>You must log in first before you submit a review.</h7>
                                                    <br>
                                                    <br>
                                                    <a href="{{ route('guest.login') }}">
                                                        <button type="button" class="btn btn-primary">Login now</button>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        <section class="reviews rounded">
            @include('reviews_pagination')
        </section>
    </section>

@endsection

@push('specific-css')
    <style>
        @media screen and (min-width: 992px) {
            #d-item {
                margin-top: 0 !important;
            }

            .discover-item {
                padding: 0 !important;
            }

            .section-p1 {
                padding: 45px 70px !important;
            }

            .col-11 {
                width: 82.666667%;
            }

            .image-slider {
                padding: 0 8.6%;
            }

            .packages-box {
                padding: 0 8.6%;
            }

            .ratings-box {
                padding: 0 8.6%;
            }
        }

        @media screen and (min-width: 477px) {

        }
    </style>
@endpush

@push('scripts-guest-show')
    <script>
        $(document).ready(function () {
            //Rating Scroll on click
            $("#rate_scroll").click(function() {
                $('html, body').animate({
                    scrollTop: $("#item-ratings").offset().top
                }, 0);
            });

            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();

                let url = $(this).attr('href');
                getReviews(url);
                window.history.pushState("", "", url);
            });

            function getReviews(url) {
                $.ajax({
                    url: url,
                    data: { id: 0 }
                }).done(function (data) {
                    $('.reviews').html(data);
                }).fail(function () {
                    alert('Reviews could not be loaded.');
                });
            }

            $(document).on('click', '.pagination a', function (e) {
                let url = $(this).attr('href');
                getPackages(url);
                window.history.pushState("", "", url);
            });

            function getPackages(url) {
                $.ajax({
                    url: url,
                    data: { id: 1 }
                }).done(function (data) {
                    $('.packagespage').html(data);

                }).fail(function () {
                    alert('Packages could not be loaded.');
                });
            }


            document.getElementById('reset1').onclick = function () {
                let image_one = document.getElementById('formFile1');
                image_one.value = image_one.defaultValue;
            }
            document.getElementById('reset2').onclick = function () {
                let image_one = document.getElementById('formFile2');
                image_one.value = image_one.defaultValue;
            }
            document.getElementById('reset3').onclick = function () {
                let image_one = document.getElementById('formFile3');
                image_one.value = image_one.defaultValue;
            }

            //show and hide all packages
            $(".view").click(function () {
                $(".hidden").toggle(300);
                $(".view").toggle(300);
            });
            //show and hide inclusions
            $(".read_more").click(function () {
                $("p[id='" + this.id + "']").toggle(300);
                $(this).text(function (i, text) {
                    return text === "Read More →" ? "Read Less ←" : "Read More →";
                });
            });
        });
    </script>
@endpush
