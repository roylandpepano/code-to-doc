@extends('layouts.guest-new')

@section('content-guest-new')

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

    {{--  Desktop Mode  --}}
    <div class="desktop-map">
        <section id="discover-and-tourop-bg-desktop">
            <img src="{{ asset('img/map/map.jpg') }}">
            <h1 class="discover-and-tourop-title reveal">Map</h1>
            <h2 class="discover-and-tourop-subtitle reveal">#<span class="auto-type"></span></h2>
        </section>
        <section id="discover-and-tourop-banner-desktop">
            <div class="banner-container-gradient">
                <div class="banner-container">
                    <div class="banner-content-left reveal">
                        <p style="font-size: 14px;">
                            Navigate the map here in Albay with Lakbay Agapay. Searching for destinations has never been
                            made so easy before. Now with Lakbay Agapay, you can now explore different destinations of your go-to places here in
                            the province and experience the breathtaking beauty of Albay.
                        </p>
                        <div class="btn-explore">
                            <a href="#map"><button class="explore-more" style="font-size: 12px;"><i class="fa-solid fa-angles-down"></i> Explore More</button></a>
                        </div>
                    </div>
                    <div class="banner-content-right">
                        <h3 class="banner-content-title reveal">Suggested Places</h3>
                        <div class="pictures-featured">
                            <div class="picture-box">
                                <a href="{{ route('guest.discover.show',$rand1->id) }}"><img src="{{ asset($rand1->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                            <div class="picture-box">
                                <a href="{{ route('guest.discover.show',$rand2->id) }}"><img src="{{ asset($rand2->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                            <div class="picture-box">
                                <a href="{{ route('guest.discover.show',$rand3->id) }}"><img src="{{ asset($rand3->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{--  Mobile Mode  --}}
    <div class="mobile-map">
        <section id="discover-and-tourop-bg-mobile">
            <section id="discover-and-tourop-bg">
                <img src="{{ asset('img/map/map-mobile.jpg') }}">
                <h1 class="discover-and-tourop-title reveal">Map</h1>
                <h2 class="discover-and-tourop-subtitle reveal">#<span class="auto-type-mobile"></span></h2>
            </section>
        </section>
        <section id="discover-and-tourop-banner-mobile">
            <div class="banner-container-gradient">
                <div class="banner-container">
                    <div class="banner-content-left reveal">
                        <p style="font-size: 14px;">
                            Navigate the map here in Albay with Lakbay Agapay. Searching for destinations has never been
                            made so easy before. Now with Lakbay Agapay, you can now explore different destinations of your go-to places here in
                            the province and experience the breathtaking beauty of Albay.
                        </p>
                        <div class="btn-explore">
                            <a href="#map"><button class="explore-more" style="font-size: 12px;"><i class="fa-solid fa-angles-down"></i> Explore More</button></a>
                        </div>
                    </div>
                    <div class="banner-content-right">
                        <h3 class="banner-content-title reveal">Suggested Places</h3>
                        <div class="pictures-featured">
                            <div class="picture-box">
                                <a href="{{ route('guest.discover.show',$rand1->id) }}"><img src="{{ asset($rand1->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                            <div class="picture-box">
                                <a href="{{ route('guest.discover.show',$rand2->id) }}"><img src="{{ asset($rand2->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                            <div class="picture-box">
                                <a href="{{ route('guest.discover.show',$rand3->id) }}"><img src="{{ asset($rand3->dest_main_picture) }}" class="suggested-img reveal" ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="banner-container-gradient-map">
        <div class="banner-container">
            <div class="map-frame shadow" id="map">Loading Map</div>
        </div>
    </div>
    @foreach($destinations as $destination)
        <input class="dest_id" type="text" value="{{ $destination->id }}" hidden />
        <input class="dest_name" type="text" value="{{ $destination->dest_name }}" hidden />
        <input class="dest_city" type="text" value="{{ $destination->dest_city }}" hidden />
        <input class="dest_rate" type="text" value="{{ $destination->dest_rating_average }}" hidden />
        <input class="dest_lat" type="text" value="{{ $destination->dest_latitude }}" hidden />
        <input class="dest_long" type="text" value="{{ $destination->dest_longitude }}" hidden />
        <input class="dest_img" type="text" value="{{ $destination->dest_main_picture }}" hidden />
    @endforeach
    <input id="counter" type="text" value="{{ $destinations->count() }}" hidden />

@endsection

@push('specific-css-new')
    <style>
        #map{
            height: 93vh;
            margin-top: 14vh;
        }
        table{
            text-align: center;
        }
        .navigation .nav-items a{
            margin-right: 45px !important;
        }
        section img {
            height: 98%;
        }
        .map-frame {
             border-radius: 0;
        }
        .banner-container-gradient-map{
            z-index: 0;
            content: '';
            position: absolute;
            width: 100%;
            height: 50px;
            margin-top: 20px;
            background: linear-gradient(transparent, var(--main-bg-color));
        }
        .footer{
            display: none;
        }

        @media screen and (max-width:477px){
            .desktop-map{
                display: none;
            }

            #map{
                margin-top: 69vh;
                height: 93vh !important;
            }
        }
    </style>
@endpush

