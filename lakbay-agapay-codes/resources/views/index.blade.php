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
    <section class="home">
        <div class="media-icons">
            <a href="https://www.facebook.com/profile.php?id=100086206800895"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/lakbayagapay/"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://twitter.com/LakbayAgapay"><i class="fa-brands fa-twitter"></i></a>
        </div>
        <div class="swiper bg-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('img/index/bg-1.jpg') }}">
                    <div class="text-content">
                        <h2 class="title">LAKBAY AGAPAY<span></span></h2>
                        <p>Explore the wonders of Albay with Lakbay Agapay — a guide for your next travels in the province.
                            With just a few clicks, you can now see the wondrous spots Albay has to offer.
                            Visit some never-before-seen places and be at awe with the province's hidden gems.</p>
                        <a href="{{ route('guest.login') }}">
                            <button class="log-in">
                                <span class="log-in-circle" aria-hidden="true">
                                    <span class="icon arrow"></span>
                                </span>
                                <span class="log-in-button-text">Join Us</span>
                            </button>
                        </a>

                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/index/bg-2.jpg') }}" alt="">
                    <div class="text-content">
                        <h2 class="title">EXPLORE <span>Albay...</span></h2>
                        <p>Explore the wonders of Albay with Lakbay Agapay — a guide for your next travels in the province.
                            With just a few clicks, you can now see the wondrous spots Albay has to offer.
                            Visit some never-before-seen places and be at awe with the province's hidden gems.</p>
                        <a href="{{ route('guest.login') }}">
                            <button class="log-in">
                                <span class="log-in-circle" aria-hidden="true">
                                    <span class="icon arrow"></span>
                                </span>
                                <span class="log-in-button-text">Join Us</span>
                            </button>
                        </a>
                    </div>
                </div>

                <div class="swiper-slide dark-layer">
                    <img src="{{ asset('img/index/bg-3.jpg') }}" alt="">
                    <div class="text-content">
                        <h2 class="title">Experience <span>Albay...</span></h2>
                        <p>Explore the wonders of Albay with Lakbay Agapay — a guide for your next travels in the province.
                            With just a few clicks, you can now see the wondrous spots Albay has to offer.
                            Visit some never-before-seen places and be at awe with the province's hidden gems.</p>
                        <a href="{{ route('guest.login') }}">
                            <button class="log-in">
                                <span class="log-in-circle" aria-hidden="true">
                                    <span class="icon arrow"></span>
                                </span>
                                <span class="log-in-button-text">Join Us</span>
                            </button>
                        </a>
                    </div>
                </div>

                <div class="swiper-slide dark-layer">
                    <img src="{{ asset('img/index/bg-4.jpg') }}" alt="">
                    <div class="text-content">
                        <h2 class="title">Establish <span>Albay...</span></h2>
                        <p>Explore the wonders of Albay with Lakbay Agapay — a guide for your next travels in the province.
                            With just a few clicks, you can now see the wondrous spots Albay has to offer.
                            Visit some never-before-seen places and be at awe with the province's hidden gems.</p>
                        <a href="{{ route('guest.login') }}">
                            <button class="log-in">
                                <span class="log-in-circle" aria-hidden="true">
                                    <span class="icon arrow"></span>
                                </span>
                                <span class="log-in-button-text">Join Us</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slider-thumbs">
            <div class="swiper-wrapper thumbs-container">
                <img src="{{ asset('img/index/bg-1.jpg') }}" class="swiper-slide" alt="">
                <img src="{{ asset('img/index/bg-2.jpg') }}" class="swiper-slide" alt="">
                <img src="{{ asset('img/index/bg-3.jpg') }}" class="swiper-slide" alt="">
                <img src="{{ asset('img/index/bg-4.jpg') }}" class="swiper-slide" alt="">
            </div>
        </div>
    </section>

    <section class="feature-section">
        <h2 style="font-size: 38px; margin-left: 12px;" class="feature-title reveal">FEATURING</h2>
        <p style="font-size: 14px; padding: 0 40px; text-align: center;" class="mb-5 feature-description reveal">
            Discover amazing and extraordinary places here in Albay with Lakbay Agapay.
        </p>
        <div class="feature-container">
            <div class="feature-wrapper owl-carousel">
                <div class="box-feature reveal">
                    <img src="{{ asset('img/index/feature-1.jpg') }}" class="feature-img">
                    <div class="feature-overlay">
                        <h5 class="feature-title-place">EMBARCADERO DE LEGAZPI</h5>
                        <p class="feature-place">Legazpi City, Albay</p>
                    </div>
                </div>
                <div class="box-feature reveal">
                    <img src="{{ asset('img/index/feature-2.jpg') }}" class="feature-img">
                    <div class="feature-overlay">
                        <h5 class="feature-title-place">QUITINDAY HILLS AND NATURE PARK</h5>
                        <p class="feature-place">Camalig, Albay</p>
                    </div>
                </div>
                <div class="box-feature reveal">
                    <img src="{{ asset('img/index/feature-3.jpg') }}" class="feature-img">
                    <div class="feature-overlay">
                        <h5 class="feature-title-place">MAYON VOLCANO</h5>
                        <p class="feature-place">Legazpi City, Albay</p>
                    </div>
                </div>
                <div class="box-feature reveal">
                    <img src="{{ asset('img/index/feature-4.jpg') }}" class="feature-img">
                    <div class="feature-overlay">
                        <h5 class="feature-title-place">JOVELLAR UNDERGROUND RIVER</h5>
                        <p class="feature-place">Jovellar, Albay</p>
                    </div>
                </div>
                <div class="box-feature reveal">
                    <img src="{{ asset('img/index/feature-5.jpg') }}" class="feature-img">
                    <div class="feature-overlay">
                        <h5 class="feature-title-place">CAGRARAY ECO PARK</h5>
                        <p class="feature-place">Bacacay, Albay</p>
                    </div>
                </div>
                <div class="box-feature reveal">
                    <img src="{{ asset('img/index/feature-6.jpg') }}" class="feature-img">
                    <div class="feature-overlay">
                        <h5 class="feature-title-place">HOYOP-HOYOPAN CAVE</h5>
                        <p class="feature-place">Camalig, Albay</p>
                    </div>
                </div>
                <div class="box-feature reveal">
                    <img src="{{ asset('img/index/feature-7.jpg') }}" class="feature-img">
                    <div class="feature-overlay">
                        <h5 class="feature-title-place">POTOTAN CAVE</h5>
                        <p class="feature-place">Rapu-Rapu, Albay</p>
                    </div>
                </div>
                <div class="box-feature reveal">
                    <img src="{{ asset('img/index/feature-8.jpg') }}" class="feature-img">
                    <div class="feature-overlay">
                        <h5 class="feature-title-place">TRINITY ISLANDS</h5>
                        <p class="feature-place">Oas, Albay</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="discover-and-tourop" class="section-p1">
        <h2 style="color: #17252a;" class="reveal">Discover Albay</h2>
        <p style="color: #17252a;" class="reveal">Discover amazing and extraordinary places here in Albay with Lakbay Agapay. Browse for destinations you've never been to and experience a life of beauty and wonders.</p>

        <div class="pro-container">
            @foreach($destinations as $dest)
                <div class="pro reveal">
                    <a href="{{ route('guest.discover.show',$dest->id)}}" class="hover-card-white">
                    <div class="box main-picture" style="background-size: cover; background-image: url('{{ asset($dest->dest_main_picture) }}');">
                        <div class="badge-package">
                            @php $count = 0; @endphp
                            <i class="fas fa-box-open mr-1"></i>
                            @foreach($lowestPackages as $lowest)
                                @if($dest->id == $lowest->destination_id)
                                    Lowest Package: Php {{ $lowest->FEE }}
                                    @php $count++; @endphp
                                @endif
                            @endforeach
                            @if($count==0)
                                No Package Available
                            @endif
                        </div>
                        <div class="badge-category" id="badgeCategory">
                            <i class="fas fa-dot-circle mr-1"></i>
                            {{ $dest->dest_category }}
                        </div>
                    </div>
                    <div class="des" style="text-align: start !important;">
                        <span style="color: #17252a;">{{ $dest->dest_city }}</span>
                        <h5 class="hover-label-white">{{$dest->dest_name}}
                            <br>
                            @if(($dest->dest_operating) == 1)
                                <h6 style="width: fit-content; background: darkred; color: #fff; border-radius: 10px; padding: 8px;">NONOPERATIONAL</h6>
                            @endif
                        </h5>
                        <div class="star">
                            <svg style="display:none;">
                                <defs>
                                    <symbol id="fivestars">
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(24)"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(48)"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(72)"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd"  transform="translate(96)"/>
                                    </symbol>
                                </defs>
                            </svg>
                            <div class="rating" style="display: inline-block;  margin-top: 2%; margin-left: -1%;">
                                <progress class="rating-bg" value="{{$dest->rate->avg('rating_rate')}}" max="5"></progress>
                                <svg><use xlink:href="#fivestars"/></svg>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>

        <a href="{{ route('guest.discover') }}">
            <button class="learn-more reveal">
                <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                <span class="button-text">See More</span>
            </button>
        </a>
    </section>

    {{--  For Mobile Devices  --}}
    <section id="discover-mobile">
        <h2 style="color: #17252a; font-size: 40px;" class="mt-5 reveal">Discover Albay</h2>
        <p style="color: #17252a; font-size: 15px; padding: 0 21px;" class="reveal">Discover amazing and extraordinary places here in Albay with Lakbay Agapay. Browse for destinations you've never been to and experience a life of beauty and wonders.</p>

        <div class="pro-container">
            @foreach($destinations as $dest)
                <div class="pro reveal">
                    <a href="{{ route('guest.discover.show',$dest->id)}}" class="hover-card-white">
                        <div class="box main-picture" style="background-size: cover; background-image: url('{{ asset($dest->dest_main_picture) }}');">
                            <div class="badge-package">
                                @php $count = 0; @endphp
                                <i class="fas fa-box-open mr-1"></i>
                                @foreach($lowestPackages as $lowest)
                                    @if($dest->id == $lowest->destination_id)
                                        Lowest Package: Php {{ $lowest->FEE }}
                                        @php $count++; @endphp
                                    @endif
                                @endforeach
                                @if($count==0)
                                    No Package Available
                                @endif
                            </div>
                            <div class="badge-category" id="badgeCategory">
                                <i class="fas fa-dot-circle mr-1"></i>
                                {{ $dest->dest_category }}
                            </div>
                        </div>
                        <div class="des" style="text-align: start !important;">
                            <span style="color: #17252a;">{{ $dest->dest_city }}</span>
                            <h5 class="hover-label-white">{{$dest->dest_name}}
                                <br>
                                @if(($dest->dest_operating) == 1)
                                    <h6 style="width: fit-content; background: darkred; color: #fff; border-radius: 10px; padding: 8px;">NONOPERATIONAL</h6>
                                @endif
                            </h5>
                            <div class="star">
                                <svg style="display:none;">
                                    <defs>
                                        <symbol id="fivestars">
                                            <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd"/>
                                            <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(24)"/>
                                            <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(48)"/>
                                            <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(72)"/>
                                            <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd"  transform="translate(96)"/>
                                        </symbol>
                                    </defs>
                                </svg>
                                <div class="rating" style="display: inline-block;  margin-top: 2%; margin-left: -1%;">
                                    <progress class="rating-bg" value="{{$dest->rate->avg('rating_rate')}}" max="5"></progress>
                                    <svg><use xlink:href="#fivestars"/></svg>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <a href="{{ route('guest.discover') }}">
            <button class="learn-more reveal">
                <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                <span class="button-text">See More</span>
            </button>
        </a>
    </section>

    <section id="explore-more" class="section-p1">
        <div class="space"></div>
        <h2 style="color: #17252a;" class="reveal">Explore Hidden Gems and Popular Places in Albay</h2>
        <p style="color: #17252a;" class="reveal">You can now also explore hidden gems and paradises with Lakbay Agapay and enjoy sceneries with some fun-filled activities that would surely make up your day.</p>
        <div class="space"></div>
        <div class="container-box">
            @foreach($famousTop as $ft)
                <div class="banner-box reveal" style="-webkit-filter: grayscale(100%); filter: grayscale(65%); background-size: cover; background-image: url('{{ asset($ft->dest_main_picture) }}');">
                    <span>{{ $ft->dest_city }}</span>
                    <h5>{{ $ft->dest_name }}</h5>
                    <a style="text-decoration: none;" class="btn btn-outline-warning" type="button" href = "guest/discover/{{$ft->id}}">Visit</a>
                </div>
            @endforeach
        </div>

        <section id="next-banner-block">
            @foreach($hiddenGem as $hg)
                <div class="mini-banner-box reveal" style="-webkit-filter: grayscale(100%); filter: grayscale(65%); background-size: cover; background-image: url('{{ asset($hg->dest_main_picture) }}');">
                    <span>{{ $hg->dest_city }}</span>
                    <h5>{{ $hg->dest_name }}</h5>
                    <a style="text-decoration: none;" class="btn btn-outline-warning" type="button" href = "guest/discover/{{$hg->id}}">Visit</a>
                </div>
            @endforeach
        </section>

        <a href="{{ route('guest.discover') }}">
            <button class="learn-more reveal">
                <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                <span class="button-text">See More</span>
            </button>
        </a>
    </section>

    <section id="tour-operator" class="section-p1 tour">
        <h2 style="color: #17252a;" class="reveal">Tour Operators</h2>
        <p style="color: #17252a;" class="reveal">Browse for various tour operators here in Albay with Lakbay Agapay. Searching for tour packages has never been made so easy before.</p>

        <div class="pro-container">
            @foreach($tour_operators as $tour)
                <div class='pro reveal' style="background-color: #17252A;">
                    <a style="text-decoration: none; color: white;" href = "{{ route('guest.tour_operator.show',$tour->id) }}" class="hover-card">
                        <div class="box main-picture"  style="background-size: 100% 100%; background-repeat: no-repeat; background-image: url('{{ asset($tour->operator_main_picture) }}' );">
                            <div class="badge-dot">
                                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="30px" height="30px"><polygon fill="#48A9DE" points="29.62,3 33.053,8.308 39.367,8.624 39.686,14.937 44.997,18.367 42.116,23.995 45,29.62 39.692,33.053 39.376,39.367 33.063,39.686 29.633,44.997 24.005,42.116 18.38,45 14.947,39.692 8.633,39.376 8.314,33.063 3.003,29.633 5.884,24.005 3,18.38 8.308,14.947 8.624,8.633 14.937,8.314 18.367,3.003 23.995,5.884"/><polygon fill="#fff" points="21.396,31.255 14.899,24.76 17.021,22.639 21.428,27.046 30.996,17.772 33.084,19.926"/></svg>
                                <div class="badge-content" style="opacity: 0;">
                                    <span class="ml-2">DOT Accredited</span>
                                </div>
                            </div>
                        </div>
                        <div class="des" style="text-align: start !important;">
                            <span style="color: white;">{{ $tour->operator_city }}</span>
                            <h5 class="hover-label">{{$tour->operator_company}}
                                <br>
                                @if(($tour->operator_operating) == 1)
                                    <h6 style="width: fit-content; background: darkred; color: #fff; border-radius: 10px; padding: 8px;">NONOPERATIONAL</h6>
                                @endif
                            </h5>
                        <div class="star">
                            <svg style="display:none;">
                                <defs>
                                    <symbol id="fivestars-tour">
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="#17252A" fill-rule="evenodd"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="#17252A" fill-rule="evenodd" transform="translate(24)"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="#17252A" fill-rule="evenodd" transform="translate(48)"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="#17252A" fill-rule="evenodd" transform="translate(72)"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="#17252A" fill-rule="evenodd"  transform="translate(96)"/>
                                    </symbol>
                                </defs>
                            </svg>
                            <div class="rating" style="display: inline-block;  margin-top: 2%; margin-left: -1%;">
                                <!--   <div class="rating-bg" style="width: 90%;"></div> -->
                                <progress class="rating-bg" value="{{$tour->rate->avg('rating_rate')}}" max="5"></progress>
                                <svg><use xlink:href="#fivestars-tour"/></svg>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>

        <a href="{{ route('guest.tour_operator') }}">
            <button class="learn-more reveal">
                <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                <span class="button-text">See More</span>
            </button>
        </a>
    </section>

    {{--  For Mobile Devices  --}}
    <section id="tour-operator-mobile" class="section-p1 tour">
        <h2 style="color: #17252a; font-size: 40px;" class="reveal">Tour Operators</h2>
        <p style="color: #17252a; font-size: 15px; padding: 0 21px;" class="reveal">Browse for various tour operators here in Albay with Lakbay Agapay. Searching for tour packages has never been made so easy before.</p>

        <div class="pro-container">
            @foreach($tour_operators as $tour)
                <div class='pro-tour reveal' style="background-color: #17252A;">
                    <a style="text-decoration: none; color: white;" href = "{{ route('guest.tour_operator.show',$tour->id) }}" class="hover-card">
                        <div class="box-tour main-picture"  style="background-size: 100% 100%; background-repeat: no-repeat; background-image: url('{{ asset($tour->operator_main_picture) }}' );">
                            <div class="badge-dot">
                                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="30px" height="30px"><polygon fill="#48A9DE" points="29.62,3 33.053,8.308 39.367,8.624 39.686,14.937 44.997,18.367 42.116,23.995 45,29.62 39.692,33.053 39.376,39.367 33.063,39.686 29.633,44.997 24.005,42.116 18.38,45 14.947,39.692 8.633,39.376 8.314,33.063 3.003,29.633 5.884,24.005 3,18.38 8.308,14.947 8.624,8.633 14.937,8.314 18.367,3.003 23.995,5.884"/><polygon fill="#fff" points="21.396,31.255 14.899,24.76 17.021,22.639 21.428,27.046 30.996,17.772 33.084,19.926"/></svg>
                                <div class="badge-content" style="opacity: 0;">
                                    <span class="ml-2">DOT Accredited</span>
                                </div>
                            </div>
                        </div>
                        <div class="des" style="text-align: start !important;">
                            <span style="color: white;">{{ $tour->operator_city }}</span>
                            <h5 class="hover-label">{{$tour->operator_company}}
                                <br>
                                @if(($tour->operator_operating) == 1)
                                    <h6 style="width: fit-content; background: darkred; color: #fff; border-radius: 10px; padding: 8px;">NONOPERATIONAL</h6>
                                @endif
                            </h5>
                        <div class="star">
                            <svg style="display:none;">
                                <defs>
                                    <symbol id="fivestars-tour">
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="#17252A" fill-rule="evenodd"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="#17252A" fill-rule="evenodd" transform="translate(24)"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="#17252A" fill-rule="evenodd" transform="translate(48)"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="#17252A" fill-rule="evenodd" transform="translate(72)"/>
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="#17252A" fill-rule="evenodd"  transform="translate(96)"/>
                                    </symbol>
                                </defs>
                            </svg>
                            <div class="rating" style="display: inline-block;  margin-top: 2%; margin-left: -1%;">
                                <progress class="rating-bg" value="{{$tour->rate->avg('rating_rate')}}" max="5"></progress>
                                <svg><use xlink:href="#fivestars-tour"/></svg>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>

        <a href="{{ route('guest.tour_operator') }}">
            <button class="learn-more reveal">
                <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                <span class="button-text">See More</span>
            </button>
        </a>
    </section>
