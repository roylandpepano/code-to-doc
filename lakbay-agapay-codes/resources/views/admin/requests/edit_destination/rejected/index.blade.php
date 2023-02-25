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
                        <strong>DESTINATION EDIT SUGGESTION APPROVED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('saved'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>DESTINATION EDIT SUGGESTION EDITED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('rejected'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>DESTINATION EDIT SUGGESTION REJECTED Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('restored'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>DESTINATION EDIT SUGGESTION RESTORED Successfully!</strong>
                    </div>
                @endif
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="ml-2">Rejected Edit Destination Requests</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6 header-btn">
                        <button type="submit" class="btn btn-warning text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="View Pending Requests"
                                onClick="location.href='{{ route('admin.requests.edit_destination.index') }}'">
                            <i class="fa-solid fa-circle-check mr-2"></i>Pending Requests</button>
                        <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View Approved Requests"
                                onClick="location.href='{{ route('admin.requests.edit_destination.approved.index') }}'">
                            <i class="fa-solid fa-circle-xmark mr-2"></i>Approved Requests</button>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card-body table-responsive table-tourist-requests table table-striped table-bordered table-light" style="height: 75vh;">
                    <table id="newTourOperatorRequests" class="table table-striped table-bordered table-light table-responsive-xl text-wrap" style="text-align: center">
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
                                <td><span class="badge bg-danger" style="color: white !important;">{{ $request->edit_dest_approval }}</span></td>
                                <td>{{ Carbon\Carbon::parse($request->created_at)->isoFormat('LLLL') }}</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="View Record"
                                            onClick="location.href='{{ route('admin.requests.edit_destination.rejected.show', [$request->destination_id,$request->user_id]) }}'">
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
            let table = $('#newTourOperatorRequests').DataTable({
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
