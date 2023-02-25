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
        <img src="{{ asset('img/discover/discover-bg-show.jpg') }}" class="img-banner-show">
        <img src="{{ asset('img/discover/discover-bg-show-mobile.jpg') }}" class="img-banner-show-mobile">
    </section>
    <section id="show-main-section">
        <section id="d-item" class="section-p1 discover-item bg-white col-11 mb-5 pb-5 mx-auto shadow"
                 style="border-radius: 9px">
            <div class="map-view">
                <div class="map-frame col-12" id="map"><h3 id="empty_location">No Specified Location</h3></div>
                <div class="map-frame col-12 l-street-view--activated" id="pano" style="display: none">
                    <h3 id="empty_location">Can't Load Street View
                        <view></view>
                    </h3>
                </div>
                <div class="contact-details" id="contact-details">
                    <a href="#" type="button" id="btn-contact" class="btn btn-success btn-message" data-bs-toggle="modal"
                       data-bs-target="#contact" style="width:100%;"><i class="fa-solid fa-address-book"></i> Contact
                        Info</a>
                </div>
                <div class="contact-details row" id="contact-details">
                    <div class="col-6">
                        <div class="place-title">
                            <h5>Google Street View</h5>
                            <button type="button" id="GoogleSV" class="btn btn-light btn-links ml-2"><i
                                    class="fa-solid fa-street-view"></i> <span id="street_view">Street View</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-6">
                      @if(($discover_item->dest_fb != "") || ($discover_item->dest_twt != "") || ($discover_item->dest_ig != "") || ($discover_item->dest_web != ""))
                            <div class="place-title"><h5>
                                    <strong>Links</strong></h5>
                                @if($discover_item->dest_fb != "")
                                    <a href="{{$discover_item->dest_fb}}" type="button"
                                       class="btn btn btn-light btn-links"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($discover_item->dest_twt != "")
                                    <a href="{{$discover_item->dest_twt}}" type="button"
                                       class="btn btn btn-light btn-links"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($discover_item->dest_ig != "")
                                    <a href="{{$discover_item->dest_ig}}" type="button"
                                       class="btn btn btn-light btn-links"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if($discover_item->dest_web != "")
                                    <a href="{{$discover_item->web}}" type="button"
                                       class="btn btn btn-light btn-links"><i class="fa-solid fa-earth-asia"></i></a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
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
                                        <p>{{$discover_item->dest_phone}}</p>
                                    </div>
                                    <div class="col-md">
                                        <h5>Email Address: </h5>
                                        <p>{{$discover_item->dest_email}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span id="modal-nop">{{$discover_item->dest_address}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="place-details" style="width: 100%">
                <div class="pd-link">
                    <a href="{{ route('guest.discover') }}">Home </a>
                    <h5> / </h5>
                    <a href="/guest/search-destination?search={{ $discover_item->dest_city }}">{{$discover_item->dest_city}}</a>
                </div>
                <div class="float-right">
                    <a href="#" class=" btn-sm btn-outline-primary" data-bs-toggle="modal"
                       data-bs-target="#edit"><u>Suggest an edit</u></a>
                </div>
                <div class="modal fade mt-5" id="edit" style="max-height: 300px" tabindex="-1" role="dialog" aria-labelledby="reviewLabel"
                     data-backdrop="static"
                     data-keyboard="false">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                                            <h7>You must log in first before you can suggest an edit.</h7>
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
                <h3><strong>{{$discover_item->dest_name}}</strong>
                    <br>
                    @if(($discover_item->dest_operating) == 1)
                        <h6 style="width: fit-content; background: darkred; color: #fff; border-radius: 10px; padding: 8px;">NONOPERATIONAL</h6>
                    @endif
                </h3>
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
                </div>
                <div class="rating" style="margin-left: 0 !important;">
                    <!--   <div class="rating-bg" style="width: 90%;"></div> -->
                    <progress class="rating-bg" value="{{$rate_average}}" max="5"></progress>
                    <svg id="rate_scroll"><use xlink:href="#fivestars"/></svg>
                </div>
                <div class="mt-3">
                    <ul class="categories">
                        <li><a href="/guest/search-destination?search={{ $discover_item->dest_category }}" class="category">{{ $discover_item->dest_category }}</a></li>
                    </ul>
                </div>
                <h5 class="place-title">Description</h5>
                <p style="text-align: justify; white-space: pre-wrap;">{{$discover_item->dest_description}}</p>
                @if($discover_item->dest_date_opened == 'not specified')
                    <h5 class="place-title">Date Established</h5>
                    <p style="text-align: justify; white-space: pre-wrap;">not specified</p>
                @else
                <h5 class="place-title">Date Established</h5>
                <p style="text-align: justify; white-space: pre-wrap;">{{ Carbon\Carbon::parse($discover_item->dest_date_opened)->isoFormat('LL') }}</p>
                @endif
                <h5 class="place-title">Entrance Fee</h5>
                <p style="text-align: justify; white-space: pre-wrap;">{{$discover_item->dest_entrance_fee}}</p>
                <h5 class="place-title">When Are We Open?</h5>
                <p style="text-align: justify; white-space: pre-wrap;">{{$discover_item->dest_working_hours}}</p>
                <h5 class="place-title">How To Go?</h5>
                <p style="text-align: justify; white-space: pre-wrap;">{{$discover_item->dest_direction}}</p>
                <h5 class="place-title">Fare Estimation</h5>
                <p style="text-align: justify; white-space: pre-wrap;">{{$discover_item->dest_fare}}</p>
            </div>
        </section>




    <section id="item-slider" class="image-slider">
        <div class="discover-pictures shadow">
            <img src="{{ asset($discover_item->dest_main_picture) }}" alt="Loading...">
            @foreach($dest_images as $dest_image)
            <img src="{{ asset($dest_image->dest_image) }}" alt="Loading...">
            @endforeach
        </div>
    </section>

    <section id="d-extra" class="section-p1 discover-item bg-white col-11 mb-4 mx-auto shadow"
             style="border-radius: 9px">
        <div class="amenities">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th colspan="3">
                        <h3>Amenities</h3>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($amenities as $amenity)
                    @if ($j <= 2)
                        <tr>
                    @endif
                    @if ($j > 2)
                        <tr style="display:none;" class="hidden_amenities">
                            @endif
                            <td>
                                <p style="text-align: justify; white-space: pre-wrap;"><strong>{{$amenity->amenity}}</strong></p>
                            </td>
                            <td>
                                <p style="text-align: justify; white-space: pre-wrap;">{{$amenity->amenity_description}}</p>
                            </td>
                            <td>
                                <p style="color:mediumseagreen; text-align: justify; white-space: pre-wrap;">{{$amenity->amenity_fee}}</p>
                            </td>
                        </tr>
                            <?php $j++; ?>
                        @endforeach
                        @if($j == 1)
                            <tr class="view_amenities" style="text-align: center;">
                                <td colspan="3"><a>No Listed Amenities!</a></td>
                            </tr>
                        @endif
                        @if ($j > 3)
                            <tr class="view_amenities" style="text-align: center; cursor: pointer;">
                                <td colspan="3"><a style="color: blue; text-decoration: underline;">View More</a></td>
                            </tr>
                            <tr class="view_amenities" style="text-align: center; cursor: pointer; display: none;">
                                <td colspan="3"><a style="color: blue; text-decoration: underline;">View Less</a></td>
                            </tr>
                        @endif
                </tbody>
            </table>
        </div>
        <div class="activities">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th colspan="3">
                        <h3>Activities</h3>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($activities as $activity)
                    @if ($k <= 2)
                        <tr>
                    @endif
                    @if ($k > 2)
                        <tr style="display:none;" class="hidden_activities">
                            @endif
                            <td>
                                <p style="text-align: justify; white-space: pre-wrap;"><strong>{{$activity->activity}}</strong></p>
                            </td>
                            <td>
                                <p style="text-align: justify; white-space: pre-wrap;">{{$activity->activity_description}}</p>
                            </td>
                            <td style="color:mediumseagreen">
                                Fee: {{$activity->activity_fee}}<br/>
                                Pax: {{$activity->activity_number_of_pax}}
                            </td>
                        </tr>
                            <?php $k++; ?>
                        @endforeach
                        @if($k == 1)
                            <tr class="view_activities" style="text-align: center;">
                                <td colspan="3"><a>No Listed Activities!</a></td>
                            </tr>
                        @endif
                        @if ($k > 3)
                            <tr class="view_activities" style="text-align: center; cursor: pointer;">
                                <td colspan="3"><a style="color: blue; text-decoration: underline;">View More</a></td>
                            </tr>
                            <tr class="view_activities" style="text-align: center; cursor: pointer; display: none;">
                                <td colspan="3"><a style="color: blue; text-decoration: underline;">View Less</a></td>
                            </tr>
                        @endif
                </tbody>
            </table>
        </div>
    </section>

    <section id="item-slider" class="packages-box">
        <h3 style="text-align: center"><strong>Packages</strong></h3>
        <div class="packagespage shadow rounded">
            @include('dest_packages')
        </div>
    </section>

    <section id="item-ratings" class="ratings-box mb-3">
        <div class="card shadow mb-2">
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
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
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
        <section class="reviews rounded">
            @include('reviews_pagination')
        </section>
    </section>

    @include('layouts.nearby-places', ['nearby' => $nearby])
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
    </style>
@endpush

@push('scripts-guest-show')
    <script>
        $(document).ready(function() {
            //Rating Scroll on click
            $("#rate_scroll").click(function() {
                $('html, body').animate({
                    scrollTop: $("#item-ratings").offset().top
                }, 0);
            });
            //show and hide all packages
            $(".view").click(function () {
                $(".hidden").toggle(300);
                $(".view").toggle(300);
            });
            //show and hide package inclusions
            $(".read_more").click(function () {
                $("p[id='" + this.id + "']").toggle(300);
                $(this).text(function (i, text) {
                    return text === "Read More →" ? "Read Less ←" : "Read More →";
                });
            });

            //show and hide all amenities
            $(".view_amenities").click(function () {
                $(".hidden_amenities").toggle(300);
                $(".view_amenities").toggle(300);
            });
            //show and hide all activities
            $(".view_activities").click(function () {
                $(".hidden_activities").toggle(300);
                $(".view_activities").toggle(300);
            });

            //RATING
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
        });
        $("#GoogleSV").click(function () {
            $("#pano").toggle();
            $("#map").toggle();

            let x = document.getElementById("street_view");
            if (x.innerHTML == "Street View") {
                x.innerHTML = "Map View"
            } else {
                x.innerHTML = "Street View"
            }
        });

        //Show Destination Map
        function initialize() {
            const loc = {lat: {{$discover_item->dest_latitude}}, lng: {{$discover_item->dest_longitude}}};
            //MAP VIEW
            if ({{$discover_item->dest_latitude}} != 13.143986664725428 && {{$discover_item->dest_longitude}} != 123.72595988123209) {
                //Map Settings
                let mapOptions = {
                    center: loc,
                    zoom: 13,
                    mapId: "e3a69f21a8a07bc3",
                };
                //Displaying map to div
                let map = new google.maps.Map(document.getElementById("map"), mapOptions);

                //Creating Map Marker
                //Marker Settings
                // let img = '';
                let markerOptions = {
                    position: {lat: {{$discover_item->dest_latitude}}, lng: {{$discover_item->dest_longitude}}},
                    map: map,
                    optimized: false, //Enables event
                    icon: {
                        url: '{{ asset('img/location.png') }}',
                        scaledSize: new google.maps.Size(38, 50),
                        anchor: new google.maps.Point(19.45, 51.5), //pinpoint location
                    },
                    title: "{{$discover_item->dest_name}}",
                    animation: google.maps.Animation.BOUNCE,
                    draggable: false,
                };
                //Display Marker
                let marker = new google.maps.Marker(markerOptions);
                // marker.setLabel("yey"); //outside markerOptions

                //Marker Animation Stop
                setTimeout(() => {
                    marker.setAnimation(null);
                    //Hide animation #
                    document.getElementById("info").innerHTML = marker.getAnimation();
                }, 3000);

                //STREET VIEW
                const panorama = new google.maps.StreetViewPanorama(
                    document.getElementById("pano"),
                    {
                        position: loc,
                        pov: {
                            heading: 34,
                            pitch: 10,
                        },
                    }
                );
            }
            map.setStreetView(panorama);
        }
    </script>
    {{--Street view--}}
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbV7DVh7RNb9up1QQt0zFabQZdcDmzgM8&map_ids=e3a69f21a8a07bc3&callback=initialize&v=weekly"
        defer></script>
@endpush
