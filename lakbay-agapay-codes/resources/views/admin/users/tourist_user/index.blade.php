@extends('layouts.admin')

@section('preloader')

@endsection

@section('sidebar')
@endsection

@section('content')

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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="ml-2">Tourists</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6 header-btn">
                        <button style="color: white !important;" type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="View Tourist Users">
                            Tourists</button>
                        <form action="{{ route('admin.users.tour_operator_user.index') }}" method="GET">
                            <button style="color: white !important;" type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View Tour Operator Users">
                                Tour Operators</button>
                        </form>
                        <form action="{{ route('admin.users.admin_user.index') }}" method="GET">
                            <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View Admin Users">
                                Admins</button>
                        </form>
                        @if(Auth::guard('web')->user()->user_type == 'Super Admin')
                        <form action="{{ route('admin.users.super_admin_user.index') }}" method="GET">
                            <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View Super Admin Users">
                                Super Admins</button>
                        </form>
                        @endif
                        <form action="{{ route('admin.users.index') }}" method="GET">
                            <button style="color: white !important;" type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View All Users">
                                All Users</button>
                        </form>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card-body table-responsive table-tourist-requests table table-striped table-bordered table-light" style="height: 100vh;">
                    <table id="tourOperatorUsers" class="table table-striped table-bordered table-light table-responsive-xl text-nowrap">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Joined At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->user_type }}</td>
                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="Username: {{ $user->user_username }}">{{ $user->user_fname }} {{ $user->user_lname }}</td>
                                <td>{{ $user->user_email }}</td>
                                <td>{{ $user->user_phone }}</td>
                                <td>{{ Carbon\Carbon::parse($user->created_at)->isoFormat('LLLL') }}</td>
                                <td>
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View Record"
                                            onclick="location.href='{{ route('admin.users.tourist_user.show', $user->id) }}'">
                                        <i class="fa-solid fa-eye mr-1"></i> Details</button>
                                    @if(Auth::guard('web')->user()->user_type == 'Super Admin')
                                        <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" name="submit" type="submit" value="make" data-bs-placement="top" title="Make Admin">
                                            <i class="fa-solid fa-user-plus mr-1"></i>Make Admin</button>
                                    @endif
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
            let table = $('#tourOperatorUsers').DataTable({
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
