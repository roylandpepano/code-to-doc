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
                        <strong>DESTINATION APPROVED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('saved'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>DESTINATION EDITED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('rejected'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>DESTINATION REJECTED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('removed'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>DESTINATION REMOVED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('restored'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>DESTINATION RESTORED Successfully!</strong>
                    </div>
                @endif
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="ml-2">Pending New Destination Requests</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6 header-btn">
                        <form action="{{ route('admin.requests.new_destination.approved.index') }}" method="GET">
                            <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View Approved Requests">
                                <i class="fa-solid fa-circle-check mr-2"></i>Approved Requests</button>
                        </form>
                        <form action="{{ route('admin.requests.new_destination.rejected.index') }}" method="GET">
                        <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="View Rejected Requests">
                            <i class="fa-solid fa-circle-xmark mr-2"></i>Rejected Requests</button>
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
                    <table id="newDestinationRequests" class="table table-striped table-bordered table-light table-responsive-xl text-wrap" style="text-align: center">
                        <thead>
                        <tr>
                            <th style="text-align: center">Submitted by</th>
                            <th style="text-align: center">Destination Name</th>
                            <th style="text-align: center">Location</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Submitted</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="Lived in {{ $request->user_address }}">{{ $request->user_fname }} {{ $request->user_lname }}</td>
                                <td>{{ $request->dest_name }}</td>
                                <td>{{ $request->dest_city }}</td>
                                <td><span class="badge bg-warning" style="color: white !important;">{{ $request->dest_approval }}</span></td>
                                <td>{{ Carbon\Carbon::parse($request->dest_created)->isoFormat('LLLL') }}</td>
                                <td>
                                    <form action="{{ route('admin.requests.new_destination.show', $request->dest_id) }}" method="GET">
                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View Record">
                                        <i class="fa-solid fa-eye mr-1"></i> Details</button>
                                    </form>
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
            let table = $('#newDestinationRequests').DataTable({
                responsive: true,
                "aaSorting": []
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    {{--    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>--}}
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script>
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    </script>
@endpush