@endsection

@push('specific-css-new')
    <style>
        h5 a:hover{
            color: #088178 !important;
        }
        .banner-box:hover{
            filter: none !important;
        }
        .mini-banner-box:hover{
            filter: none !important;
        }
        #discover-and-tourop .pro .des{
            text-align: center !important;
        }
        .pro-tour:hover .hover-label{
            color: #088178 !important;
        }
        .footer{
            margin-top: 40px;
        }
        .navigation .nav-items a {
            margin-right: 45px;
        }

        @media screen and (max-width:820px){
            .navigation .nav-items a {
                margin-right: 10px;
            }
        }
    </style>
@endpush

@push('scripts-guest-new')
    <script>
        const mySwiper = new Swiper('.swiper-slide', {
            autoplay: 4000,
            loop: true,
            speed: 2800,
            grabCursor: true
        });

        var x = window.matchMedia("(max-width: 477px)");
        checkMedia(x);

        function checkMedia(x) {
            if (x.matches) {
                $(document).ready(function () {
                    $(".owl-carousel").owlCarousel({
                        items: 2,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 1000,
                        autoplayHoverPause: true,
                        nav: false,
                        dots: false,
                        center: true,
                    });
                });
            } else {
                $(document).ready(function () {
                    $(".owl-carousel").owlCarousel({
                        items: 4,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 1000,
                        autoplayHoverPause: true,
                        nav: false,
                        dots: false,
                        center: true,
                    });
                });
            }
        }
    </script>
@endpush
