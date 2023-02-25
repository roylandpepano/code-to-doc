 <div class="packages">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            @php($count = 0)
            @foreach($packages as $package)
                @php(++$count)
                @if ($i <= 3)
                    <div class="col-lg-4">
                        @endif
                        @if ($i > 3)
                            <div style="display:none;" class="hidden col-lg-4">
                                @endif
                                <!-- Blog post-->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h3>{{$package->package_name}}</h3>
                                            <div class="small text-muted">
                                                <div style="color:mediumseagreen">
                                                    <strong>Price starts at Php {{$package->package_minimum_fee}}</strong>
                                                </div>
                                            </div>
                                            <p class="card-text">{{Str::limit($package->package_description, 100, $end='.....')}}</p>
                                        {{--                                    Read More Modal Pop Up = with Inclusions and Itinerary--}}
                                        <button id="btn-readmore" type="button"
                                                class="btn btn-light btn-sm float-right" data-bs-toggle="modal"
                                                data-bs-target="#readmore{{$count}}"> Read More →
                                        </button>
                                        <div class="modal fade" id="readmore{{$count}}" tabindex="-1" role="dialog"
                                             aria-labelledby="modalLabel" data-backdrop="static"
                                             data-keyboard="false">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="modalLabel">
                                                            <strong>{{$package->package_name}}</strong></h4>
                                                        <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">x
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                                <div>
                                                                    <center><p style="white-space: pre-wrap;text-align: justify">{{ $package->package_description }}</p></center>
                                                                </div>
                                                            <div>
                                                                <h5>Rate</h5>
                                                                <center><p style="white-space: pre-wrap;text-align: justify">{{ $package->package_rate }}</p></center>
                                                            </div>
                                                                <div>
                                                                    <h5>Inclusions</h5>
                                                                    <center><p style="white-space: pre-wrap;text-align: justify">{{ $package->package_inclusions}}</p></center>
                                                                </div>
                                                            <div>
                                                                <h5>Itinerary</h5>
                                                                <center><p style="white-space: pre-wrap;text-align: justify">{{ $package->package_itinerary }}</p></center>
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
                                    <a>No Available Packages!</a>
                                </div>
                            @endif
                    </div>
        </div>
        @if($count > 0)
            <div class="pagination a" style="width: auto">
                {{$packages->appends(['rate' => $rate->currentPage()])->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>