@push('scripts-guest-new')
    <script>
        $(document).ready(function() {
            const typed = new Typed(".auto-type-mobile", {
                strings: ["BrowseAlbay", "NavigateAlbay", "ExploreAlbay"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });

            $(".toast").toast('show');
            $('[data-toggle=tooltip]').show();
        });
    </script>
    <script>
        $(document).ready(function () {
            const typed = new Typed(".auto-type", {
                strings: ["BrowseAlbay", "NavigateAlbay", "ExploreAlbay"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });

            $(".toast").toast('show');
            $('[data-toggle=tooltip]').show();
        });

        $("#category").popover({html:true, sanitize : false});
        $("#category-mobile").popover({html:true, sanitize : false});

        //Show Destination Map
        function initialize() {
        //MAP VIEW
            //Map Settings
            let mapOptions = {
                center: {lat: 13.143986664725428, lng: 123.72595988123209},
                zoom: 10,
                mapId: "e3a69f21a8a07bc3",
            };
            //Displaying map to div
            let map = new google.maps.Map(document.getElementById("map"), mapOptions);

            //Creating Map Marker
            let counter = document.getElementById('counter').value;
            for(let i = 0; i < counter; i++){
                let dest_lat = document.getElementsByClassName('dest_lat')[i].value;
                let dest_long = document.getElementsByClassName('dest_long')[i].value;
                let dest_name = document.getElementsByClassName('dest_name')[i].value;
                let dest_city = document.getElementsByClassName('dest_city')[i].value;
                let dest_rate = document.getElementsByClassName('dest_rate')[i].value;
                let dest_img = document.getElementsByClassName('dest_img')[i].value;
                let img = "{{ asset(':img') }}"
                img = img.replace(':img', dest_img);

                let dest_id = document.getElementsByClassName('dest_id')[i].value;
                let url = '{!! route('guest.discover.show',':id') !!}'
                url = url.replace(':id', dest_id);
                //Marker Settings
                let markerOptions = {
                    position: {lat: parseFloat(dest_lat), lng: parseFloat(dest_long)},
                    map: map,
                    optimized: false, //Enables event
                    icon: {
                        url: '{{ asset('img/location.png') }}',
                        scaledSize: new google.maps.Size(38, 50),
                        anchor: new google.maps.Point(19.45, 51.5), //pinpoint location
                    },
                    title: "Click to view details",
                    animation: google.maps.Animation.BOUNCE,
                    draggable: false,
                };
                //Display Marker
                let marker = new google.maps.Marker(markerOptions);
                // marker.setLabel("yey"); //outside markerOptions

                //Marker Animation Stop
                setTimeout(() => {
                    marker.setAnimation(null);
                }, 2000);

                //Click!
                let infowindow = new google.maps.InfoWindow();
                let infowindow2 = new google.maps.InfoWindow();

                marker.addListener('click', function () {
                    infowindow.close();
                    infowindow2.open(map, marker);
                    infowindow2.setContent(`
                        <table style="width: 300px; max-height: 150px;">
                            <tr>
                                <td rowspan="4">
                                    <img class="ml-1 mr-1 rounded shadow" style="width: auto;height: auto; max-height: 150px; max-width:200px;" src="`+ img +`">
                                </td>
                                <td style="height: 10px"><h2 style="font-size: 15pt">`
                                    + dest_name +
                                `</h2></td>
                            </tr>
                            <tr>
                                <td style="height: 10px"><h3 style="font-size: 10pt">`
                                    + dest_city +
                                `</h3></td>
                            </tr>
                            <tr>
                                <td style="height: 10px">
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
                                    <div class="rating" style="display: inline-block;  margin-top: 2%; margin-left: -1%;">
                                        <progress class="rating-bg" value="`+ dest_rate +`"
                                                  max="5"></progress>
                                        <svg>
                                            <use xlink:href="#fivestars"/>
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="`+url+`" class='btn btn-primary col-10 mb-3 mt-2'>View</a>
                                </td>
                            </tr>
                        </table>
                    `);
                });
                marker.addListener('mouseover', function () {
                    infowindow2.close();
                    infowindow.open(map, marker);
                    infowindow.setContent(`
                        <table style="width: 300px; max-height: 150px;">
                            <tr><td colspan="2"><b style="background-color: #FFC107; color: black" class="p-1 rounded shadow" >click marker to pin</b></td></tr>
                            <tr>
                                <td rowspan="4">
                                    <img class="ml-1 mr-1 rounded shadow" style="width: auto;height: auto; max-height: 150px; max-width:200px;" src="`+ img +`">
                                </td>
                                <td style="height: 10px"><h2 style="font-size: 15pt">`
                        + dest_name +
                        `</h2></td>
                            </tr>
                            <tr>
                                <td style="height: 10px"><h3 style="font-size: 10pt">`
                        + dest_city +
                        `</h3></td>
                            </tr>
                            <tr>
                                <td style="height: 10px">
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
                                    <div class="rating" style="display: inline-block;  margin-top: 2%; margin-left: -1%;">
                                        <progress class="rating-bg" value="`+ dest_rate +`"
                                                  max="5"></progress>
                                        <svg>
                                            <use xlink:href="#fivestars"/>
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="`+url+`" class='btn btn-primary col-10 mb-3 mt-2'>View</a>
                                </td>
                            </tr>
                        </table>
                    `);
                });
                marker.addListener("mouseout", function () {
                    infowindow.close();
                });
            }
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbV7DVh7RNb9up1QQt0zFabQZdcDmzgM8&map_ids=e3a69f21a8a07bc3&callback=initialize&v=weekly"
        defer></script>
@endpush
