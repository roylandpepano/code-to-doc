@extends('layouts.admin')

@section('preloader')

@endsection

@section('sidebar')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                @if(\Illuminate\Support\Facades\Session::has('approved'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>TOUR OPERATOR APPROVED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('saved'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>TOUR OPERATOR EDITED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('rejected'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>TOUR OPERATOR REJECTED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('removed'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>TOUR OPERATOR REMOVED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('restored'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>TOUR OPERATOR RESTORED Successfully!</strong>
                    </div>
                @endif
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="ml-2">Rejected New Tour Operator Requests</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6 header-btn">
                        <form action="{{ route('admin.requests.new_tour_operator.approved.index') }}" method="GET">
                            <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View Approved Requests">
                                <i class="fa-solid fa-circle-check mr-2"></i>Approved Requests</button>
                        </form>
                        <form action="{{ route('admin.requests.new_tour_operator.index') }}" method="GET">
                            <button style="color: white !important;" type="submit" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="View Pending Requests">
                                <i class="fa-solid fa-circle-minus mr-2"></i>Pending Requests</button>
                        </form>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card-body table-responsive table-tourist-requests table table-striped table-bordered table-light" style="height: 75vh;">
                    <table id="touristRequests" class="table table-striped table-bordered table-light table-responsive-xl text-wrap" style="text-align: center">
                        <thead>
                        <tr>
                            <th style="text-align: center">Submitted by</th>
                            <th style="text-align: center">Company Name</th>
                            <th style="text-align: center">Location</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Submitted</th>
                            <th style="text-align: center">Rejected</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="Lived in {{ $request->user_address }}">{{ $request->user_fname }} {{ $request->user_lname }}</td>
                                <td>{{ $request->operator_company }}</td>
                                <td>{{ $request->operator_city }}</td>
                                <td><span class="badge bg-danger" style="color: white !important;">{{ $request->operator_approval }}</span></td>
                                <td>{{ Carbon\Carbon::parse($request->to_created)->isoFormat('LLLL') }}</td>
                                <td>{{ Carbon\Carbon::parse($request->to_updated)->isoFormat('LLLL') }}</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View Record"
                                            onclick="location.href='{{ route('admin.requests.new_tour_operator.rejected.show', $request->to_id) }}'">
                                        <i class="fa-solid fa-eye mr-1"></i> Details</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection


@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
@endpush


@push('scripts')
    <script>
        $(document).ready(function () {
            let table = $('#touristRequests').DataTable({
                responsive: true,
                "aaSorting": []
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    {{--    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>--}}
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
@endpush
