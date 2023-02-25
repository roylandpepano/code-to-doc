@extends('layouts.tourist')

@section('content')

    <section id="d-item" class="section-p1 discover-item">
        <div class="map-view">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d156590.14873930885!2d123.6868162779154!3d13.229876485224478!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1650076522770!5m2!1sen!2sph"
                class="map-frame" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="contact-details">
                <button class="btn btn-primary btn-message"><i
                        class="fa-solid fa-envelope"></i> Message</button>

                <button id="btn-contact" type="button" class="btn btn-success btn-message" data-bs-toggle="modal"
                        data-bs-target="#contact"><i class="fa-solid fa-address-book"></i> Contact Info</button>

                <!-- Contact Modal -->
                <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="contactLabel" data-backdrop="static"
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
            </div>
        </div>
        <div class="place-details">
            <div class="pd-link">
                <a href="{{ route('tourist.discover') }}">Home </a>
                <h5> / </h5>
                <a href="discover_item.php"> City</a>
            </div>
            <h4><strong>{{$discover_item->dest_name}}</strong>
                <br>
                @if(($discover_item->dest_operating) == 1)
                    <h6 style="width: fit-content; background: darkred; color: #fff; border-radius: 10px; padding: 8px;">NONOPERATIONAL</h6>
                @endif
            </h4>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="place-title">Description</h5>
            <span>{{$discover_item->dest_description}}</span>
            <h5 class="place-title">How To Go?</h5>
            <span>{{$discover_item->dest_direction}}</span>
            <h5 class="place-title">Fare Estimation</h5>
            <span>Php {{$discover_item->dest_fare}}</span>
            <h5 class="place-title">Links</h5>
            <div>
                <a href="{{$discover_item->dest_fb}}" type="button" class="btn btn btn-light btn-links"><i class="fab fa-facebook-f"></i></a>
                <a href="{{$discover_item->dest_twt}}" type="button" class="btn btn btn-light btn-links"><i class="fab fa-twitter"></i></a>
                <a href="{{$discover_item->dest_ig}}" type="button" class="btn btn btn-light btn-links"><i class="fab fa-instagram"></i></a>
                <a href="{{$discover_item->web}}" type="button" class="btn btn btn-light btn-links"><i class="fa-solid fa-earth-asia"></i></a>
            </div>
            <h5 class="place-title">Google Street View</h5>
            <button type="button" id="GoogleSV" class="btn btn-light btn-links" data-bs-toggle="modal" data-bs-target="#GoogleStreetView"><i class="fa-solid fa-street-view"></i></button>

            <!-- Modal -->
            <div class="modal fade" id="GoogleStreetView" tabindex="-1" role="dialog" aria-labelledby="GoogleStreetView" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Street View of {{$discover_item->dest_name}}</h5>
                        </div>
                        <div class="modal-body">
                            <iframe src="{{$discover_item->dest_street_view}}" width="500vh" height="450vh" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="item-slider" class="section-p1">
        <div class="discover-pictures">
            <img src="https://cdn.stocksnap.io/img-thumbs/960w/coastal-landscape_9GC6V9IXGA.jpg" alt="">
            <img src="https://cdn.stocksnap.io/img-thumbs/960w/coastal-landscape_9GC6V9IXGA.jpg" alt="">
            <img src="https://cdn.stocksnap.io/img-thumbs/960w/coastal-landscape_9GC6V9IXGA.jpg" alt="">
            <img src="https://cdn.stocksnap.io/img-thumbs/960w/coastal-landscape_9GC6V9IXGA.jpg" alt="">
        </div>
    </section>

    <section id="d-extra" class="section-p1 discover-item">
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
                <tr>
                    <td>
                        <h4><strong>Swimming Pool</strong></h4>
                    </td>
                    <td>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </td>
                    <td style="color:mediumseagreen">
                        Free
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4><strong>Free Wifi</strong></h4>
                    </td>
                    <td>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </td>
                    <td style="color:mediumseagreen">
                        Free
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4><strong>Room Service</strong></h4>
                    </td>
                    <td>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </td>
                    <td style="color:mediumseagreen">
                        Free
                    </td>
                </tr>
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
                <tr>
                    <td>
                        <h4><strong>Zipline</strong></h4>
                    </td>
                    <td>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </td>
                    <td style="color:mediumseagreen">
                        200 per head
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4><strong>Videoke</strong></h4>
                    </td>
                    <td>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </td>
                    <td style="color:mediumseagreen">
                        700 - 8hrs
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4><strong>Island Hopping</strong></h4>
                    </td>
                    <td>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </td>
                    <td style="color:mediumseagreen">
                        500 per head
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section id="item-slider" class="section-p1">
        <div class="packages">
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                @foreach($packages as $package)
                    @if ($i <= 3)
                        <div class="col-lg-4">
                            @endif
                            @if ($i > 3)
                                <div  style="display:none;" class="hidden col-lg-4">
                                    @endif
                                    <!-- Blog post-->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h3>{{ $package->dest_pkg_name }}</h3>
                                            <div style="color:mediumseagreen"><strong>Php {{ $package->dest_pkg_fee }}</strong></div>
                                            <p class="card-text">{{ $package->dest_pkg_description }}</p>
                                            <p class="card-text" style="display: none;" id="{{ $package->dest_pkg_name }}"><strong>Inclusions</strong></p>
                                            <p class="card-text" style="display: none;" id="{{ $package->dest_pkg_name }}">{{ $package->dest_pkg_inclusions }}</p>
                                            <a class="read_more btn btn-light" id="{{ $package->dest_pkg_name }}">Read More →</a>
                                        </div>
                                    </div>
                                </div>
                                    <?php $i++; ?>
                                @endforeach
                                @if ($i > 4)
                                    <div class="view" style="text-align: center; cursor: pointer;">
                                        <a style="color: blue; text-decoration: underline;" >View All Packages</a>
                                    </div>
                                    <div class="view" style="text-align: center; cursor: pointer; display: none;">
                                        <a style="color: blue; text-decoration: underline;">View Less</a>
                                    </div>
                                @endif
                        </div>
            </div>
    </section>

    <section id="item-ratings" class="section-p1">
        <div class="card">
            <div class="card-header">Rate Your Experience</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating">0.0</span> / 5</b>
                        </h1>
                        <div class="mb-3">
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                        </div>
                        <h3><span id="total_review">0</span> Review</h3>
                    </div>
                    <div class="col-sm-4">
                        <p>
                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="five_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="four_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="three_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="two_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" id="one_star_progress"></div>
                        </div>
                        </p>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3 class="mt-4 mb-3">Write Review Here</h3>
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary"
                                data-toggle="modal" data-target="#review_modal">Review</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5" id="review_content"></div>
    </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //show and hide all packages
            $(".view").click(function (){
                $(".hidden").toggle(300);
                $(".view").toggle(300);
            });
            //show and hide inclusions
            $(".read_more").click(function(){
                $("p[id='"+ this.id +"']").toggle(300);
                $(this).text(function(i, text){
                    return text === "Read More →" ? "Read Less ←" : "Read More →";
                });
            });
        });
    </script>
@endpush
