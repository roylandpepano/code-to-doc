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
                        <strong>Approved Successfully!</strong>
                    </div>
                @elseif(\Illuminate\Support\Facades\Session::has('rejected'))
                    <div class="alert alert-success" role="alert" id="success">
                        <strong>Rejected Successfully!</strong>
                    </div>
                @endif
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="ml-2">Activity Logs</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card-body table-responsive table-tourist-requests table table-striped table-bordered table-light" style="height: 75vh;">
                    <table id="activityLogs" class="table table-striped table-bordered table-light table-responsive-xl text-wrap"  style="text-align: center; ">
                        <thead>
                        <tr>
                            <th style="text-align: center">ID</th>
                            <th style="text-align: center">User</th>
                            <th style="text-align: center">Activity</th>
                            <th style="text-align: center">Action</th>
                            <th style="text-align: center">Destination</th>
                            <th style="text-align: center">Tour Operator</th>
                            <th style="text-align: center">Submitted</th>
                            <th style="text-align: center">Approval</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td data-bs-toggle="tooltip" data-bs-placement="top">{{ $log->id }}</td>
                                <td>{{ $log->user_fname }} {{ $log->user_lname }}</td>
                                <td style="min-height: 10em; display: table-cell; vertical-align: middle">{{ $log->log_activity }}</td>
                                <td style="min-height: 10em; display: table-cell; vertical-align: middle">{{ $log->log_action }}</td>
                                <td>
                                    @if($log->dest_approval == 'Pending' && $log->editor == null)
                                        <form action="{{ route('admin.requests.new_destination.show',$log->dest_id) }}" method="GET">
                                            <button class="btn btn-warning btn-sm" style="min-width: 25px;" type="submit">{{ $log->dest_name }}</button>
                                        </form>
                                    @elseif($log->dest_approval == 'Approved' &&  $log->editor == null)
                                        <form action="{{ route('admin.requests.new_destination.approved.show',$log->dest_id) }}" method="GET">
                                            <button class="btn btn-success btn-sm" type="submit">{{ $log->dest_name }}</button>
                                        </form>
                                    @elseif($log->dest_approval == 'Rejected' &&  $log->editor == null)
                                        <form action="{{ route('admin.requests.new_destination.rejected.show',$log->dest_id) }}" method="GET">
                                            <button class="btn btn-danger btn-sm" type="submit">{{ $log->dest_name }}</button>
                                        </form>
                                    @elseif($log->editor != null)
                                        @if($log->edit_dest_approval == "Pending")
                                            <form action="{{ route('admin.requests.edit_destination.show',[$log->dest_id,$log->editor]) }}" method="GET">
                                                <button class="btn btn-warning btn-sm" style="min-width: 25px;" type="submit">{{ $log->dest_name }}</button>
                                            </form>
                                        @elseif($log->edit_dest_approval == "Approved")
                                            <form action="{{ route('admin.requests.edit_destination.approved.show',[$log->dest_id,$log->editor]) }}" method="GET">
                                                <button class="btn btn-success btn-sm" type="submit">{{ $log->dest_name }}</button>
                                            </form>
                                        @elseif($log->edit_dest_approval == "Rejected")
                                            <form action="{{ route('admin.requests.edit_destination.rejected.show',[$log->dest_id,$log->editor]) }}" method="GET">
                                                <button class="btn btn-danger btn-sm" type="submit">{{ $log->dest_name }}</button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                                <td>


                                    @if($log->operator_approval == 'Pending')
                                        <form action="{{ route('admin.requests.new_tour_operator.show',$log->to_id) }}" method="GET">
                                            <button class="btn btn-warning btn-sm" type="submit">
                                                @if($log->tour_operator_id != null)
                                                    {{ $tour_operators->where('to_id', $log->to_id)->first()->operator_company }}
                                                @endif
                                            </button>
                                        </form>
                                    @elseif($log->operator_approval == 'Approved')
                                        <form action="{{ route('admin.requests.new_tour_operator.approved.show',$log->to_id) }}" method="GET">
                                            <button class="btn btn-success btn-sm" type="submit">
                                                @if($log->tour_operator_id != null)
                                                    {{ $tour_operators->where('to_id', $log->to_id)->first()->operator_company }}
                                                @endif
                                            </button>
                                        </form>
                                    @elseif($log->operator_approval == 'Rejected')
                                        <form action="{{ route('admin.requests.new_tour_operator.rejected.show',$log->to_id) }}" method="GET">
                                            <button class="btn btn-danger btn-sm" type="submit">
                                                @if($log->tour_operator_id != null)
                                                    {{ $tour_operators->where('to_id', $log->to_id)->first()->operator_company }}
                                                @endif
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if($log->tour_operator_id != null)
                                        {{ Carbon\Carbon::parse($tour_operators->where('to_id', $log->to_id)->first()->to_created)->isoFormat('LLL') }}
                                    @else
                                        {{ Carbon\Carbon::parse($log->dest_created)->isoFormat('LLL') }}
                                    @endif
                                </td>
                                <td>{{ Carbon\Carbon::parse($log->logs_created)->isoFormat('LLL') }}</td>
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
            let table = $('#activityLogs').DataTable({
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
