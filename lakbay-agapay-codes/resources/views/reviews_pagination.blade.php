
<div class="packages">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            @php($count = 0)
            @php($i = 1)

            @foreach($rate as $rate_item)
                @php(++$count)
                    <div class="col-lg-4" style="min-width: 300px">
                                <!-- Blog post-->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div><h6><img src="{{ asset($rate_item->user->user_picture) }}" alt="" width="50px" height="50px" style="border-radius: 50%; object-fit:cover;">
                                                <a href="{{ route('tourist.profile.show', $rate_item->user->id) }}">{{$rate_item->user->user_username}}</a></h6></div>
                                        <div>{{$rate_item->created_at}}</div>
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
                                            <!--   <div class="rating-bg" style="width: 90%;"></div> -->
                                            <progress class="rating-bg" value="{{$rate_item->rating_rate}}" max="5"></progress>
                                            <svg><use xlink:href="#fivestars"/></svg>
                                        </div>
                                        <br>
                                        <br>
                                        <div>
                                            <div class="card-text">{{$rate_item->rating_review}}</div>

                                            @if($rate_item->rating_picture1 != null)
                                                <img  src="{{ asset($rate_item->rating_picture1) }}" alt="" width="135px" height="140px"  style="margin-top: 5px;" onclick="$('#image_one{{$count}}').modal('show');">
                                            @endif
                                            @if($rate_item->rating_picture2 != null)
                                                <img src="{{ asset($rate_item->rating_picture2) }}" alt="" width="135px" height="140px" style="margin-top: 5px;" onclick="$('#image_two{{$count}}').modal('show');">
                                            @endif
                                            @if($rate_item->rating_picture3 != null)
                                                <img src="{{ asset($rate_item->rating_picture3) }}" alt="" width="135px" height="140px" style="margin-top: 5px;" onclick="$('#image_three{{$count}}').modal('show');">
                                            @endif


                                           <div class="modal fade" id="image_one{{$count}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" data-backdrop="static"
                                                 data-keyboard="false">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title" id="modalLabel"></h4>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">x</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">

                                                                <img src="{{ asset($rate_item->rating_picture1) }}" alt="" width="100%" height="576px">

                                                                @if($rate_item->rating_picture2 != null)
                                                                <button type="button" class="btn btn-primary" style=" margin-top: 1%; float: right" onclick="$('#image_two{{$count}}').modal('show'); $('#image_one{{$count}}').modal('hide'); " >Next</button>
                                                                @endif

                                                                @if($rate_item->rating_picture3 != null)
                                                                    <button type="button" class="btn btn-primary" style="margin-top: 1%;float: right; margin-right: 1%;" onclick="$('#image_three{{$count}}').modal('show'); $('#image_one{{$count}}').modal('hide'); " >Back</button>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="image_two{{$count}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" data-backdrop="static"
                                                 data-keyboard="false">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="modalLabel"></h4>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">x</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">

                                                                <img src="{{ asset($rate_item->rating_picture2) }}" alt="" width="100%" height="576px">

                                                                @if($rate_item->rating_picture3 != null)
                                                                    <button type="button" class="btn btn-primary" style=" margin-top: 1%; float: right" onclick="$('#image_three{{$count}}').modal('show'); $('#image_two{{$count}}').modal('hide'); " >Next</button>
                                                                @endif

                                                                @if($rate_item->rating_picture1 != null)
                                                                    <button type="button" class="btn btn-primary" style="margin-top: 1%;float: right; margin-right: 1%;" onclick="$('#image_one{{$count}}').modal('show'); $('#image_two{{$count}}').modal('hide'); " >Back</button>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="image_three{{$count}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" data-backdrop="static"
                                                 data-keyboard="false">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="modalLabel"></h4>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">x</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">

                                                                <img src="{{ asset($rate_item->rating_picture3) }}" alt="" width="100%" height="576px">

                                                                @if($rate_item->rating_picture1 != null)
                                                                    <button type="button" class="btn btn-primary" style=" margin-top: 1%; float: right" onclick="$('#image_one{{$count}}').modal('show'); $('#image_three{{$count}}').modal('hide'); " >Next</button>
                                                                @endif

                                                                @if($rate_item->rating_picture2 != null)
                                                                    <button type="button" class="btn btn-primary" style="margin-top: 1%;float: right; margin-right: 1%;" onclick="$('#image_two{{$count}}').modal('show'); $('#image_three{{$count}}').modal('hide'); " >Back</button>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php $i++; ?>
                            @endforeach
                            @if($count == 0)
                                <div class="view">
                                    <a>No Available Reviews!</a>
                                </div>
                            @endif
                    </div>
        </div>
        @if($count > 0)
            <div class="pagination a" style="width: auto">
                {{ $rate->appends(['packages' => $packages->currentPage()])->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
