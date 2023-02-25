@extends('layouts.admin')

@section('preloader')

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('img/icons/LOGO-1.png') }}" height="100" width="100" style="filter: invert()">
    </div>

@endsection

@section('sidebar')
@endsection

@section('content')

    <form action="{{ route('admin.report') }}" method="GET">
        @csrf
        <input name="vdf" id="vdf2" value="{{ $most_viewed_destination_from }}" type="date" hidden/>
        <input name="vdt" id="vdt2" value="{{ $most_viewed_destination_to }}" type="date" hidden/>
        <input name="vtf" id="vtf2" value="{{ $most_viewed_operator_from }}" type="date" hidden/>
        <input name="vtt" id="vtt2" value="{{ $most_viewed_operator_to }}" type="date" hidden/>
        <input name="rdf" id="rdf2" value="{{ $top_rated_destination_from }}" type="date" hidden/>
        <input name="rdt" id="rdt2" value="{{ $top_rated_destination_to }}" type="date" hidden/>
        <input name="rtf" id="rtf2" value="{{ $top_rated_operator_from }}" type="date" hidden/>
        <input name="rtt" id="rtt2" value="{{ $top_rated_operator_to }}" type="date" hidden/>

        <button type="submit" id="trigger" hidden>Export to PDF</button>
    </form>
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="toast" style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                <strong class="mr-auto">Successfully Signed In</strong>
            </div>
            <div class="toast-body">
                {{ \Illuminate\Support\Facades\Session::get('success') }}
            </div>
        </div>
    @elseif(\Illuminate\Support\Facades\Session::has('error'))
        <div class="toast" style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                <strong class="mr-auto">Error Message</strong>
            </div>
            <div class="toast-body">
                {{ \Illuminate\Support\Facades\Session::get('error') }}
            </div>
        </div>
    @endif

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header ml-auto mr-auto" style="width: 80%;">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 col-lg-6">
                        <h1 class="m-0"><strong>Dashboard</strong></h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <form action="" name="most_viewed" method="GET">
            @csrf
        <!-- Main content -->
        <section class="content ml-auto mr-auto" style="width: 80%;">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <a href="{{ route('admin.requests.new_destination.approved.index') }}">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $approvedCount }}</h3>

                                <p>Approved Destinations</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <span class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></span>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <a href="{{ route('admin.requests.new_destination.index') }}">
                        <div class="small-box bg-warning">
                            <div class="inner" style="color: white">
                                <h3>{{ $pendingCount }}</h3>

                                <p>Pending Destinations</p>
                            </div>
                            <div class="icon">
                                <i class="fa-sharp fa-solid fa-code-pull-request"></i>
                            </div>
                            <span class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></span>
                        </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <a href="{{ route('admin.requests.new_destination.rejected.index') }}">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $rejectedCount }}</h3>

                                <p>Rejected Destinations</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                            <span class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></span>
                        </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <a href="{{ route('admin.users.index') }}">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $userCount }}</h3>

                                <p>Number of Users</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <span class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></span>
                        </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-sm-6 col-lg-12 mt-3 mt-lg-0">
                        <a class="btn btn-lg btn-info" onclick="exporting();">Generate Report</a>
                    </div><!-- /.col -->
{{--                    <hr/>--}}
                    <!-- ./col -->
                    <div class="col-lg-12 col-sm-6 col-12 mt-1 p-1 p-lg-5">
                        <h2 class="m-0"><strong>Lakbay Agapay Visitors</strong></h2>
                        <div>
                            {!! $usersChart->container() !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                            <button type="submit" name="submit" value="load" class="col-sm-6 btn btn-primary mb-1 float-right" style="color: white">Filter Date</button>
                    </div>
                    <div class="col-sm-6">
                            <button type="submit" name="submit" value="all_time" class="col-sm-6 btn btn-primary mb-1 float-left" style="color: white">All Time</button>
                    </div>
                <!-- ./col -->
                    <div class="col-sm-6 mt-2 p-1 p-lg-5">
                        <h2 class="m-0"><strong>Top 10 Most Viewed Destinations</strong></h2>
                        <div class="form-row p-1 rounded shadow-sm">
                            <div class="col-sm-1 mt-2">
                                <label>From</label>
                            </div>
                            <div class="col-sm-5">
                                <input class="multisteps-form__input form-control" name="most_viewed_destination_from" id="vdf" onchange="passer(this,'#vdf2');" value="{{ $most_viewed_destination_from }}" type="date"/>
                            </div>
                            <div class="col-sm-1 mt-2">
                                <label>To</label>
                            </div>
                            <div class="col-sm-5 mb-1">
                                <input class="multisteps-form__input form-control" name="most_viewed_destination_to" id="vdt" onchange="passer(this,'#vdt2');" value="{{ $most_viewed_destination_to }}" type="date"/>
                            </div>
                        </div>
                        <div>
                            {!! $usersChart3->container() !!}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-sm-6 mt-2 p-1 p-lg-5">
                        <h2 class="m-0"><strong>Top 10 Most Viewed Tour Operators</strong></h2>
                        <div class="form-row p-1 rounded shadow-sm">
                            <div class="col-sm-1 mt-2">
                                <label>From</label>
                            </div>
                            <div class="col-sm-5">
                                <input class="multisteps-form__input form-control" name="most_viewed_operator_from" id="vtf" onchange="passer(this,'#vtf2');" value="{{ $most_viewed_operator_from }}" type="date"/>
                            </div>
                            <div class="col-sm-1 mt-2">
                                <label>To</label>
                            </div>
                            <div class="col-sm-5 mb-1">
                                <input class="multisteps-form__input form-control" name="most_viewed_operator_to" id="vtt" onchange="passer(this,'#vtt2');" value="{{ $most_viewed_operator_to }}" type="date"/>
                            </div>
                        </div>
                        <div>
                            {!! $usersChart5->container() !!}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-sm-6 col-12 mt-2 p-1 p-lg-5">
                        <h2 class="m-0"><strong>Top Rated Destinations</strong></h2>
                        <div class="form-row p-1 rounded shadow-sm">
                            <div class="col-sm-1 mt-2">
                                <label>From</label>
                            </div>
                            <div class="col-sm-5">
                                <input class="multisteps-form__input form-control" name="top_rated_destination_from" id="rdf" onchange="passer(this,'#rdf2');" value="{{ $top_rated_destination_from }}" type="date"/>
                            </div>
                            <div class="col-sm-1 mt-2">
                                <label>To</label>
                            </div>
                            <div class="col-sm-5 mb-1">
                                <input class="multisteps-form__input form-control" name="top_rated_destination_to" id="rdt" onchange="passer(this,'#rdt2');" value="{{ $top_rated_destination_to }}" type="date"/>
                            </div>
                        </div>
                        <div>
                            {!! $usersChart6->container() !!}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-sm-6 col-12 mt-2 p-1 p-lg-5">
                        <h2 class="m-0"><strong>Top Rated Tour Operators</strong></h2>
                        <div class="form-row p-1 rounded shadow-sm">
                            <div class="col-sm-1 mt-2">
                                <label>From</label>
                            </div>
                            <div class="col-sm-5">
                                <input class="multisteps-form__input form-control" name="top_rated_operator_from" id="rtf" onchange="passer(this,'#rtf2');" value="{{ $top_rated_operator_from }}" type="date"/>
                            </div>
                            <div class="col-sm-1 mt-2">
                                <label>To</label>
                            </div>
                            <div class="col-sm-5 mb-1">
                                <input class="multisteps-form__input form-control" name="top_rated_operator_to" id="rtt" onchange="passer(this,'#rtt2');" value="{{ $top_rated_operator_to }}" type="date"/>
                            </div>
                        </div>
                        <div>
                            {!! $usersChart7->container() !!}
                        </div>
                    </div>

{{--                    Leaderboard--}}
                    <!-- ./col -->
                    <div class="col-lg-12 col-sm-6 col-12 mt-1 p-1 p-lg-5">
                        <h2 class="m-0"><strong>Top Contributors</strong></h2>
                        <div>
                            {!! $usersChart8->container() !!}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-sm-6 mt-2 p-1 p-lg-5">
                        <h2 class="m-0"><strong>Top 10 Favorite Destinations</strong></h2>
                        <div>
                            {!! $usersChart9->container() !!}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-sm-6 mt-2 p-1 p-lg-5">
                        <h2 class="m-0"><strong>Top 10 Favorite Tour Operators</strong></h2>
                        <div>
                            {!! $usersChart10->container() !!}
                        </div>
                    </div>

{{--                    <!-- ./col -->--}}
{{--                    <div class="row col-lg-6 col-sm-6 col-12 mt-2 p-1 p-lg-5">--}}
{{--                        <h2 class="m-0"><strong>Tour Operator Requests</strong></h2>--}}
{{--                        <div class="col-lg-3 col-12 my-auto">--}}
{{--                            <div class="mt-lg-0 mt-4 ml-3"><text class="col-6 legend_pending"></text><text class="col-6">Pending</text></div>--}}
{{--                            <div class="my-3 ml-3"><text class="col-6 legend_approved"></text><text class="col-6">Approved</text></div>--}}
{{--                            <div class="ml-3"><text class="col-6 legend_rejected"></text><text class="col-6">Rejected</text></div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-9 col-12">--}}
{{--                            {!! $usersChart2->container() !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                    <div class="row col-lg-6 col-sm-6 col-12 mt-2 p-1 p-lg-5">--}}
{{--                        <h2 class="m-0"><strong>Edit Destination Requests</strong></h2>--}}
{{--                        <div class="col-lg-3 col-12 my-auto">--}}
{{--                            <div class="mt-lg-0 mt-4 ml-3"><text class="col-6 legend_pending"></text><text class="col-6">Pending</text></div>--}}
{{--                            <div class="my-3 ml-3"><text class="col-6 legend_approved"></text><text class="col-6">Approved</text></div>--}}
{{--                            <div class="ml-3"><text class="col-6 legend_rejected"></text><text class="col-6">Rejected</text></div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-9 col-12">--}}
{{--                            {!! $usersChart4->container() !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        </form>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    {{--{!! Charts::scripts() !!}--}}
    {!! $usersChart->script() !!}
{{--    {!! $usersChart2->script() !!}--}}
    {!! $usersChart3->script() !!}
{{--    {!! $usersChart4->script() !!}--}}
    {!! $usersChart5->script() !!}
    {!! $usersChart6->script() !!}
    {!! $usersChart7->script() !!}
    {!! $usersChart8->script() !!}
    {!! $usersChart9->script() !!}
    {!! $usersChart10->script() !!}
    <script>
        function exporting(){
            $('#trigger').click();
        }
        function passer(e,input){
            $(input.toString()).val(e.value);
        }
        $(document).ready(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.home') }}",
                data: $(this).serialize(),
                success: function () {
                    alert("Loaded");
                }
            });
            return false;
        });
    </script>
@endsection
