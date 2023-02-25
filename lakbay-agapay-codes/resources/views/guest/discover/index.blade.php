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
    <section id="discover-and-tourop-bg-desktop">
        <img src="{{ asset('img/discover/discover-bg.jpg') }}">
        <h1 class="discover-and-tourop-title reveal">Discover Albay</h1>
        <h2 class="discover-and-tourop-subtitle reveal">#<span class="auto-type"></span></h2>
    </section>
    <section id="discover-and-tourop-banner-desktop">
        <div class="banner-container-gradient">
            <div class="banner-container">
                <div class="banner-content-left reveal">
                    <p style="font-size: 14px;">
                        Discover amazing and extraordinary places here in Albay with Lakbay Agapay. Browse for destinations
                        you've never been to and experience a life of beauty and wonders. Equipped with features that could help
                        you in finding the most suitable place for you. With only a few scrolls and clicks, you can now explore
                        more of Albay's splendor.
                    </p>
                    <div class="btn-explore">
                        <a href="#discover-and-tourop"><button class="explore-more" style="font-size: 12px;"><i class="fa-solid fa-angles-down"></i> Explore More</button></a>
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

    {{--  Discover Desktop  --}}
    <section id="discover-and-tourop" class="d-section-p1">
        <h2 class="discover-and-tourop-section-title mt-5 reveal">Explore More Destinations</h2>
        <div class="table-top">
            <div class="filter">
                <form action="{{ route('guest.discover.filter') }}" style="flex-flow: unset !important;" class="form-inline" method="GET">
                    <select name="option" class="form-select mr-2" aria-label="options">
                        <option selected value="all" {{ $option == 'all' ? 'selected':'' }}>Recent</option>
                        <option value="name" {{ $option == 'name' ? 'selected':'' }}>Name</option>
                        <option value="rating" {{ $option == 'rating' ? 'selected':'' }}>Rating</option>
                        <option value="published" {{ $option == 'published' ? 'selected':'' }}>Published</option>
                        <option value="hidden_gem" {{ $option == 'hidden_gem' ? 'selected':'' }}>Hidden Gem</option>
                        <option value="date_opened" {{ $option == 'date_opened' ? 'selected':'' }}>Date Opened</option>
                        <option value="municipality" {{ $option == 'municipality' ? 'selected':'' }}>Municipality</option>
                        <option value="entrance_fee" {{ $option == 'entrance_fee' ? 'selected':'' }}>Entrance Fee</option>
                    </select>
                    <select name="order" class="form-select mr-2" aria-label="order">
                        <option selected value="asc" {{ $order == 'asc' ? 'selected':'' }}>Ascending</option>
                        <option value="desc" {{ $order == 'desc' ? 'selected':'' }}>Descending</option>
                    </select>
                    <button class="btn btn-outline-success" id="filter" data-toggle="tooltip" data-placement="top" title="Filter"><i class="fa-solid fa-filter"></i></button>
                    <button type="button" class="btn btn-success ml-2" id="category" style=".popover-header{ text-align: center; }"
                            data-container="body"
                            data-toggle="popover"
                            data-placement="top"
                            title="Categories"
                            data-content="
                                @foreach($categories as $category)
                                    <a href='/guest/search-destination?search={{ $category->dest_category }}' type='button' class='btn btn-outline-success' style='font-size:10px; border-radius: 10px; margin-bottom: 5px;'>{{ $category->dest_category }}</a>
                                @endforeach
                            ">
                        <i class="fa-solid fa-tag"></i>
                    </button>
                </form>
            </div>
            <div class="search">
                <form class="form-inline" action="{{ route('guest.discover.search') }}" method="GET">
                    <span class="text-danger mr-3">@error('search'){{ $message }}@enderror</span>
                    <input class="form-control mr-sm-2 search-btn" type="search" name="search" placeholder="Try 'Mayon'"
                           aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0 btn-search" data-toggle="tooltip" data-placement="top" title="Search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
        <div class="pro-container">
            @if(count($destinations))
                @foreach($destinations as $discover_item)
                    <div class='pro reveal'>
                        <a href="{{ route('guest.discover.show',$discover_item->id)}}" class="hover-card-white">
                            <div class="box main-picture" style="background-size: cover; background-image: url('{{ asset($discover_item->dest_main_picture) }}');">
                                <div class="badge-package">
                                    @php $count = 0; @endphp
                                    <i class="fas fa-box-open mr-1"></i>
                                    @foreach($lowestPackages as $lowest)
                                        @if($discover_item->id == $lowest->destination_id)
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
                                    {{ $discover_item->dest_category }}
                                </div>
                            </div>
                            <div class="des" style="text-align: start !important;">
                                <span style="color: #212529">{{ $discover_item->dest_city }}</span>
                                <h5 class="hover-label-white">{{$discover_item->dest_name}}
                                    <br>
                                    @if(($discover_item->dest_operating) == 1)
                                        <h6 style="width: fit-content; background: darkred; color: #fff; border-radius: 10px; padding: 8px;">NONOPERATIONAL</h6>
                                    @endif
                                </h5>
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
                                    <progress class="rating-bg" value="{{$discover_item->rate->avg('rating_rate')}}"
                                              max="5"></progress>
                                    <svg>
                                        <use xlink:href="#fivestars"/>
                                    </svg>
                                </div>
                                <br>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div style="width: 100%">
                    <svg style="width: 36%" class="animated" id="freepik_stories-search"
                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         viewBox="0 0 500 500" version="1.1" xmlns:svgjs="http://svgjs.com/svgjs">
                        <style>svg#freepik_stories-search:not(.animated) .animable {
                                opacity: 0;
                            }

                            svg#freepik_stories-search.animated #freepik--Background simple--inject-1--inject-1--inject-1--inject-116 {
                                animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                                animation-delay: 0s;
                            }

                            svg#freepik_stories-search.animated #freepik--Shadow--inject-1--inject-1--inject-1--inject-116 {
                                animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideDown;
                                animation-delay: 0s;
                            }

                            svg#freepik_stories-search.animated #freepik--Windows--inject-1--inject-1--inject-1--inject-116 {
                                animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomOut;
                                animation-delay: 0s;
                            }

                            svg#freepik_stories-search.animated #freepik--Plant--inject-1--inject-1--inject-1--inject-116 {
                                animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                                animation-delay: 0s;
                            }

                            svg#freepik_stories-search.animated #freepik--Character--inject-1--inject-1--inject-1--inject-116 {
                                animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideUp;
                                animation-delay: 0s;
                            }

                            @keyframes fadeIn {
                                0% {
                                    opacity: 0;
                                }
                                100% {
                                    opacity: 1;
                                }
                            }

                            @keyframes slideDown {
                                0% {
                                    opacity: 0;
                                    transform: translateY(-30px);
                                }
                                100% {
                                    opacity: 1;
                                    transform: translateY(0);
                                }
                            }

                            @keyframes zoomOut {
                                0% {
                                    opacity: 0;
                                    transform: scale(1.5);
                                }
                                100% {
                                    opacity: 1;
                                    transform: scale(1);
                                }
                            }

                            @keyframes slideUp {
                                0% {
                                    opacity: 0;
                                    transform: translateY(30px);
                                }
                                100% {
                                    opacity: 1;
                                    transform: inherit;
                                }
                            }        </style><!--Search-->
                        <g id="freepik--Background simple--inject-1--inject-1--inject-1--inject-116" class="animable"
                           style="transform-origin: 256.083px 225.155px;">
                            <path
                                d="M97,158.13c-15.77,21.2-25.91,52.35-18.22,78.44,13.14,44.59,68.9,47.95,107.09,53.11,26.32,3.56,52.49,24.25,75,37.09,30,17.12,78.26,44.13,112.86,26.59,28.68-14.53,44.1-49.68,52.9-78.84,13.79-45.66,15.12-100.74-14.9-140.52C370.87,80,299.39,89,240,98.24c-39.75,6.19-78.39,12.22-113.73,33.29A101.28,101.28,0,0,0,97,158.13Z"
                                style="fill: rgb(146, 227, 169); transform-origin: 256.083px 225.155px;"
                                id="elc5hsn4aoqhb" class="animable"></path>
                            <g id="eldqiusqqre7p">
                                <path
                                    d="M97,158.13c-15.77,21.2-25.91,52.35-18.22,78.44,13.14,44.59,68.9,47.95,107.09,53.11,26.32,3.56,52.49,24.25,75,37.09,30,17.12,78.26,44.13,112.86,26.59,28.68-14.53,44.1-49.68,52.9-78.84,13.79-45.66,15.12-100.74-14.9-140.52C370.87,80,299.39,89,240,98.24c-39.75,6.19-78.39,12.22-113.73,33.29A101.28,101.28,0,0,0,97,158.13Z"
                                    style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 256.083px 225.155px;"
                                    class="animable"></path>
                            </g>
                        </g>
                        <g id="freepik--Shadow--inject-1--inject-1--inject-1--inject-116" class="animable"
                           style="transform-origin: 254.94px 412.89px;">
                            <path
                                d="M50.94,412.89c0,3.56,91.31,6.45,204,6.45s204-2.89,204-6.45-91.31-6.45-203.95-6.45S50.94,409.33,50.94,412.89Z"
                                style="fill: rgb(146, 227, 169); transform-origin: 254.94px 412.89px;"
                                id="el0vbxmxsihjk" class="animable"></path>
                            <g id="elbwvqy5ogl3l">
                                <path
                                    d="M50.94,412.89c0,3.56,91.31,6.45,204,6.45s204-2.89,204-6.45-91.31-6.45-203.95-6.45S50.94,409.33,50.94,412.89Z"
                                    style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 254.94px 412.89px;"
                                    class="animable"></path>
                            </g>
                        </g>
                        <g id="freepik--Windows--inject-1--inject-1--inject-1--inject-116" class="animable"
                           style="transform-origin: 253.425px 218.005px;">
                            <rect x="96.81" y="93.4" width="181.15" height="229.78"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 187.385px 208.29px;"
                                  id="elii0ywwa2loh" class="animable"></rect>
                            <rect x="96.81" y="93.4" width="181.15" height="13.71"
                                  style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 187.385px 100.255px;"
                                  id="eljtnin0450jo" class="animable"></rect>
                            <rect x="101.97" y="253.66" width="30.62" height="64.99"
                                  style="fill: rgb(146, 227, 169); transform-origin: 117.28px 286.155px;"
                                  id="el6hvi35u561y" class="animable"></rect>
                            <g id="els87cwbu0n8">
                                <rect x="101.97" y="253.66" width="30.62" height="64.99"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 117.28px 286.155px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="135.36" y="253.66" width="30.62" height="64.99"
                                  style="fill: rgb(146, 227, 169); transform-origin: 150.67px 286.155px;"
                                  id="elwnimaqphdq" class="animable"></rect>
                            <g id="eltqz6gu382o">
                                <rect x="135.36" y="253.66" width="30.62" height="64.99"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 150.67px 286.155px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="170.84" y="253.66" width="30.62" height="64.99"
                                  style="fill: rgb(146, 227, 169); transform-origin: 186.15px 286.155px;"
                                  id="elfqdqk8c8u5v" class="animable"></rect>
                            <g id="el58y8wy5dssn">
                                <rect x="170.84" y="253.66" width="30.62" height="64.99"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 186.15px 286.155px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="206.31" y="253.66" width="30.62" height="64.99"
                                  style="fill: rgb(146, 227, 169); transform-origin: 221.62px 286.155px;"
                                  id="elztrxucznqhd" class="animable"></rect>
                            <g id="elh01zsb7wap">
                                <rect x="206.31" y="253.66" width="30.62" height="64.99"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 221.62px 286.155px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="242.65" y="253.66" width="30.62" height="64.99"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 257.96px 286.155px;"
                                  id="el7g7hl4qzsln" class="animable"></rect>
                            <rect x="101.98" y="98.82" width="170.8" height="15.75"
                                  style="fill: rgb(146, 227, 169); transform-origin: 187.38px 106.695px;"
                                  id="elhlosx3t6l7v" class="animable"></rect>
                            <g id="elwwvew1croqg">
                                <rect x="101.98" y="98.82" width="170.8" height="15.75"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 187.38px 106.695px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="105.05" y="101.88" width="165.33" height="6.97"
                                  style="fill: rgb(255, 255, 255); transform-origin: 187.715px 105.365px;"
                                  id="el42696boxg9g" class="animable"></rect>
                            <rect x="251.65" y="101.88" width="18.72" height="6.97"
                                  style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 261.01px 105.365px;"
                                  id="el32qzgogdp31" class="animable"></rect>
                            <path d="M178,128.69H143a1.35,1.35,0,0,1,0-2.7h35a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 160.5px 127.34px;" id="el0ch91stylfo"
                                  class="animable"></path>
                            <path d="M178,138.1H143a1.35,1.35,0,1,1,0-2.69h35a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 160.384px 136.755px;"
                                  id="elxxfedj9532" class="animable"></path>
                            <path d="M178,147.52H143a1.35,1.35,0,1,1,0-2.7h35a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 160.496px 146.17px;"
                                  id="elda6ewgyebmg" class="animable"></path>
                            <path d="M178,156.93H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 155.585px;"
                                  id="el66l42bud6on" class="animable"></path>
                            <path d="M178,166.35H105.36a1.35,1.35,0,0,1,0-2.7H178a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 165px;" id="el2pxe828l2y5"
                                  class="animable"></path>
                            <path d="M178,175.77H105.36a1.35,1.35,0,0,1,0-2.7H178a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 174.42px;" id="el5a9kjflg49o"
                                  class="animable"></path>
                            <path d="M178,185.18H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 183.835px;"
                                  id="elh6d6cctsm7s" class="animable"></path>
                            <path d="M178,193.55H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 192.205px;"
                                  id="ellbej3b9o219" class="animable"></path>
                            <path d="M178,203H105.36a1.35,1.35,0,0,1,0-2.7H178a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 201.65px;" id="elpbizh4bn3u"
                                  class="animable"></path>
                            <path d="M178,212.38H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 211.035px;" id="elj65cjkz7x2"
                                  class="animable"></path>
                            <path d="M178,221.8H105.36a1.35,1.35,0,0,1,0-2.7H178a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 220.45px;" id="elhyvu7zwy999"
                                  class="animable"></path>
                            <path d="M178,231.21H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 229.865px;"
                                  id="el96voedndg6e" class="animable"></path>
                            <path d="M178,240.63H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 239.285px;"
                                  id="elj79nl6ujkje" class="animable"></path>
                            <path d="M271.5,128.69H198.89a1.35,1.35,0,0,1,0-2.7H271.5a1.35,1.35,0,1,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 127.34px;"
                                  id="el7r132covg3o" class="animable"></path>
                            <path d="M271.5,138.1H198.89a1.35,1.35,0,1,1,0-2.69H271.5a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 136.755px;"
                                  id="elyuo71nzkew" class="animable"></path>
                            <path d="M271.5,147.52H198.89a1.35,1.35,0,1,1,0-2.7H271.5a1.35,1.35,0,1,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 146.17px;"
                                  id="eloctkcz5h4il" class="animable"></path>
                            <path d="M271.5,156.93H198.89a1.35,1.35,0,1,1,0-2.69H271.5a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 155.585px;"
                                  id="elqpkljd3lo8" class="animable"></path>
                            <path d="M271.5,166.35H198.89a1.35,1.35,0,0,1,0-2.7H271.5a1.35,1.35,0,1,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 165px;" id="elpm3g6mijsal"
                                  class="animable"></path>
                            <path d="M271.5,175.77H198.89a1.35,1.35,0,1,1,0-2.7H271.5a1.35,1.35,0,1,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 174.42px;"
                                  id="elgwlni0r6lzw" class="animable"></path>
                            <path d="M271.5,185.18H198.89a1.35,1.35,0,1,1,0-2.69H271.5a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 183.835px;"
                                  id="elvbqi99hom2p" class="animable"></path>
                            <rect x="198.81" y="191.51" width="74" height="51.61"
                                  style="fill: rgb(146, 227, 169); transform-origin: 235.81px 217.315px;"
                                  id="elohwmiihd1h" class="animable"></rect>
                            <g id="elmvh326g64q">
                                <rect x="198.81" y="191.51" width="74" height="51.61"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 235.81px 217.315px;"
                                      class="animable"></rect>
                            </g>
                            <path
                                d="M130.68,131.36a6.45,6.45,0,0,0,.32-1.94c0-2.41-2.44-2.55-4.85-2.55h-.6v-.57H136v.57c-2.72,0-3.68,1.73-4.56,4.32l-5.56,16.66c-.42,1.23-.77,2.15-2.08,2.15h-.11l-4.91-15.91-4.6,13.76c-.43,1.23-.78,2.15-2.09,2.15H112l-7.14-23.13h-2.51v-.57h9.19v.57h-2.61l5.3,18.25h.21l4-12.17-1.87-6.08h-2.51v-.57h9.19v.57h-2.62l5.31,18.25h.21Z"
                                style="fill: rgb(38, 50, 56); transform-origin: 119.175px 138.15px;" id="elppzgvufz44o"
                                class="animable"></path>
                            <rect x="223.25" y="120.4" width="75.42" height="202.31"
                                  style="fill: rgb(146, 227, 169); transform-origin: 260.96px 221.555px;"
                                  id="ele849v7qkbtr" class="animable"></rect>
                            <g id="el2dqrvwym20r">
                                <rect x="223.25" y="120.4" width="75.42" height="202.31"
                                      style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 260.96px 221.555px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="228.89" y="112.83" width="181.15" height="229.78"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 319.465px 227.72px;"
                                  id="el4kdiqmasgno" class="animable"></rect>
                            <rect x="228.89" y="112.83" width="181.15" height="13.71"
                                  style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 319.465px 119.685px;"
                                  id="el7tiv47thewd" class="animable"></rect>
                            <rect x="289.91" y="145.37" width="63.61" height="118.91"
                                  style="fill: rgb(146, 227, 169); transform-origin: 321.715px 204.825px;"
                                  id="eljpgvklsybeh" class="animable"></rect>
                            <g id="el4g6oocd5d1k">
                                <rect x="289.91" y="145.37" width="63.61" height="118.91"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 321.715px 204.825px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="234.07" y="273.08" width="170.8" height="64.99"
                                  style="fill: rgb(146, 227, 169); transform-origin: 319.47px 305.575px;"
                                  id="elnbiplbm9j9" class="animable"></rect>
                            <g id="el861nik73tb4">
                                <rect x="234.07" y="273.08" width="170.8" height="64.99"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 319.47px 305.575px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="234.07" y="118.25" width="170.8" height="15.75"
                                  style="fill: rgb(146, 227, 169); transform-origin: 319.47px 126.125px;"
                                  id="elhshv09l71i7" class="animable"></rect>
                            <g id="el60ou105zt">
                                <rect x="234.07" y="118.25" width="170.8" height="15.75"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 319.47px 126.125px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="237.14" y="121.31" width="165.33" height="6.97"
                                  style="fill: rgb(255, 255, 255); transform-origin: 319.805px 124.795px;"
                                  id="elj44m0s5y64" class="animable"></rect>
                            <rect x="383.74" y="121.31" width="18.72" height="6.97"
                                  style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 393.1px 124.795px;"
                                  id="elg5fdv3kluak" class="animable"></rect>
                            <path d="M279.22,148.11H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 146.765px;"
                                  id="elzmd92wcgvu" class="animable"></path>
                            <path d="M279.22,157.53H235.63a1.35,1.35,0,0,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 156.18px;"
                                  id="el0ceo1p4j7nuq" class="animable"></path>
                            <path d="M279.22,166.94H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 165.595px;"
                                  id="elark51oyx5qb" class="animable"></path>
                            <path d="M279.22,176.36H235.63a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 175.01px;" id="elod8uvfuyp1"
                                  class="animable"></path>
                            <path d="M279.22,185.77H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 184.425px;"
                                  id="elkh1eu78bzrt" class="animable"></path>
                            <path d="M279.22,195.19H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 193.845px;"
                                  id="elbb3vkd9r5r9" class="animable"></path>
                            <path d="M279.22,204.61H235.63a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 203.26px;" id="elga82qtkilk"
                                  class="animable"></path>
                            <path d="M279.22,213H235.63a1.35,1.35,0,0,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 211.65px;"
                                  id="elxb7jfrewvum" class="animable"></path>
                            <path d="M279.22,222.39H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 221.045px;"
                                  id="elvxmiqjnwzl" class="animable"></path>
                            <path d="M279.22,231.81H235.63a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 230.46px;"
                                  id="elktif3r7ge0j" class="animable"></path>
                            <path d="M279.22,241.22H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 239.875px;"
                                  id="eli7sp6uakaa" class="animable"></path>
                            <path d="M279.22,250.64H235.63a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 249.29px;"
                                  id="elxc63ikkainf" class="animable"></path>
                            <path d="M279.22,260.05H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 258.705px;"
                                  id="elnw6micjrcwg" class="animable"></path>
                            <path d="M279.22,269.47H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 268.125px;"
                                  id="elxycj2z5sj5" class="animable"></path>
                            <path d="M404.54,148.11H361a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 146.765px;"
                                  id="eldipooqoyqy" class="animable"></path>
                            <path d="M404.54,157.53H361a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.791px 156.18px;"
                                  id="elvpnb2eby0hb" class="animable"></path>
                            <path d="M404.54,166.94H361a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 165.595px;"
                                  id="elhrcxdakl87" class="animable"></path>
                            <path d="M404.54,176.36H361a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 175.01px;"
                                  id="elld7nsbg5jjk" class="animable"></path>
                            <path d="M404.54,185.77H361a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 184.425px;"
                                  id="elkez7tzbalji" class="animable"></path>
                            <path d="M404.54,195.19H361a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 193.845px;"
                                  id="elw3ew2tc20rq" class="animable"></path>
                            <path d="M404.54,204.61H361a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 203.26px;"
                                  id="elz3cy75ewout" class="animable"></path>
                            <rect x="359.91" y="210.93" width="44.99" height="51.61"
                                  style="fill: rgb(146, 227, 169); transform-origin: 382.405px 236.735px;"
                                  id="eldq97kbwbkz8" class="animable"></rect>
                            <g id="el0rd5q247oofp">
                                <rect x="359.91" y="210.93" width="44.99" height="51.61"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 382.405px 236.735px;"
                                      class="animable"></rect>
                            </g>
                        </g>
                        <g id="freepik--Plant--inject-1--inject-1--inject-1--inject-116" class="animable"
                           style="transform-origin: 411.221px 343.111px;">
                            <path
                                d="M427.33,304.39c-.27-10.16.52-27.5-8.4-34.64-7.83-6.27-13.92,2.24-16.11,9.1-5.33,16.65-4.76,79.31-3.38,91.93,0,0-1.36-12.64-11.29-7.22s5,33.87,5,33.87-11.74-8.58-17.16-1.36,6.78,15.36,6.78,15.36-11.29-3.16-11.29,0,3.61,5.87,14,7.23h56s9-5,7.23-10.39S437.38,406,437.38,406s14.45-17.61,13.54-25.29-19.42,1.35-19.42,1.35,14.46-36.58,11.75-52.84c-2.14-12.81-12.08-4-17.49.88A147.51,147.51,0,0,0,427.33,304.39Z"
                                style="fill: rgb(146, 227, 169); transform-origin: 411.221px 343.111px;"
                                id="elpym64k5kfrq" class="animable"></path>
                            <g id="el5qqtbkh5v3">
                                <path
                                    d="M427.33,304.39c-.27-10.16.52-27.5-8.4-34.64-7.83-6.27-13.92,2.24-16.11,9.1-5.33,16.65-4.76,79.31-3.38,91.93,0,0-1.36-12.64-11.29-7.22s5,33.87,5,33.87-11.74-8.58-17.16-1.36,6.78,15.36,6.78,15.36-11.29-3.16-11.29,0,3.61,5.87,14,7.23h56s9-5,7.23-10.39S437.38,406,437.38,406s14.45-17.61,13.54-25.29-19.42,1.35-19.42,1.35,14.46-36.58,11.75-52.84c-2.14-12.81-12.08-4-17.49.88A147.51,147.51,0,0,0,427.33,304.39Z"
                                    style="opacity: 0.1; transform-origin: 411.221px 343.111px;"
                                    class="animable"></path>
                            </g>
                            <line x1="409.32" y1="417.45" x2="413.44" y2="294"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 411.38px 355.725px;"
                                  id="elmldbkba6gdd" class="animable"></line>
                            <line x1="411.63" y1="366.27" x2="432.86" y2="346.39"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 422.245px 356.33px;"
                                  id="elxfunl03mfcs" class="animable"></line>
                            <line x1="421.57" y1="357.23" x2="426.08" y2="344.59"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 423.825px 350.91px;"
                                  id="ela7gsc9e89u" class="animable"></line>
                            <line x1="394.02" y1="381.62" x2="409.97" y2="398.63"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 401.995px 390.125px;"
                                  id="elptpd6uvdcbf" class="animable"></line>
                            <line x1="437.38" y1="391.56" x2="410.28" y2="405.56"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 423.83px 398.56px;"
                                  id="el4zzr9uqy7la" class="animable"></line>
                            <line x1="423.72" y1="398.46" x2="432.86" y2="399.24"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 428.29px 398.85px;"
                                  id="elgp8aeur0i06" class="animable"></line>
                        </g>
                        <g id="freepik--Character--inject-1--inject-1--inject-1--inject-116" class="animable"
                           style="transform-origin: 224.599px 290.387px;">
                            <path
                                d="M223.59,419.14c0,3.72-35.45,6.74-79.17,6.74s-79.18-3-79.18-6.74,35.45-6.74,79.18-6.74S223.59,415.42,223.59,419.14Z"
                                style="fill: rgb(38, 50, 56); transform-origin: 144.415px 419.14px;" id="elwuf64jx8gig"
                                class="animable"></path>
                            <path
                                d="M105,295.35s6.12-3.1,8.78-.44,1.59,31.12,2.39,40.16A85.7,85.7,0,0,0,119.14,351s-8.78-1.59-15.43-5C103.71,346,97.86,317.6,105,295.35Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 110.297px 322.416px;"
                                id="el054679g4lcvj" class="animable"></path>
                            <path
                                d="M226.85,359.8a3.19,3.19,0,0,1-1.41-6.05l28.91-13,22.44-25.81a3.19,3.19,0,1,1,4.88,4.11L258.8,345.37a3.14,3.14,0,0,1-1,.81l-29.52,13.29A3.06,3.06,0,0,1,226.85,359.8Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 253.042px 336.803px;"
                                id="elisdqrs0ro4a" class="animable"></path>
                            <line x1="246.62" y1="348.53" x2="249.79" y2="347.09"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 248.205px 347.81px;"
                                  id="el1818vjio8qa" class="animable"></line>
                            <line x1="232" y1="355.18" x2="244.53" y2="349.48"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 238.265px 352.33px;"
                                  id="el9s4enwor8j5" class="animable"></line>
                            <line x1="274.85" y1="323.37" x2="266.5" y2="332.81"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 270.675px 328.09px;"
                                  id="eluxppgr0uq4" class="animable"></line>
                            <line x1="265.15" y1="334.16" x2="263.26" y2="336.31"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 264.205px 335.235px;"
                                  id="el0glksbfj0qwa" class="animable"></line>
                            <g id="el1f115kf4x4t">
                                <circle cx="204.5" cy="362.99" r="27.84"
                                        style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 204.5px 362.99px; transform: rotate(-76.6608deg);"
                                        class="animable"></circle>
                            </g>
                            <path
                                d="M134.33,262.14s4,9.38,4.84,11.21,1.64,2.33,1.45,2.91-2.23,1.25-2.23,1.25a16.11,16.11,0,0,1-1.45,8.42c-2,4-5.9,6.09-6.28,8.6a46.18,46.18,0,0,0-.1,7.26l-5.9-4.84s1.64-4.74.19-8.22a13.23,13.23,0,0,0-6.19-6.57,16.18,16.18,0,0,1-6.86-9.77c-.87-4.65,1.83-9.58,5.41-13.06s10.64-2.8,11.42-2.51-1.94-2,.48-2.52,3.87,3,4,3.58.87-2.51,1.65-.48S134.33,262.14,134.33,262.14Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 126.142px 278.019px;"
                                id="elqk8hhyisxo" class="animable"></path>
                            <g style="clip-path: url(&quot;#freepik--clip-path--inject-1--inject-1--inject-1--inject-116&quot;); transform-origin: 120.67px 278.06px;"
                               id="el8f4s0aa1q1o" class="animable">
                                <g id="elu0heu64ss8">
                                    <path
                                        d="M127.12,299a16.12,16.12,0,0,0-.23-2c-.39-1.76,2-7.24,2.74-13.69s-4.31-15.46-4.31-15.46l-3.7-10.73a9.55,9.55,0,0,0-4.41,2.26c-3.58,3.48-6.28,8.41-5.41,13.06a16.18,16.18,0,0,0,6.86,9.77,13.23,13.23,0,0,1,6.19,6.57c1.45,3.48-.19,8.22-.19,8.22Z"
                                        style="fill: rgb(146, 227, 169); opacity: 0.5; mix-blend-mode: multiply; transform-origin: 120.67px 278.06px;"
                                        class="animable"></path>
                                </g>
                            </g>
                            <path
                                d="M134.33,262.14s4,9.38,4.84,11.21,1.64,2.33,1.45,2.91-2.23,1.25-2.23,1.25a16.11,16.11,0,0,1-1.45,8.42c-2,4-5.9,6.09-6.28,8.6a46.18,46.18,0,0,0-.1,7.26l-5.9-4.84s1.64-4.74.19-8.22a13.23,13.23,0,0,0-6.19-6.57,16.18,16.18,0,0,1-6.86-9.77c-.87-4.65,1.83-9.58,5.41-13.06s10.64-2.8,11.42-2.51-1.94-2,.48-2.52,3.87,3,4,3.58.87-2.51,1.65-.48S134.33,262.14,134.33,262.14Z"
                                style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 126.142px 278.019px;"
                                id="elfbzukjmgxgl" class="animable"></path>
                            <path d="M134.71,267.13s-1.75-.48-2.33,1a2.54,2.54,0,0,0-.09,2.22"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 133.394px 268.703px;"
                                  id="el8a1fcs8h8ic" class="animable"></path>
                            <path d="M136.75,281.87s-1.74.87-2.81-.29"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 135.345px 281.882px;"
                                  id="el5zc3262ukzp" class="animable"></path>
                            <line x1="133.34" y1="273.76" x2="125.28" y2="277.25"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 129.31px 275.505px;"
                                  id="elu6yfsgt745a" class="animable"></line>
                            <path
                                d="M121.91,281.49a8.5,8.5,0,0,0-1.44,5.46c.24,3.3.16,7.8-1.53,7.4s.8-5.47.8-7.56a14.34,14.34,0,0,0-1.08-4.63"
                                style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 120.131px 287.932px;"
                                id="elosdnh4mw4t" class="animable"></path>
                            <line x1="139.22" y1="271.22" x2="137.32" y2="272.04"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 138.27px 271.63px;"
                                  id="elacctbj7kgca" class="animable"></line>
                            <path
                                d="M136.11,273.1c.25.85.25,1.6,0,1.67s-.65-.56-.9-1.41-.24-1.6,0-1.68S135.87,272.24,136.11,273.1Z"
                                style="fill: rgb(38, 50, 56); transform-origin: 135.662px 273.224px;" id="el69rdd7iqns"
                                class="animable"></path>
                            <path
                                d="M137.12,273.1c.67,2,.5,3.85-.38,4.15s-2.14-1.09-2.81-3.08-.5-3.86.38-4.16S136.45,271.1,137.12,273.1Z"
                                style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 135.525px 273.63px;"
                                id="el8jwaxkds0r5" class="animable"></path>
                            <path d="M123.76,280.85s-1.59-1.92-.16-1.76a2.54,2.54,0,0,1,1.92,1.76"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 124.262px 279.965px;"
                                  id="elgsw6vdnlip6" class="animable"></path>
                            <polygon points="168.47 313.68 162.86 317.65 163.73 322.29 170.12 319.78 168.47 313.68"
                                     style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 166.49px 317.985px;"
                                     id="elzifburbgqrp" class="animable"></polygon>
                            <path
                                d="M163.44,316.49l2.52,9.38S149,333.61,145.65,336s-6,1.74-6,1.74l-2.22-10.84s2.41,1.16,7.54-1.06S163.44,316.49,163.44,316.49Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 151.695px 327.155px;"
                                id="elk2f06iy2bze" class="animable"></path>
                            <path
                                d="M171.77,340.9a1.43,1.43,0,0,1-1.28-1.36l-2.24-37.11a1.44,1.44,0,1,1,2.87-.13l2.24,37.1a1.44,1.44,0,0,1-1.37,1.51Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 170.801px 320.867px;"
                                id="el26ncv0f81z4" class="animable"></path>
                            <path d="M167.5,312.8a1.44,1.44,0,0,1-.17-2.86l5.61-.68a1.44,1.44,0,1,1,.35,2.85l-5.61.68Z"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 170.393px 311.016px;"
                                  id="ellt76kh81ihb" class="animable"></path>
                            <path
                                d="M167.79,315.7a1.44,1.44,0,0,1-.17-2.86l5.61-.68a1.45,1.45,0,0,1,1.6,1.26,1.43,1.43,0,0,1-1.25,1.59l-5.61.68Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 170.626px 313.926px;"
                                id="elswo9ga28zh" class="animable"></path>
                            <path d="M168.1,318.34a1.38,1.38,0,0,1-.16-2.75l5.37-.65a1.38,1.38,0,1,1,.33,2.74l-5.37.65Z"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 170.799px 316.634px;"
                                  id="elkmnq4adk3b" class="animable"></path>
                            <path
                                d="M169,320.87a1.11,1.11,0,0,1-1-1.12,1.25,1.25,0,0,1,.85-1.42l3.8-.61c.54-.07,1,.42,1.08,1.12a1.23,1.23,0,0,1-.85,1.42l-3.79.6Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 170.867px 319.292px;"
                                id="eljrh4ckupool" class="animable"></path>
                            <path
                                d="M166.94,316.3a1.12,1.12,0,0,1-1.05,1.05,1.25,1.25,0,0,1-1.49-.74l-.88-3.74c-.12-.53.33-1.05,1-1.17a1.26,1.26,0,0,1,1.48.74l.89,3.75S166.93,316.26,166.94,316.3Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 165.22px 314.527px;"
                                id="el766bf0y4frj" class="animable"></path>
                            <path
                                d="M122.53,294.05s6.87,4.16,10.06,9.38,5.9,13,7.45,19.83,2.8,24.66,3.77,28.34a23.69,23.69,0,0,0,2.13,5.61,46.66,46.66,0,0,1-17.51,2.9c-9.48-.39-10.93-2.71-10.93-2.71s-3.19-21.08-2.9-37.82S122.53,294.05,122.53,294.05Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 130.261px 327.089px;"
                                id="eljxjzb72w3rc" class="animable"></path>
                            <g style="clip-path: url(&quot;#freepik--clip-path-2--inject-1--inject-1--inject-1--inject-116&quot;); transform-origin: 124.256px 324.565px;"
                               id="el47sd772rwx1" class="animable">
                                <g id="elgqack70h6bh">
                                    <path
                                        d="M118.48,313s-1,1.57-.2-2.54a31,31,0,0,1,3.13-8.22l4.69,5.28,2.94.2-.78,1.37,5.67,3.52-2.69-3.17.19-4.84L126.89,306s-2.94-5.28-3.72-7c-.52-1.18,1.22-2.18,2.44-2.71a36,36,0,0,0-3.08-2.15s-7.64,8.8-7.93,25.53c-.23,13.27,1.73,29.26,2.55,35.32l15-.83Z"
                                        style="fill: rgb(146, 227, 169); opacity: 0.5; mix-blend-mode: multiply; transform-origin: 124.256px 324.565px;"
                                        class="animable"></path>
                                </g>
                            </g>
                            <path
                                d="M122.53,294.05s6.87,4.16,10.06,9.38,5.9,13,7.45,19.83,2.8,24.66,3.77,28.34a23.69,23.69,0,0,0,2.13,5.61,46.66,46.66,0,0,1-17.51,2.9c-9.48-.39-10.93-2.71-10.93-2.71s-3.19-21.08-2.9-37.82S122.53,294.05,122.53,294.05Z"
                                style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 130.261px 327.089px;"
                                id="elxlbx7uyj5sr" class="animable"></path>
                            <polyline points="120.5 297.44 127.66 306.04 131.43 304.59 131.24 309.43 136.94 316.3"
                                      style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 128.72px 306.87px;"
                                      id="elsvlpvu17vbs" class="animable"></polyline>
                            <path d="M116.1,315.67s.8,8,3.19,9.9"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 117.695px 320.62px;"
                                  id="el74ox876eepe" class="animable"></path>
                            <path d="M116.58,324.3s1,3,3.51,4"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 118.335px 326.3px;"
                                  id="elfvwshn8ek3n" class="animable"></path>
                            <polyline points="137.34 319.98 133.19 321.58 133.83 323.34 137.66 321.9"
                                      style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 135.425px 321.66px;"
                                      id="eltb4omlo47s" class="animable"></polyline>
                            <path
                                d="M165.33,350.11a1.44,1.44,0,0,1-1.42-1.22l-5.18-33.64a1.44,1.44,0,0,1,2.85-.43l5.18,33.64a1.45,1.45,0,0,1-1.21,1.64Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 162.745px 331.853px;"
                                id="elmvijyh0sj3" class="animable"></path>
                            <path
                                d="M134.33,262.14s1.16-2.71.39-4.74-1.55,1.06-1.65.48-1.54-4.06-4-3.58.29,2.81-.48,2.52-7.84-1-11.42,2.51-6.28,8.41-5.41,13.06a16.18,16.18,0,0,0,6.86,9.77,13.6,13.6,0,0,1,4.62,3.87,19,19,0,0,0,2.83-2.81,3.37,3.37,0,0,1-3-.48c-1.55-1.07-2.32-4.16-.38-5.71S126.5,279,126.5,279c2,1.07,1.25-1.74.48-3s.29-2.62.58-4.45-2.22-2.52-1.93-4.36S134.33,262.14,134.33,262.14Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 123.29px 270.142px;"
                                id="elsm4sx4tdk3" class="animable"></path>
                            <path d="M129.67,263.44s-3.51-1.76-5.75,1-1.75,7.35-3.51,10.06a5.75,5.75,0,0,1-4,2.88"
                                  style="fill: none; stroke: rgb(255, 255, 255); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 123.04px 270.134px;"
                                  id="elbhmo9b1nkbk" class="animable"></path>
                            <path d="M114.34,272.55a4.07,4.07,0,0,0,4.47-3.52c.8-4,5.27-9.74,9.75-9.9s4.15,3,4.15,3"
                                  style="fill: none; stroke: rgb(255, 255, 255); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 123.528px 265.849px;"
                                  id="eln7sk5lqw53" class="animable"></path>
                            <path
                                d="M153,328.19l2.8-1.84s2.42-4.45,2.61-4.74,6.1-3.19,6.58-2.8a2.28,2.28,0,0,1,.77,1.93c-.19.49-.87,1-.87,1.46s.78,4.15.78,5.12-4,2.61-5.61,3.1-3.77.48-4.26.87l-1.35,1.06Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 159.385px 325.562px;"
                                id="el7k0gt53mclk" class="animable"></path>
                            <path
                                d="M120.5,308.66s-2.51.67-1.64,7.73,7.93,30.85,10.44,33.76,27-13.35,27-13.35l-3-9.29s-16.54,6.48-17.89,6.77-5.23-20.79-6.58-23.4"
                                style="fill: rgb(255, 255, 255); transform-origin: 137.488px 329.579px;"
                                id="elgdxip3npnn" class="animable"></path>
                            <g style="clip-path: url(&quot;#freepik--clip-path-3--inject-1--inject-1--inject-1--inject-116&quot;); transform-origin: 137.457px 330.529px;"
                               id="ely01hjy9444a" class="animable">
                                <g id="elduxs3d1pqci">
                                    <path
                                        d="M155.85,335.45c-5.09,1.61-16.87,5.28-18.4,5.12-2-.19-2.54-1.37-3.72-2.93s-2.93,4.69-4.5,5.28-.39-7,.2-8.61-1.37.79-1.37.79-3.91-8-5.87-13.5a78.23,78.23,0,0,1-2.93-11l-.44,1.08a16.53,16.53,0,0,0,0,4.67c.87,7.06,7.93,30.85,10.44,33.76s27-13.35,27-13.35Z"
                                        style="fill: rgb(146, 227, 169); opacity: 0.5; mix-blend-mode: multiply; transform-origin: 137.457px 330.529px;"
                                        class="animable"></path>
                                </g>
                            </g>
                            <path
                                d="M120.5,308.66s-2.51.67-1.64,7.73,7.93,30.85,10.44,33.76,27-13.35,27-13.35l-3-9.29s-16.54,6.48-17.89,6.77-5.23-20.79-6.58-23.4"
                                style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 137.488px 329.579px;"
                                id="ele66abvtyca8" class="animable"></path>
                            <path d="M135.4,334.28a8.67,8.67,0,0,0-3.81,5.67"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 133.495px 337.115px;"
                                  id="elvm325g0oa3r" class="animable"></path>
                            <path d="M131.75,336.43a7.09,7.09,0,0,0-2.08,5.12"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 130.71px 338.99px;"
                                  id="elb6cbo9pskxk" class="animable"></path>
                            <path
                                d="M106.82,344.29s-2.66-8.87-2.31-27.31,1.42-20.21.53-21.63-17,8.07-29,21.9C68.4,326.09,58.64,339.18,58,359.8c-.53,16.49,7.31,29.82,12.23,33.51,8.51,6.38,20.13,5.94,21.37,5.94H210.36s7.62-2.66,9.39-9.57,7.8-26.6-4.78-50.18c-8.26-15.47-23.05-32.09-25.54-30.85s-11.79,19-24.46,30.14C153,349.32,130.22,357.05,106.82,344.29Z"
                                style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 140.363px 347.233px;"
                                id="el04rswuxdma2t" class="animable"></path>
                            <path
                                d="M215,339.5c-1.77-3.3-3.83-6.65-6-9.87-6.94,2.39-24.34,9.53-34,23.79-8.29,12.24-2.78,31.66,14.5,45.83h20.87s7.62-2.66,9.39-9.58S227.55,363.08,215,339.5Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 196.984px 364.44px;"
                                id="elunuh8o1vdoi" class="animable"></path>
                            <path d="M218.81,376.81q-.28,2.6-.83,5.33"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 218.395px 379.475px;"
                                  id="eln17rzed9xzn" class="animable"></path>
                            <path d="M212.86,342.51s7.19,12.39,6.27,30.46"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 216.036px 357.74px;"
                                  id="elbm0dngm43b" class="animable"></path>
                            <path
                                d="M104,396.73V379c-9.25-3-15.22-6.56-20.79-9.9-8-4.79-13.6-17.7-9.84-26.06,3.45-7.72,13-11.17,18.08-7.72a175.22,175.22,0,0,0,15.34,9s-2.66-8.87-2.31-27.31,1.42-20.21.53-21.63-17,8.07-29,21.9C68.4,326.09,58.64,339.18,58,359.8c-.53,16.49,7.31,29.82,12.23,33.51,8.51,6.38,20.13,5.94,21.37,5.94H104c0-.91,0-1.76,0-2.52Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 82.3822px 347.248px;"
                                id="elp12ikindoks" class="animable"></path>
                            <path d="M61.77,363.27a49.9,49.9,0,0,0,.7,6.51"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 62.12px 366.525px;"
                                  id="elgyna4dentp7" class="animable"></path>
                            <path d="M90.36,308.74c-2.88,2.58-7.18,5.61-9.85,8.7-7.65,8.84-18.1,21.47-18.76,42.09"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 76.055px 334.135px;"
                                  id="elxuvwxc6u6mr" class="animable"></path>
                            <path
                                d="M131.64,397.12c0,9.75-15,10.64-33.6,10.64s-33.6-.36-33.6-10.64c0-14.2,15-28,33.6-28S131.64,382.92,131.64,397.12Z"
                                style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 98.04px 388.44px;"
                                id="elik43t68ntad" class="animable"></path>
                            <path
                                d="M98,369.11c-17.17,0-31.31,11.82-33.34,24.83,2,8.19,16.17,8.5,33.34,8.5s31.27-.76,33.33-8.56C129.31,380.89,115.18,369.11,98,369.11Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 97.995px 385.775px;"
                                id="elstb8th6tg7b" class="animable"></path>
                            <path
                                d="M218.51,398.16c0,8.83-13.62,9.64-30.42,9.64s-30.43-.32-30.43-9.64c0-12.85,13.62-25.37,30.43-25.37S218.51,385.31,218.51,398.16Z"
                                style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 188.085px 390.295px;"
                                id="el0h2xmm05txxr" class="animable"></path>
                            <path
                                d="M188.09,372.79c-15.55,0-28.36,10.71-30.19,22.5,1.83,7.41,14.64,7.69,30.19,7.69s28.31-.69,30.18-7.75C216.4,383.47,203.61,372.79,188.09,372.79Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 188.085px 387.885px;"
                                id="elmu1ca473e5b" class="animable"></path>
                            <path
                                d="M306.54,293a4.79,4.79,0,0,1-2.81-6.16l13.5-36.09a4.79,4.79,0,1,1,9,3.35l-13.5,36.09A4.79,4.79,0,0,1,306.54,293Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 314.98px 270.468px;"
                                id="el5k19pafavsl" class="animable"></path>
                            <line x1="322.08" y1="257.25" x2="314.5" y2="277.17"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 318.29px 267.21px;"
                                  id="elkf78hanxncn" class="animable"></line>
                            <path
                                d="M286,348a8.51,8.51,0,0,1-5-10.95l19.27-51.53a8.51,8.51,0,0,1,15.95,6L296.91,343A8.51,8.51,0,0,1,286,348Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 298.612px 314.267px;"
                                id="elhk1n1c0jpt" class="animable"></path>
                            <path
                                d="M357.53,158.18a51.86,51.86,0,1,0,30.41,66.74A51.87,51.87,0,0,0,357.53,158.18Zm-33.19,88.74a42.88,42.88,0,1,1,55.19-25.14A42.89,42.89,0,0,1,324.34,246.92Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 339.364px 206.755px;"
                                id="el4cziv0vbont" class="animable"></path>
                            <path d="M304.59,191a38.11,38.11,0,0,1,21.48-20"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 315.33px 181px;"
                                  id="elml7ruq6tj9l" class="animable"></path>
                            <path d="M301.16,206.88a38,38,0,0,1,1.74-11.47"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 302.03px 201.145px;"
                                  id="elprr3j25jgw" class="animable"></path>
                            <path d="M290.2,217.46a50.32,50.32,0,0,1,93.71-34.1"
                                  style="fill: none; stroke: rgb(255, 255, 255); stroke-miterlimit: 10; transform-origin: 336.482px 186.962px;"
                                  id="elis041pcp9ra" class="animable"></path>
                            <path d="M389.33,200.76a50.32,50.32,0,0,1-96,26.39"
                                  style="fill: none; stroke: rgb(255, 255, 255); stroke-miterlimit: 10; transform-origin: 341.516px 228.975px;"
                                  id="eloftweb70y8h" class="animable"></path>
                            <path d="M385.93,187.71a50.21,50.21,0,0,1,2.91,9.87"
                                  style="fill: none; stroke: rgb(255, 255, 255); stroke-miterlimit: 10; transform-origin: 387.385px 192.645px;"
                                  id="elrltr371gb" class="animable"></path>
                            <circle cx="138" cy="369.12" r="14.43"
                                    style="fill: rgb(38, 50, 56); transform-origin: 138px 369.12px;" id="elypmhqij02v"
                                    class="animable"></circle>
                            <circle cx="138" cy="369.12" r="12.18"
                                    style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 138px 369.12px;"
                                    id="el233ttyiyfn1" class="animable"></circle>
                            <path
                                d="M134.3,372.72a.58.58,0,0,1,0-.81l3.3-3.3a.58.58,0,0,1,.81,0,.57.57,0,0,1,0,.82l-3.29,3.29A.57.57,0,0,1,134.3,372.72Z"
                                style="fill: rgb(38, 50, 56); transform-origin: 136.36px 370.67px;" id="el7zp2vv0vkt"
                                class="animable"></path>
                            <path
                                d="M129.28,377.74a1,1,0,0,1,0-1.45l4.7-4.7a1,1,0,0,1,1.46,0,1,1,0,0,1,0,1.45l-4.7,4.7A1,1,0,0,1,129.28,377.74Z"
                                style="fill: rgb(38, 50, 56); transform-origin: 132.36px 374.665px;" id="eld664lbg4xo7"
                                class="animable"></path>
                            <path d="M146.66,369.32a6.27,6.27,0,1,0-8.86,0A6.27,6.27,0,0,0,146.66,369.32Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 142.23px 364.883px;" id="elo32ez74uaq"
                                  class="animable"></path>
                            <path d="M145.46,368.11a4.56,4.56,0,1,0-6.46,0A4.56,4.56,0,0,0,145.46,368.11Z"
                                  style="fill: rgb(255, 255, 255); transform-origin: 142.23px 364.891px;"
                                  id="el3y9247e028c" class="animable"></path>
                            <path
                                d="M317,317.66a4.79,4.79,0,0,1-4.79,4.79H278.44a4.79,4.79,0,1,1,0-9.57h33.77A4.79,4.79,0,0,1,317,317.66Z"
                                style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 295.216px 317.665px;"
                                id="elbzan0hx4ckt" class="animable"></path>
                            <circle cx="296.79" cy="318.31" r="2.66"
                                    style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 296.79px 318.31px;"
                                    id="elocxasyfwly" class="animable"></circle>
                            <circle cx="256.36" cy="343.05" r="6.48"
                                    style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 256.36px 343.05px;"
                                    id="el57e2hjcmfon" class="animable"></circle>
                            <path d="M258.79,343.05a2.43,2.43,0,1,0-2.43,2.42A2.43,2.43,0,0,0,258.79,343.05Z"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 256.36px 343.04px;"
                                  id="elbib2di610h" class="animable"></path>
                            <circle cx="278.44" cy="317.78" r="6.48"
                                    style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 278.44px 317.78px;"
                                    id="ely908852pli" class="animable"></circle>
                            <circle cx="278.44" cy="317.78" r="2.5"
                                    style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 278.44px 317.78px;"
                                    id="el52ve0i4nx99" class="animable"></circle>
                        </g>
                        <defs>
                            <filter id="active" height="200%">
                                <feMorphology in="SourceAlpha" result="DILATED" operator="dilate"
                                              radius="2"></feMorphology>
                                <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
                                <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                                <feMerge>
                                    <feMergeNode in="OUTLINE"></feMergeNode>
                                    <feMergeNode in="SourceGraphic"></feMergeNode>
                                </feMerge>
                            </filter>
                            <filter id="hover" height="200%">
                                <feMorphology in="SourceAlpha" result="DILATED" operator="dilate"
                                              radius="2"></feMorphology>
                                <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
                                <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                                <feMerge>
                                    <feMergeNode in="OUTLINE"></feMergeNode>
                                    <feMergeNode in="SourceGraphic"></feMergeNode>
                                </feMerge>
                                <feColorMatrix type="matrix"
                                               values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></feColorMatrix>
                            </filter>
                        </defs>
                        <defs>
                            <clipPath id="freepik--clip-path--inject-1--inject-1--inject-1--inject-116">
                                <path
                                    d="M134.33,262.14s4,9.38,4.84,11.21,1.64,2.33,1.45,2.91-2.23,1.25-2.23,1.25a16.11,16.11,0,0,1-1.45,8.42c-2,4-5.9,6.09-6.28,8.6a46.18,46.18,0,0,0-.1,7.26l-5.9-4.84s1.64-4.74.19-8.22a13.23,13.23,0,0,0-6.19-6.57,16.18,16.18,0,0,1-6.86-9.77c-.87-4.65,1.83-9.58,5.41-13.06s10.64-2.8,11.42-2.51-1.94-2,.48-2.52,3.87,3,4,3.58.87-2.51,1.65-.48S134.33,262.14,134.33,262.14Z"
                                    style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round;stroke-width:0.75px"></path>
                            </clipPath>
                            <clipPath id="freepik--clip-path-2--inject-1--inject-1--inject-1--inject-116">
                                <path
                                    d="M122.53,294.05s6.87,4.16,10.06,9.38,5.9,13,7.45,19.83,2.8,24.66,3.77,28.34a23.69,23.69,0,0,0,2.13,5.61,46.66,46.66,0,0,1-17.51,2.9c-9.48-.39-10.93-2.71-10.93-2.71s-3.19-21.08-2.9-37.82S122.53,294.05,122.53,294.05Z"
                                    style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round;stroke-width:0.75px"></path>
                            </clipPath>
                            <clipPath id="freepik--clip-path-3--inject-1--inject-1--inject-1--inject-116">
                                <path
                                    d="M120.5,308.66s-2.51.67-1.64,7.73,7.93,30.85,10.44,33.76,27-13.35,27-13.35l-3-9.29s-16.54,6.48-17.89,6.77-5.23-20.79-6.58-23.4"
                                    style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round;stroke-width:0.75px"></path>
                            </clipPath>
                        </defs>
                    </svg>
                    <h3 class="mt-1">Oops...No results found.</h3>
                    <p>Please try another search or filter</p>
                </div>
            @endif
        </div>
    </section>

    {{--  Discover Mobile  --}}

    <section id="discover-and-tourop-bg-mobile">
        <section id="discover-and-tourop-bg">
            <img src="{{ asset('img/discover/discover-bg-mobile.jpg') }}">
            <h1 class="discover-and-tourop-title reveal">Discover Albay</h1>
            <h2 class="discover-and-tourop-subtitle reveal">#<span class="auto-type-mobile"></span></h2>
        </section>
    </section>
    <section id="discover-and-tourop-banner-mobile">
        <div class="banner-container-gradient">
            <div class="banner-container">
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
                <div class="banner-content-left reveal">
                    <p class="p-banner">
                        Discover amazing and extraordinary places here in Albay with Lakbay Agapay. Browse for destinations
                        you've never been to and experience a life of beauty and wonders. Equipped with features that could help
                        you in finding the most suitable place for you. With only a few scrolls and clicks, you can now explore
                        more of Albay's splendor.
                    </p>
                    <div class="btn-explore">
                        <a href="#discover-item-mobile"><button class="explore-more"><i class="fa-solid fa-angles-down"></i> Explore More</button></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section id="discover-item-mobile" class="d-section-p1">
        <h2 class="discover-and-tourop-section-title reveal">Explore More Destinations</h2>
        <div class="table-top">
            <div class="filter">
                <form style="flex-flow: unset !important;" class="form-inline"
                      action="{{ route('guest.discover.filter') }}" method="GET">
                    <select name="option" class="form-select mr-2" aria-label="options">
                        <option selected value="all" {{ $option == 'all' ? 'selected':'' }}>Recent</option>
                        <option value="name" {{ $option == 'name' ? 'selected':'' }}>Name</option>
                        <option value="rating" {{ $option == 'rating' ? 'selected':'' }}>Rating</option>
                        <option value="published" {{ $option == 'published' ? 'selected':'' }}>Published</option>
                        <option value="hidden_gem" {{ $option == 'hidden_gem' ? 'selected':'' }}>Hidden Gem</option>
                        <option value="date_opened" {{ $option == 'date_opened' ? 'selected':'' }}>Date Opened</option>
                        <option value="municipality" {{ $option == 'municipality' ? 'selected':'' }}>Municipality</option>
                        <option value="entrance_fee" {{ $option == 'entrance_fee' ? 'selected':'' }}>Entrance Fee</option>
                    </select>
                    <select name="order" class="form-select mr-2" aria-label="order">
                        <option selected value="asc" {{ $order == 'asc' ? 'selected':'' }}>Ascending</option>
                        <option value="desc" {{ $order == 'desc' ? 'selected':'' }}>Descending</option>
                    </select>
                    <button class="btn btn-outline-success" id="filter" data-toggle="tooltip" data-placement="top" title="Filter"><i class="fa-solid fa-filter"></i></button>
                    <button type="button" class="btn btn-success ml-2" id="category-mobile" style=".popover-header{ text-align: center; }"
                            data-container="body"
                            data-toggle="popover"
                            data-placement="top"
                            title="Categories"
                            data-content="
                                @foreach($categories as $category)
                                    <a href='/guest/search-destination?search={{ $category->dest_category }}' type='button' class='btn btn-outline-success' style='font-size:10px; border-radius: 10px; margin-bottom: 5px;'>{{ $category->dest_category }}</a>
                                @endforeach
                            ">
                        <i class="fa-solid fa-tag"></i>
                    </button>
                </form>
            </div>
            <div class="search">
                <form class="form-inline" action="{{ route('guest.discover.search') }}" method="GET">
                    <div style="width: 100%;">
                        <span class="text-danger mr-3">@error('search'){{ $message }}@enderror</span>
                    </div>
                    <div class="search-buttons">
                        <input class="form-control mr-sm-2 search-btn" type="search" name="search" placeholder="Try 'Mayon'"
                               aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0 btn-search" type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="pro-container">
            @if(count($destinations))
                @foreach($destinations as $discover_item)
                    <div class='pro reveal'>
                        <a style="text-decoration: none" href="{{ route('guest.discover.show',$discover_item->id) }}" class="hover-card-white">
                            <div class="box main-picture" style="background-size: 100% 100%; background-repeat: no-repeat;  background-image: url('{{ asset($discover_item->dest_main_picture) }}');">
                                <div class="badge-package">
                                    @php $count = 0; @endphp
                                    <i class="fas fa-box-open mr-1"></i>
                                    @foreach($lowestPackages as $lowest)
                                        @if($discover_item->id == $lowest->destination_id)
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
                                    {{ $discover_item->dest_category }}
                                </div>
                            </div>
                            <div class="des" style="text-align: start;">
                                <span style="color: #212529">{{ $discover_item->dest_city }}</span>
                                <h5 class="hover-label-white">{{$discover_item->dest_name}}</h5>
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
                                    <progress class="rating-bg" value="{{$discover_item->rate->avg('rating_rate')}}"
                                              max="5"></progress>
                                    <svg>
                                        <use xlink:href="#fivestars"/>
                                    </svg>
                                </div>
                                <br>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div style="width: 100%">
                    <svg style="width: 36%" class="animated not-found" id="freepik_stories-search"
                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         viewBox="0 0 500 500" version="1.1" xmlns:svgjs="http://svgjs.com/svgjs">
                        <style>svg#freepik_stories-search:not(.animated) .animable {
                                opacity: 0;
                            }

                            svg#freepik_stories-search.animated #freepik--Background simple--inject-1--inject-1--inject-1--inject-116 {
                                animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                                animation-delay: 0s;
                            }

                            svg#freepik_stories-search.animated #freepik--Shadow--inject-1--inject-1--inject-1--inject-116 {
                                animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideDown;
                                animation-delay: 0s;
                            }

                            svg#freepik_stories-search.animated #freepik--Windows--inject-1--inject-1--inject-1--inject-116 {
                                animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomOut;
                                animation-delay: 0s;
                            }

                            svg#freepik_stories-search.animated #freepik--Plant--inject-1--inject-1--inject-1--inject-116 {
                                animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                                animation-delay: 0s;
                            }

                            svg#freepik_stories-search.animated #freepik--Character--inject-1--inject-1--inject-1--inject-116 {
                                animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideUp;
                                animation-delay: 0s;
                            }

                            @keyframes fadeIn {
                                0% {
                                    opacity: 0;
                                }
                                100% {
                                    opacity: 1;
                                }
                            }

                            @keyframes slideDown {
                                0% {
                                    opacity: 0;
                                    transform: translateY(-30px);
                                }
                                100% {
                                    opacity: 1;
                                    transform: translateY(0);
                                }
                            }

                            @keyframes zoomOut {
                                0% {
                                    opacity: 0;
                                    transform: scale(1.5);
                                }
                                100% {
                                    opacity: 1;
                                    transform: scale(1);
                                }
                            }

                            @keyframes slideUp {
                                0% {
                                    opacity: 0;
                                    transform: translateY(30px);
                                }
                                100% {
                                    opacity: 1;
                                    transform: inherit;
                                }
                            }        </style><!--Search-->
                        <g id="freepik--Background simple--inject-1--inject-1--inject-1--inject-116" class="animable"
                           style="transform-origin: 256.083px 225.155px;">
                            <path
                                d="M97,158.13c-15.77,21.2-25.91,52.35-18.22,78.44,13.14,44.59,68.9,47.95,107.09,53.11,26.32,3.56,52.49,24.25,75,37.09,30,17.12,78.26,44.13,112.86,26.59,28.68-14.53,44.1-49.68,52.9-78.84,13.79-45.66,15.12-100.74-14.9-140.52C370.87,80,299.39,89,240,98.24c-39.75,6.19-78.39,12.22-113.73,33.29A101.28,101.28,0,0,0,97,158.13Z"
                                style="fill: rgb(146, 227, 169); transform-origin: 256.083px 225.155px;"
                                id="elc5hsn4aoqhb" class="animable"></path>
                            <g id="eldqiusqqre7p">
                                <path
                                    d="M97,158.13c-15.77,21.2-25.91,52.35-18.22,78.44,13.14,44.59,68.9,47.95,107.09,53.11,26.32,3.56,52.49,24.25,75,37.09,30,17.12,78.26,44.13,112.86,26.59,28.68-14.53,44.1-49.68,52.9-78.84,13.79-45.66,15.12-100.74-14.9-140.52C370.87,80,299.39,89,240,98.24c-39.75,6.19-78.39,12.22-113.73,33.29A101.28,101.28,0,0,0,97,158.13Z"
                                    style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 256.083px 225.155px;"
                                    class="animable"></path>
                            </g>
                        </g>
                        <g id="freepik--Shadow--inject-1--inject-1--inject-1--inject-116" class="animable"
                           style="transform-origin: 254.94px 412.89px;">
                            <path
                                d="M50.94,412.89c0,3.56,91.31,6.45,204,6.45s204-2.89,204-6.45-91.31-6.45-203.95-6.45S50.94,409.33,50.94,412.89Z"
                                style="fill: rgb(146, 227, 169); transform-origin: 254.94px 412.89px;"
                                id="el0vbxmxsihjk" class="animable"></path>
                            <g id="elbwvqy5ogl3l">
                                <path
                                    d="M50.94,412.89c0,3.56,91.31,6.45,204,6.45s204-2.89,204-6.45-91.31-6.45-203.95-6.45S50.94,409.33,50.94,412.89Z"
                                    style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 254.94px 412.89px;"
                                    class="animable"></path>
                            </g>
                        </g>
                        <g id="freepik--Windows--inject-1--inject-1--inject-1--inject-116" class="animable"
                           style="transform-origin: 253.425px 218.005px;">
                            <rect x="96.81" y="93.4" width="181.15" height="229.78"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 187.385px 208.29px;"
                                  id="elii0ywwa2loh" class="animable"></rect>
                            <rect x="96.81" y="93.4" width="181.15" height="13.71"
                                  style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 187.385px 100.255px;"
                                  id="eljtnin0450jo" class="animable"></rect>
                            <rect x="101.97" y="253.66" width="30.62" height="64.99"
                                  style="fill: rgb(146, 227, 169); transform-origin: 117.28px 286.155px;"
                                  id="el6hvi35u561y" class="animable"></rect>
                            <g id="els87cwbu0n8">
                                <rect x="101.97" y="253.66" width="30.62" height="64.99"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 117.28px 286.155px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="135.36" y="253.66" width="30.62" height="64.99"
                                  style="fill: rgb(146, 227, 169); transform-origin: 150.67px 286.155px;"
                                  id="elwnimaqphdq" class="animable"></rect>
                            <g id="eltqz6gu382o">
                                <rect x="135.36" y="253.66" width="30.62" height="64.99"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 150.67px 286.155px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="170.84" y="253.66" width="30.62" height="64.99"
                                  style="fill: rgb(146, 227, 169); transform-origin: 186.15px 286.155px;"
                                  id="elfqdqk8c8u5v" class="animable"></rect>
                            <g id="el58y8wy5dssn">
                                <rect x="170.84" y="253.66" width="30.62" height="64.99"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 186.15px 286.155px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="206.31" y="253.66" width="30.62" height="64.99"
                                  style="fill: rgb(146, 227, 169); transform-origin: 221.62px 286.155px;"
                                  id="elztrxucznqhd" class="animable"></rect>
                            <g id="elh01zsb7wap">
                                <rect x="206.31" y="253.66" width="30.62" height="64.99"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 221.62px 286.155px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="242.65" y="253.66" width="30.62" height="64.99"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 257.96px 286.155px;"
                                  id="el7g7hl4qzsln" class="animable"></rect>
                            <rect x="101.98" y="98.82" width="170.8" height="15.75"
                                  style="fill: rgb(146, 227, 169); transform-origin: 187.38px 106.695px;"
                                  id="elhlosx3t6l7v" class="animable"></rect>
                            <g id="elwwvew1croqg">
                                <rect x="101.98" y="98.82" width="170.8" height="15.75"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 187.38px 106.695px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="105.05" y="101.88" width="165.33" height="6.97"
                                  style="fill: rgb(255, 255, 255); transform-origin: 187.715px 105.365px;"
                                  id="el42696boxg9g" class="animable"></rect>
                            <rect x="251.65" y="101.88" width="18.72" height="6.97"
                                  style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 261.01px 105.365px;"
                                  id="el32qzgogdp31" class="animable"></rect>
                            <path d="M178,128.69H143a1.35,1.35,0,0,1,0-2.7h35a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 160.5px 127.34px;" id="el0ch91stylfo"
                                  class="animable"></path>
                            <path d="M178,138.1H143a1.35,1.35,0,1,1,0-2.69h35a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 160.384px 136.755px;"
                                  id="elxxfedj9532" class="animable"></path>
                            <path d="M178,147.52H143a1.35,1.35,0,1,1,0-2.7h35a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 160.496px 146.17px;"
                                  id="elda6ewgyebmg" class="animable"></path>
                            <path d="M178,156.93H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 155.585px;"
                                  id="el66l42bud6on" class="animable"></path>
                            <path d="M178,166.35H105.36a1.35,1.35,0,0,1,0-2.7H178a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 165px;" id="el2pxe828l2y5"
                                  class="animable"></path>
                            <path d="M178,175.77H105.36a1.35,1.35,0,0,1,0-2.7H178a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 174.42px;" id="el5a9kjflg49o"
                                  class="animable"></path>
                            <path d="M178,185.18H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 183.835px;"
                                  id="elh6d6cctsm7s" class="animable"></path>
                            <path d="M178,193.55H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 192.205px;"
                                  id="ellbej3b9o219" class="animable"></path>
                            <path d="M178,203H105.36a1.35,1.35,0,0,1,0-2.7H178a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 201.65px;" id="elpbizh4bn3u"
                                  class="animable"></path>
                            <path d="M178,212.38H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 211.035px;" id="elj65cjkz7x2"
                                  class="animable"></path>
                            <path d="M178,221.8H105.36a1.35,1.35,0,0,1,0-2.7H178a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 220.45px;" id="elhyvu7zwy999"
                                  class="animable"></path>
                            <path d="M178,231.21H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 229.865px;"
                                  id="el96voedndg6e" class="animable"></path>
                            <path d="M178,240.63H105.36a1.35,1.35,0,0,1,0-2.69H178a1.35,1.35,0,0,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 141.68px 239.285px;"
                                  id="elj79nl6ujkje" class="animable"></path>
                            <path d="M271.5,128.69H198.89a1.35,1.35,0,0,1,0-2.7H271.5a1.35,1.35,0,1,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 127.34px;"
                                  id="el7r132covg3o" class="animable"></path>
                            <path d="M271.5,138.1H198.89a1.35,1.35,0,1,1,0-2.69H271.5a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 136.755px;"
                                  id="elyuo71nzkew" class="animable"></path>
                            <path d="M271.5,147.52H198.89a1.35,1.35,0,1,1,0-2.7H271.5a1.35,1.35,0,1,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 146.17px;"
                                  id="eloctkcz5h4il" class="animable"></path>
                            <path d="M271.5,156.93H198.89a1.35,1.35,0,1,1,0-2.69H271.5a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 155.585px;"
                                  id="elqpkljd3lo8" class="animable"></path>
                            <path d="M271.5,166.35H198.89a1.35,1.35,0,0,1,0-2.7H271.5a1.35,1.35,0,1,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 165px;" id="elpm3g6mijsal"
                                  class="animable"></path>
                            <path d="M271.5,175.77H198.89a1.35,1.35,0,1,1,0-2.7H271.5a1.35,1.35,0,1,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 174.42px;"
                                  id="elgwlni0r6lzw" class="animable"></path>
                            <path d="M271.5,185.18H198.89a1.35,1.35,0,1,1,0-2.69H271.5a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 235.195px 183.835px;"
                                  id="elvbqi99hom2p" class="animable"></path>
                            <rect x="198.81" y="191.51" width="74" height="51.61"
                                  style="fill: rgb(146, 227, 169); transform-origin: 235.81px 217.315px;"
                                  id="elohwmiihd1h" class="animable"></rect>
                            <g id="elmvh326g64q">
                                <rect x="198.81" y="191.51" width="74" height="51.61"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 235.81px 217.315px;"
                                      class="animable"></rect>
                            </g>
                            <path
                                d="M130.68,131.36a6.45,6.45,0,0,0,.32-1.94c0-2.41-2.44-2.55-4.85-2.55h-.6v-.57H136v.57c-2.72,0-3.68,1.73-4.56,4.32l-5.56,16.66c-.42,1.23-.77,2.15-2.08,2.15h-.11l-4.91-15.91-4.6,13.76c-.43,1.23-.78,2.15-2.09,2.15H112l-7.14-23.13h-2.51v-.57h9.19v.57h-2.61l5.3,18.25h.21l4-12.17-1.87-6.08h-2.51v-.57h9.19v.57h-2.62l5.31,18.25h.21Z"
                                style="fill: rgb(38, 50, 56); transform-origin: 119.175px 138.15px;" id="elppzgvufz44o"
                                class="animable"></path>
                            <rect x="223.25" y="120.4" width="75.42" height="202.31"
                                  style="fill: rgb(146, 227, 169); transform-origin: 260.96px 221.555px;"
                                  id="ele849v7qkbtr" class="animable"></rect>
                            <g id="el2dqrvwym20r">
                                <rect x="223.25" y="120.4" width="75.42" height="202.31"
                                      style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 260.96px 221.555px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="228.89" y="112.83" width="181.15" height="229.78"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 319.465px 227.72px;"
                                  id="el4kdiqmasgno" class="animable"></rect>
                            <rect x="228.89" y="112.83" width="181.15" height="13.71"
                                  style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 319.465px 119.685px;"
                                  id="el7tiv47thewd" class="animable"></rect>
                            <rect x="289.91" y="145.37" width="63.61" height="118.91"
                                  style="fill: rgb(146, 227, 169); transform-origin: 321.715px 204.825px;"
                                  id="eljpgvklsybeh" class="animable"></rect>
                            <g id="el4g6oocd5d1k">
                                <rect x="289.91" y="145.37" width="63.61" height="118.91"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 321.715px 204.825px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="234.07" y="273.08" width="170.8" height="64.99"
                                  style="fill: rgb(146, 227, 169); transform-origin: 319.47px 305.575px;"
                                  id="elnbiplbm9j9" class="animable"></rect>
                            <g id="el861nik73tb4">
                                <rect x="234.07" y="273.08" width="170.8" height="64.99"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 319.47px 305.575px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="234.07" y="118.25" width="170.8" height="15.75"
                                  style="fill: rgb(146, 227, 169); transform-origin: 319.47px 126.125px;"
                                  id="elhshv09l71i7" class="animable"></rect>
                            <g id="el60ou105zt">
                                <rect x="234.07" y="118.25" width="170.8" height="15.75"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 319.47px 126.125px;"
                                      class="animable"></rect>
                            </g>
                            <rect x="237.14" y="121.31" width="165.33" height="6.97"
                                  style="fill: rgb(255, 255, 255); transform-origin: 319.805px 124.795px;"
                                  id="elj44m0s5y64" class="animable"></rect>
                            <rect x="383.74" y="121.31" width="18.72" height="6.97"
                                  style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 393.1px 124.795px;"
                                  id="elg5fdv3kluak" class="animable"></rect>
                            <path d="M279.22,148.11H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 146.765px;"
                                  id="elzmd92wcgvu" class="animable"></path>
                            <path d="M279.22,157.53H235.63a1.35,1.35,0,0,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 156.18px;"
                                  id="el0ceo1p4j7nuq" class="animable"></path>
                            <path d="M279.22,166.94H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 165.595px;"
                                  id="elark51oyx5qb" class="animable"></path>
                            <path d="M279.22,176.36H235.63a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 175.01px;" id="elod8uvfuyp1"
                                  class="animable"></path>
                            <path d="M279.22,185.77H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 184.425px;"
                                  id="elkh1eu78bzrt" class="animable"></path>
                            <path d="M279.22,195.19H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 193.845px;"
                                  id="elbb3vkd9r5r9" class="animable"></path>
                            <path d="M279.22,204.61H235.63a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 203.26px;" id="elga82qtkilk"
                                  class="animable"></path>
                            <path d="M279.22,213H235.63a1.35,1.35,0,0,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 211.65px;"
                                  id="elxb7jfrewvum" class="animable"></path>
                            <path d="M279.22,222.39H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 221.045px;"
                                  id="elvxmiqjnwzl" class="animable"></path>
                            <path d="M279.22,231.81H235.63a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 230.46px;"
                                  id="elktif3r7ge0j" class="animable"></path>
                            <path d="M279.22,241.22H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 239.875px;"
                                  id="eli7sp6uakaa" class="animable"></path>
                            <path d="M279.22,250.64H235.63a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 249.29px;"
                                  id="elxc63ikkainf" class="animable"></path>
                            <path d="M279.22,260.05H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 258.705px;"
                                  id="elnw6micjrcwg" class="animable"></path>
                            <path d="M279.22,269.47H235.63a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 257.425px 268.125px;"
                                  id="elxycj2z5sj5" class="animable"></path>
                            <path d="M404.54,148.11H361a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 146.765px;"
                                  id="eldipooqoyqy" class="animable"></path>
                            <path d="M404.54,157.53H361a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.791px 156.18px;"
                                  id="elvpnb2eby0hb" class="animable"></path>
                            <path d="M404.54,166.94H361a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 165.595px;"
                                  id="elhrcxdakl87" class="animable"></path>
                            <path d="M404.54,176.36H361a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 175.01px;"
                                  id="elld7nsbg5jjk" class="animable"></path>
                            <path d="M404.54,185.77H361a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 184.425px;"
                                  id="elkez7tzbalji" class="animable"></path>
                            <path d="M404.54,195.19H361a1.35,1.35,0,1,1,0-2.69h43.59a1.35,1.35,0,1,1,0,2.69Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 193.845px;"
                                  id="elw3ew2tc20rq" class="animable"></path>
                            <path d="M404.54,204.61H361a1.35,1.35,0,1,1,0-2.7h43.59a1.35,1.35,0,0,1,0,2.7Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 382.795px 203.26px;"
                                  id="elz3cy75ewout" class="animable"></path>
                            <rect x="359.91" y="210.93" width="44.99" height="51.61"
                                  style="fill: rgb(146, 227, 169); transform-origin: 382.405px 236.735px;"
                                  id="eldq97kbwbkz8" class="animable"></rect>
                            <g id="el0rd5q247oofp">
                                <rect x="359.91" y="210.93" width="44.99" height="51.61"
                                      style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 382.405px 236.735px;"
                                      class="animable"></rect>
                            </g>
                        </g>
                        <g id="freepik--Plant--inject-1--inject-1--inject-1--inject-116" class="animable"
                           style="transform-origin: 411.221px 343.111px;">
                            <path
                                d="M427.33,304.39c-.27-10.16.52-27.5-8.4-34.64-7.83-6.27-13.92,2.24-16.11,9.1-5.33,16.65-4.76,79.31-3.38,91.93,0,0-1.36-12.64-11.29-7.22s5,33.87,5,33.87-11.74-8.58-17.16-1.36,6.78,15.36,6.78,15.36-11.29-3.16-11.29,0,3.61,5.87,14,7.23h56s9-5,7.23-10.39S437.38,406,437.38,406s14.45-17.61,13.54-25.29-19.42,1.35-19.42,1.35,14.46-36.58,11.75-52.84c-2.14-12.81-12.08-4-17.49.88A147.51,147.51,0,0,0,427.33,304.39Z"
                                style="fill: rgb(146, 227, 169); transform-origin: 411.221px 343.111px;"
                                id="elpym64k5kfrq" class="animable"></path>
                            <g id="el5qqtbkh5v3">
                                <path
                                    d="M427.33,304.39c-.27-10.16.52-27.5-8.4-34.64-7.83-6.27-13.92,2.24-16.11,9.1-5.33,16.65-4.76,79.31-3.38,91.93,0,0-1.36-12.64-11.29-7.22s5,33.87,5,33.87-11.74-8.58-17.16-1.36,6.78,15.36,6.78,15.36-11.29-3.16-11.29,0,3.61,5.87,14,7.23h56s9-5,7.23-10.39S437.38,406,437.38,406s14.45-17.61,13.54-25.29-19.42,1.35-19.42,1.35,14.46-36.58,11.75-52.84c-2.14-12.81-12.08-4-17.49.88A147.51,147.51,0,0,0,427.33,304.39Z"
                                    style="opacity: 0.1; transform-origin: 411.221px 343.111px;"
                                    class="animable"></path>
                            </g>
                            <line x1="409.32" y1="417.45" x2="413.44" y2="294"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 411.38px 355.725px;"
                                  id="elmldbkba6gdd" class="animable"></line>
                            <line x1="411.63" y1="366.27" x2="432.86" y2="346.39"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 422.245px 356.33px;"
                                  id="elxfunl03mfcs" class="animable"></line>
                            <line x1="421.57" y1="357.23" x2="426.08" y2="344.59"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 423.825px 350.91px;"
                                  id="ela7gsc9e89u" class="animable"></line>
                            <line x1="394.02" y1="381.62" x2="409.97" y2="398.63"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 401.995px 390.125px;"
                                  id="elptpd6uvdcbf" class="animable"></line>
                            <line x1="437.38" y1="391.56" x2="410.28" y2="405.56"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 423.83px 398.56px;"
                                  id="el4zzr9uqy7la" class="animable"></line>
                            <line x1="423.72" y1="398.46" x2="432.86" y2="399.24"
                                  style="fill: none; stroke: rgb(146, 227, 169); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.72695px; transform-origin: 428.29px 398.85px;"
                                  id="elgp8aeur0i06" class="animable"></line>
                        </g>
                        <g id="freepik--Character--inject-1--inject-1--inject-1--inject-116" class="animable"
                           style="transform-origin: 224.599px 290.387px;">
                            <path
                                d="M223.59,419.14c0,3.72-35.45,6.74-79.17,6.74s-79.18-3-79.18-6.74,35.45-6.74,79.18-6.74S223.59,415.42,223.59,419.14Z"
                                style="fill: rgb(38, 50, 56); transform-origin: 144.415px 419.14px;" id="elwuf64jx8gig"
                                class="animable"></path>
                            <path
                                d="M105,295.35s6.12-3.1,8.78-.44,1.59,31.12,2.39,40.16A85.7,85.7,0,0,0,119.14,351s-8.78-1.59-15.43-5C103.71,346,97.86,317.6,105,295.35Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 110.297px 322.416px;"
                                id="el054679g4lcvj" class="animable"></path>
                            <path
                                d="M226.85,359.8a3.19,3.19,0,0,1-1.41-6.05l28.91-13,22.44-25.81a3.19,3.19,0,1,1,4.88,4.11L258.8,345.37a3.14,3.14,0,0,1-1,.81l-29.52,13.29A3.06,3.06,0,0,1,226.85,359.8Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 253.042px 336.803px;"
                                id="elisdqrs0ro4a" class="animable"></path>
                            <line x1="246.62" y1="348.53" x2="249.79" y2="347.09"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 248.205px 347.81px;"
                                  id="el1818vjio8qa" class="animable"></line>
                            <line x1="232" y1="355.18" x2="244.53" y2="349.48"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 238.265px 352.33px;"
                                  id="el9s4enwor8j5" class="animable"></line>
                            <line x1="274.85" y1="323.37" x2="266.5" y2="332.81"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 270.675px 328.09px;"
                                  id="eluxppgr0uq4" class="animable"></line>
                            <line x1="265.15" y1="334.16" x2="263.26" y2="336.31"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 264.205px 335.235px;"
                                  id="el0glksbfj0qwa" class="animable"></line>
                            <g id="el1f115kf4x4t">
                                <circle cx="204.5" cy="362.99" r="27.84"
                                        style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 204.5px 362.99px; transform: rotate(-76.6608deg);"
                                        class="animable"></circle>
                            </g>
                            <path
                                d="M134.33,262.14s4,9.38,4.84,11.21,1.64,2.33,1.45,2.91-2.23,1.25-2.23,1.25a16.11,16.11,0,0,1-1.45,8.42c-2,4-5.9,6.09-6.28,8.6a46.18,46.18,0,0,0-.1,7.26l-5.9-4.84s1.64-4.74.19-8.22a13.23,13.23,0,0,0-6.19-6.57,16.18,16.18,0,0,1-6.86-9.77c-.87-4.65,1.83-9.58,5.41-13.06s10.64-2.8,11.42-2.51-1.94-2,.48-2.52,3.87,3,4,3.58.87-2.51,1.65-.48S134.33,262.14,134.33,262.14Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 126.142px 278.019px;"
                                id="elqk8hhyisxo" class="animable"></path>
                            <g style="clip-path: url(&quot;#freepik--clip-path--inject-1--inject-1--inject-1--inject-116&quot;); transform-origin: 120.67px 278.06px;"
                               id="el8f4s0aa1q1o" class="animable">
                                <g id="elu0heu64ss8">
                                    <path
                                        d="M127.12,299a16.12,16.12,0,0,0-.23-2c-.39-1.76,2-7.24,2.74-13.69s-4.31-15.46-4.31-15.46l-3.7-10.73a9.55,9.55,0,0,0-4.41,2.26c-3.58,3.48-6.28,8.41-5.41,13.06a16.18,16.18,0,0,0,6.86,9.77,13.23,13.23,0,0,1,6.19,6.57c1.45,3.48-.19,8.22-.19,8.22Z"
                                        style="fill: rgb(146, 227, 169); opacity: 0.5; mix-blend-mode: multiply; transform-origin: 120.67px 278.06px;"
                                        class="animable"></path>
                                </g>
                            </g>
                            <path
                                d="M134.33,262.14s4,9.38,4.84,11.21,1.64,2.33,1.45,2.91-2.23,1.25-2.23,1.25a16.11,16.11,0,0,1-1.45,8.42c-2,4-5.9,6.09-6.28,8.6a46.18,46.18,0,0,0-.1,7.26l-5.9-4.84s1.64-4.74.19-8.22a13.23,13.23,0,0,0-6.19-6.57,16.18,16.18,0,0,1-6.86-9.77c-.87-4.65,1.83-9.58,5.41-13.06s10.64-2.8,11.42-2.51-1.94-2,.48-2.52,3.87,3,4,3.58.87-2.51,1.65-.48S134.33,262.14,134.33,262.14Z"
                                style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 126.142px 278.019px;"
                                id="elfbzukjmgxgl" class="animable"></path>
                            <path d="M134.71,267.13s-1.75-.48-2.33,1a2.54,2.54,0,0,0-.09,2.22"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 133.394px 268.703px;"
                                  id="el8a1fcs8h8ic" class="animable"></path>
                            <path d="M136.75,281.87s-1.74.87-2.81-.29"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 135.345px 281.882px;"
                                  id="el5zc3262ukzp" class="animable"></path>
                            <line x1="133.34" y1="273.76" x2="125.28" y2="277.25"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 129.31px 275.505px;"
                                  id="elu6yfsgt745a" class="animable"></line>
                            <path
                                d="M121.91,281.49a8.5,8.5,0,0,0-1.44,5.46c.24,3.3.16,7.8-1.53,7.4s.8-5.47.8-7.56a14.34,14.34,0,0,0-1.08-4.63"
                                style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 120.131px 287.932px;"
                                id="elosdnh4mw4t" class="animable"></path>
                            <line x1="139.22" y1="271.22" x2="137.32" y2="272.04"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 138.27px 271.63px;"
                                  id="elacctbj7kgca" class="animable"></line>
                            <path
                                d="M136.11,273.1c.25.85.25,1.6,0,1.67s-.65-.56-.9-1.41-.24-1.6,0-1.68S135.87,272.24,136.11,273.1Z"
                                style="fill: rgb(38, 50, 56); transform-origin: 135.662px 273.224px;" id="el69rdd7iqns"
                                class="animable"></path>
                            <path
                                d="M137.12,273.1c.67,2,.5,3.85-.38,4.15s-2.14-1.09-2.81-3.08-.5-3.86.38-4.16S136.45,271.1,137.12,273.1Z"
                                style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 135.525px 273.63px;"
                                id="el8jwaxkds0r5" class="animable"></path>
                            <path d="M123.76,280.85s-1.59-1.92-.16-1.76a2.54,2.54,0,0,1,1.92,1.76"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 124.262px 279.965px;"
                                  id="elgsw6vdnlip6" class="animable"></path>
                            <polygon points="168.47 313.68 162.86 317.65 163.73 322.29 170.12 319.78 168.47 313.68"
                                     style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 166.49px 317.985px;"
                                     id="elzifburbgqrp" class="animable"></polygon>
                            <path
                                d="M163.44,316.49l2.52,9.38S149,333.61,145.65,336s-6,1.74-6,1.74l-2.22-10.84s2.41,1.16,7.54-1.06S163.44,316.49,163.44,316.49Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 151.695px 327.155px;"
                                id="elk2f06iy2bze" class="animable"></path>
                            <path
                                d="M171.77,340.9a1.43,1.43,0,0,1-1.28-1.36l-2.24-37.11a1.44,1.44,0,1,1,2.87-.13l2.24,37.1a1.44,1.44,0,0,1-1.37,1.51Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 170.801px 320.867px;"
                                id="el26ncv0f81z4" class="animable"></path>
                            <path d="M167.5,312.8a1.44,1.44,0,0,1-.17-2.86l5.61-.68a1.44,1.44,0,1,1,.35,2.85l-5.61.68Z"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 170.393px 311.016px;"
                                  id="ellt76kh81ihb" class="animable"></path>
                            <path
                                d="M167.79,315.7a1.44,1.44,0,0,1-.17-2.86l5.61-.68a1.45,1.45,0,0,1,1.6,1.26,1.43,1.43,0,0,1-1.25,1.59l-5.61.68Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 170.626px 313.926px;"
                                id="elswo9ga28zh" class="animable"></path>
                            <path d="M168.1,318.34a1.38,1.38,0,0,1-.16-2.75l5.37-.65a1.38,1.38,0,1,1,.33,2.74l-5.37.65Z"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 170.799px 316.634px;"
                                  id="elkmnq4adk3b" class="animable"></path>
                            <path
                                d="M169,320.87a1.11,1.11,0,0,1-1-1.12,1.25,1.25,0,0,1,.85-1.42l3.8-.61c.54-.07,1,.42,1.08,1.12a1.23,1.23,0,0,1-.85,1.42l-3.79.6Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 170.867px 319.292px;"
                                id="eljrh4ckupool" class="animable"></path>
                            <path
                                d="M166.94,316.3a1.12,1.12,0,0,1-1.05,1.05,1.25,1.25,0,0,1-1.49-.74l-.88-3.74c-.12-.53.33-1.05,1-1.17a1.26,1.26,0,0,1,1.48.74l.89,3.75S166.93,316.26,166.94,316.3Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 165.22px 314.527px;"
                                id="el766bf0y4frj" class="animable"></path>
                            <path
                                d="M122.53,294.05s6.87,4.16,10.06,9.38,5.9,13,7.45,19.83,2.8,24.66,3.77,28.34a23.69,23.69,0,0,0,2.13,5.61,46.66,46.66,0,0,1-17.51,2.9c-9.48-.39-10.93-2.71-10.93-2.71s-3.19-21.08-2.9-37.82S122.53,294.05,122.53,294.05Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 130.261px 327.089px;"
                                id="eljxjzb72w3rc" class="animable"></path>
                            <g style="clip-path: url(&quot;#freepik--clip-path-2--inject-1--inject-1--inject-1--inject-116&quot;); transform-origin: 124.256px 324.565px;"
                               id="el47sd772rwx1" class="animable">
                                <g id="elgqack70h6bh">
                                    <path
                                        d="M118.48,313s-1,1.57-.2-2.54a31,31,0,0,1,3.13-8.22l4.69,5.28,2.94.2-.78,1.37,5.67,3.52-2.69-3.17.19-4.84L126.89,306s-2.94-5.28-3.72-7c-.52-1.18,1.22-2.18,2.44-2.71a36,36,0,0,0-3.08-2.15s-7.64,8.8-7.93,25.53c-.23,13.27,1.73,29.26,2.55,35.32l15-.83Z"
                                        style="fill: rgb(146, 227, 169); opacity: 0.5; mix-blend-mode: multiply; transform-origin: 124.256px 324.565px;"
                                        class="animable"></path>
                                </g>
                            </g>
                            <path
                                d="M122.53,294.05s6.87,4.16,10.06,9.38,5.9,13,7.45,19.83,2.8,24.66,3.77,28.34a23.69,23.69,0,0,0,2.13,5.61,46.66,46.66,0,0,1-17.51,2.9c-9.48-.39-10.93-2.71-10.93-2.71s-3.19-21.08-2.9-37.82S122.53,294.05,122.53,294.05Z"
                                style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 130.261px 327.089px;"
                                id="elxlbx7uyj5sr" class="animable"></path>
                            <polyline points="120.5 297.44 127.66 306.04 131.43 304.59 131.24 309.43 136.94 316.3"
                                      style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 128.72px 306.87px;"
                                      id="elsvlpvu17vbs" class="animable"></polyline>
                            <path d="M116.1,315.67s.8,8,3.19,9.9"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 117.695px 320.62px;"
                                  id="el74ox876eepe" class="animable"></path>
                            <path d="M116.58,324.3s1,3,3.51,4"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 118.335px 326.3px;"
                                  id="elfvwshn8ek3n" class="animable"></path>
                            <polyline points="137.34 319.98 133.19 321.58 133.83 323.34 137.66 321.9"
                                      style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 135.425px 321.66px;"
                                      id="eltb4omlo47s" class="animable"></polyline>
                            <path
                                d="M165.33,350.11a1.44,1.44,0,0,1-1.42-1.22l-5.18-33.64a1.44,1.44,0,0,1,2.85-.43l5.18,33.64a1.45,1.45,0,0,1-1.21,1.64Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 162.745px 331.853px;"
                                id="elmvijyh0sj3" class="animable"></path>
                            <path
                                d="M134.33,262.14s1.16-2.71.39-4.74-1.55,1.06-1.65.48-1.54-4.06-4-3.58.29,2.81-.48,2.52-7.84-1-11.42,2.51-6.28,8.41-5.41,13.06a16.18,16.18,0,0,0,6.86,9.77,13.6,13.6,0,0,1,4.62,3.87,19,19,0,0,0,2.83-2.81,3.37,3.37,0,0,1-3-.48c-1.55-1.07-2.32-4.16-.38-5.71S126.5,279,126.5,279c2,1.07,1.25-1.74.48-3s.29-2.62.58-4.45-2.22-2.52-1.93-4.36S134.33,262.14,134.33,262.14Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 123.29px 270.142px;"
                                id="elsm4sx4tdk3" class="animable"></path>
                            <path d="M129.67,263.44s-3.51-1.76-5.75,1-1.75,7.35-3.51,10.06a5.75,5.75,0,0,1-4,2.88"
                                  style="fill: none; stroke: rgb(255, 255, 255); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 123.04px 270.134px;"
                                  id="elbhmo9b1nkbk" class="animable"></path>
                            <path d="M114.34,272.55a4.07,4.07,0,0,0,4.47-3.52c.8-4,5.27-9.74,9.75-9.9s4.15,3,4.15,3"
                                  style="fill: none; stroke: rgb(255, 255, 255); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 123.528px 265.849px;"
                                  id="eln7sk5lqw53" class="animable"></path>
                            <path
                                d="M153,328.19l2.8-1.84s2.42-4.45,2.61-4.74,6.1-3.19,6.58-2.8a2.28,2.28,0,0,1,.77,1.93c-.19.49-.87,1-.87,1.46s.78,4.15.78,5.12-4,2.61-5.61,3.1-3.77.48-4.26.87l-1.35,1.06Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 159.385px 325.562px;"
                                id="el7k0gt53mclk" class="animable"></path>
                            <path
                                d="M120.5,308.66s-2.51.67-1.64,7.73,7.93,30.85,10.44,33.76,27-13.35,27-13.35l-3-9.29s-16.54,6.48-17.89,6.77-5.23-20.79-6.58-23.4"
                                style="fill: rgb(255, 255, 255); transform-origin: 137.488px 329.579px;"
                                id="elgdxip3npnn" class="animable"></path>
                            <g style="clip-path: url(&quot;#freepik--clip-path-3--inject-1--inject-1--inject-1--inject-116&quot;); transform-origin: 137.457px 330.529px;"
                               id="ely01hjy9444a" class="animable">
                                <g id="elduxs3d1pqci">
                                    <path
                                        d="M155.85,335.45c-5.09,1.61-16.87,5.28-18.4,5.12-2-.19-2.54-1.37-3.72-2.93s-2.93,4.69-4.5,5.28-.39-7,.2-8.61-1.37.79-1.37.79-3.91-8-5.87-13.5a78.23,78.23,0,0,1-2.93-11l-.44,1.08a16.53,16.53,0,0,0,0,4.67c.87,7.06,7.93,30.85,10.44,33.76s27-13.35,27-13.35Z"
                                        style="fill: rgb(146, 227, 169); opacity: 0.5; mix-blend-mode: multiply; transform-origin: 137.457px 330.529px;"
                                        class="animable"></path>
                                </g>
                            </g>
                            <path
                                d="M120.5,308.66s-2.51.67-1.64,7.73,7.93,30.85,10.44,33.76,27-13.35,27-13.35l-3-9.29s-16.54,6.48-17.89,6.77-5.23-20.79-6.58-23.4"
                                style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 137.488px 329.579px;"
                                id="ele66abvtyca8" class="animable"></path>
                            <path d="M135.4,334.28a8.67,8.67,0,0,0-3.81,5.67"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 133.495px 337.115px;"
                                  id="elvm325g0oa3r" class="animable"></path>
                            <path d="M131.75,336.43a7.09,7.09,0,0,0-2.08,5.12"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.5px; transform-origin: 130.71px 338.99px;"
                                  id="elb6cbo9pskxk" class="animable"></path>
                            <path
                                d="M106.82,344.29s-2.66-8.87-2.31-27.31,1.42-20.21.53-21.63-17,8.07-29,21.9C68.4,326.09,58.64,339.18,58,359.8c-.53,16.49,7.31,29.82,12.23,33.51,8.51,6.38,20.13,5.94,21.37,5.94H210.36s7.62-2.66,9.39-9.57,7.8-26.6-4.78-50.18c-8.26-15.47-23.05-32.09-25.54-30.85s-11.79,19-24.46,30.14C153,349.32,130.22,357.05,106.82,344.29Z"
                                style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 140.363px 347.233px;"
                                id="el04rswuxdma2t" class="animable"></path>
                            <path
                                d="M215,339.5c-1.77-3.3-3.83-6.65-6-9.87-6.94,2.39-24.34,9.53-34,23.79-8.29,12.24-2.78,31.66,14.5,45.83h20.87s7.62-2.66,9.39-9.58S227.55,363.08,215,339.5Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 196.984px 364.44px;"
                                id="elunuh8o1vdoi" class="animable"></path>
                            <path d="M218.81,376.81q-.28,2.6-.83,5.33"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 218.395px 379.475px;"
                                  id="eln17rzed9xzn" class="animable"></path>
                            <path d="M212.86,342.51s7.19,12.39,6.27,30.46"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 216.036px 357.74px;"
                                  id="elbm0dngm43b" class="animable"></path>
                            <path
                                d="M104,396.73V379c-9.25-3-15.22-6.56-20.79-9.9-8-4.79-13.6-17.7-9.84-26.06,3.45-7.72,13-11.17,18.08-7.72a175.22,175.22,0,0,0,15.34,9s-2.66-8.87-2.31-27.31,1.42-20.21.53-21.63-17,8.07-29,21.9C68.4,326.09,58.64,339.18,58,359.8c-.53,16.49,7.31,29.82,12.23,33.51,8.51,6.38,20.13,5.94,21.37,5.94H104c0-.91,0-1.76,0-2.52Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 82.3822px 347.248px;"
                                id="elp12ikindoks" class="animable"></path>
                            <path d="M61.77,363.27a49.9,49.9,0,0,0,.7,6.51"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 62.12px 366.525px;"
                                  id="elgyna4dentp7" class="animable"></path>
                            <path d="M90.36,308.74c-2.88,2.58-7.18,5.61-9.85,8.7-7.65,8.84-18.1,21.47-18.76,42.09"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 76.055px 334.135px;"
                                  id="elxuvwxc6u6mr" class="animable"></path>
                            <path
                                d="M131.64,397.12c0,9.75-15,10.64-33.6,10.64s-33.6-.36-33.6-10.64c0-14.2,15-28,33.6-28S131.64,382.92,131.64,397.12Z"
                                style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 98.04px 388.44px;"
                                id="elik43t68ntad" class="animable"></path>
                            <path
                                d="M98,369.11c-17.17,0-31.31,11.82-33.34,24.83,2,8.19,16.17,8.5,33.34,8.5s31.27-.76,33.33-8.56C129.31,380.89,115.18,369.11,98,369.11Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 97.995px 385.775px;"
                                id="elstb8th6tg7b" class="animable"></path>
                            <path
                                d="M218.51,398.16c0,8.83-13.62,9.64-30.42,9.64s-30.43-.32-30.43-9.64c0-12.85,13.62-25.37,30.43-25.37S218.51,385.31,218.51,398.16Z"
                                style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 188.085px 390.295px;"
                                id="el0h2xmm05txxr" class="animable"></path>
                            <path
                                d="M188.09,372.79c-15.55,0-28.36,10.71-30.19,22.5,1.83,7.41,14.64,7.69,30.19,7.69s28.31-.69,30.18-7.75C216.4,383.47,203.61,372.79,188.09,372.79Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 188.085px 387.885px;"
                                id="elmu1ca473e5b" class="animable"></path>
                            <path
                                d="M306.54,293a4.79,4.79,0,0,1-2.81-6.16l13.5-36.09a4.79,4.79,0,1,1,9,3.35l-13.5,36.09A4.79,4.79,0,0,1,306.54,293Z"
                                style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 314.98px 270.468px;"
                                id="el5k19pafavsl" class="animable"></path>
                            <line x1="322.08" y1="257.25" x2="314.5" y2="277.17"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 318.29px 267.21px;"
                                  id="elkf78hanxncn" class="animable"></line>
                            <path
                                d="M286,348a8.51,8.51,0,0,1-5-10.95l19.27-51.53a8.51,8.51,0,0,1,15.95,6L296.91,343A8.51,8.51,0,0,1,286,348Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 298.612px 314.267px;"
                                id="elhk1n1c0jpt" class="animable"></path>
                            <path
                                d="M357.53,158.18a51.86,51.86,0,1,0,30.41,66.74A51.87,51.87,0,0,0,357.53,158.18Zm-33.19,88.74a42.88,42.88,0,1,1,55.19-25.14A42.89,42.89,0,0,1,324.34,246.92Z"
                                style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 339.364px 206.755px;"
                                id="el4cziv0vbont" class="animable"></path>
                            <path d="M304.59,191a38.11,38.11,0,0,1,21.48-20"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 315.33px 181px;"
                                  id="elml7ruq6tj9l" class="animable"></path>
                            <path d="M301.16,206.88a38,38,0,0,1,1.74-11.47"
                                  style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 302.03px 201.145px;"
                                  id="elprr3j25jgw" class="animable"></path>
                            <path d="M290.2,217.46a50.32,50.32,0,0,1,93.71-34.1"
                                  style="fill: none; stroke: rgb(255, 255, 255); stroke-miterlimit: 10; transform-origin: 336.482px 186.962px;"
                                  id="elis041pcp9ra" class="animable"></path>
                            <path d="M389.33,200.76a50.32,50.32,0,0,1-96,26.39"
                                  style="fill: none; stroke: rgb(255, 255, 255); stroke-miterlimit: 10; transform-origin: 341.516px 228.975px;"
                                  id="eloftweb70y8h" class="animable"></path>
                            <path d="M385.93,187.71a50.21,50.21,0,0,1,2.91,9.87"
                                  style="fill: none; stroke: rgb(255, 255, 255); stroke-miterlimit: 10; transform-origin: 387.385px 192.645px;"
                                  id="elrltr371gb" class="animable"></path>
                            <circle cx="138" cy="369.12" r="14.43"
                                    style="fill: rgb(38, 50, 56); transform-origin: 138px 369.12px;" id="elypmhqij02v"
                                    class="animable"></circle>
                            <circle cx="138" cy="369.12" r="12.18"
                                    style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 138px 369.12px;"
                                    id="el233ttyiyfn1" class="animable"></circle>
                            <path
                                d="M134.3,372.72a.58.58,0,0,1,0-.81l3.3-3.3a.58.58,0,0,1,.81,0,.57.57,0,0,1,0,.82l-3.29,3.29A.57.57,0,0,1,134.3,372.72Z"
                                style="fill: rgb(38, 50, 56); transform-origin: 136.36px 370.67px;" id="el7zp2vv0vkt"
                                class="animable"></path>
                            <path
                                d="M129.28,377.74a1,1,0,0,1,0-1.45l4.7-4.7a1,1,0,0,1,1.46,0,1,1,0,0,1,0,1.45l-4.7,4.7A1,1,0,0,1,129.28,377.74Z"
                                style="fill: rgb(38, 50, 56); transform-origin: 132.36px 374.665px;" id="eld664lbg4xo7"
                                class="animable"></path>
                            <path d="M146.66,369.32a6.27,6.27,0,1,0-8.86,0A6.27,6.27,0,0,0,146.66,369.32Z"
                                  style="fill: rgb(38, 50, 56); transform-origin: 142.23px 364.883px;" id="elo32ez74uaq"
                                  class="animable"></path>
                            <path d="M145.46,368.11a4.56,4.56,0,1,0-6.46,0A4.56,4.56,0,0,0,145.46,368.11Z"
                                  style="fill: rgb(255, 255, 255); transform-origin: 142.23px 364.891px;"
                                  id="el3y9247e028c" class="animable"></path>
                            <path
                                d="M317,317.66a4.79,4.79,0,0,1-4.79,4.79H278.44a4.79,4.79,0,1,1,0-9.57h33.77A4.79,4.79,0,0,1,317,317.66Z"
                                style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 295.216px 317.665px;"
                                id="elbzan0hx4ckt" class="animable"></path>
                            <circle cx="296.79" cy="318.31" r="2.66"
                                    style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 296.79px 318.31px;"
                                    id="elocxasyfwly" class="animable"></circle>
                            <circle cx="256.36" cy="343.05" r="6.48"
                                    style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 256.36px 343.05px;"
                                    id="el57e2hjcmfon" class="animable"></circle>
                            <path d="M258.79,343.05a2.43,2.43,0,1,0-2.43,2.42A2.43,2.43,0,0,0,258.79,343.05Z"
                                  style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 256.36px 343.04px;"
                                  id="elbib2di610h" class="animable"></path>
                            <circle cx="278.44" cy="317.78" r="6.48"
                                    style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 278.44px 317.78px;"
                                    id="ely908852pli" class="animable"></circle>
                            <circle cx="278.44" cy="317.78" r="2.5"
                                    style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0.75px; transform-origin: 278.44px 317.78px;"
                                    id="el52ve0i4nx99" class="animable"></circle>
                        </g>
                        <defs>
                            <filter id="active" height="200%">
                                <feMorphology in="SourceAlpha" result="DILATED" operator="dilate"
                                              radius="2"></feMorphology>
                                <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
                                <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                                <feMerge>
                                    <feMergeNode in="OUTLINE"></feMergeNode>
                                    <feMergeNode in="SourceGraphic"></feMergeNode>
                                </feMerge>
                            </filter>
                            <filter id="hover" height="200%">
                                <feMorphology in="SourceAlpha" result="DILATED" operator="dilate"
                                              radius="2"></feMorphology>
                                <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
                                <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                                <feMerge>
                                    <feMergeNode in="OUTLINE"></feMergeNode>
                                    <feMergeNode in="SourceGraphic"></feMergeNode>
                                </feMerge>
                                <feColorMatrix type="matrix"
                                               values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></feColorMatrix>
                            </filter>
                        </defs>
                        <defs>
                            <clipPath id="freepik--clip-path--inject-1--inject-1--inject-1--inject-116">
                                <path
                                    d="M134.33,262.14s4,9.38,4.84,11.21,1.64,2.33,1.45,2.91-2.23,1.25-2.23,1.25a16.11,16.11,0,0,1-1.45,8.42c-2,4-5.9,6.09-6.28,8.6a46.18,46.18,0,0,0-.1,7.26l-5.9-4.84s1.64-4.74.19-8.22a13.23,13.23,0,0,0-6.19-6.57,16.18,16.18,0,0,1-6.86-9.77c-.87-4.65,1.83-9.58,5.41-13.06s10.64-2.8,11.42-2.51-1.94-2,.48-2.52,3.87,3,4,3.58.87-2.51,1.65-.48S134.33,262.14,134.33,262.14Z"
                                    style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round;stroke-width:0.75px"></path>
                            </clipPath>
                            <clipPath id="freepik--clip-path-2--inject-1--inject-1--inject-1--inject-116">
                                <path
                                    d="M122.53,294.05s6.87,4.16,10.06,9.38,5.9,13,7.45,19.83,2.8,24.66,3.77,28.34a23.69,23.69,0,0,0,2.13,5.61,46.66,46.66,0,0,1-17.51,2.9c-9.48-.39-10.93-2.71-10.93-2.71s-3.19-21.08-2.9-37.82S122.53,294.05,122.53,294.05Z"
                                    style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round;stroke-width:0.75px"></path>
                            </clipPath>
                            <clipPath id="freepik--clip-path-3--inject-1--inject-1--inject-1--inject-116">
                                <path
                                    d="M120.5,308.66s-2.51.67-1.64,7.73,7.93,30.85,10.44,33.76,27-13.35,27-13.35l-3-9.29s-16.54,6.48-17.89,6.77-5.23-20.79-6.58-23.4"
                                    style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round;stroke-width:0.75px"></path>
                            </clipPath>
                        </defs>
                    </svg>
                    <h3 class="mt-1">Oops...No results found.</h3>
                    <p>Please try another search or filter</p>
                </div>
            @endif
        </div>
    </section>

    <nav aria-label="...">
        <ul class="pagination">
            {{ $destinations->onEachSide(1)->withQueryString() }}
        </ul>
    </nav>
@endsection

@push('specific-css-new')
    <style>
        #discover-and-tourop .pro .des {
            text-align: center !important;
        }
        .navigation .nav-items a{
            margin-right: 45px !important;
        }
    </style>
@endpush

@push('scripts-guest-new')
    <script>
        $(document).ready(function () {
            const typed = new Typed(".auto-type", {
                strings: ["UnfoldAlbay", "DiscoverAlbay", "UncoverAlbay"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });

            $(".toast").toast('show');
            $('[data-toggle=tooltip]').show();
        });

        $("#category").popover({html:true, sanitize : false});
        $("#category-mobile").popover({html:true, sanitize : false});
    </script>
    <script>
        $(document).ready(function () {
            const typed = new Typed(".auto-type-mobile", {
                strings: ["UnfoldAlbay", "DiscoverAlbay", "UncoverAlbay"],
                typeSpeed: 10,
                backSpeed: 10,
                loop: true
            });

            $(".toast").toast('show');
            $('[data-toggle=tooltip]').show();
        });
    </script>
@endpush

