<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LA | Admin Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- FontAwesome JS -->
    <script src="https://kit.fontawesome.com/2fb013f950.js" crossorigin="anonymous"></script>
    <!-- FontAwesome CSS -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- FontAwesome JS -->
    <script src="https://kit.fontawesome.com/2fb013f950.js" crossorigin="anonymous"></script>
    <!-- FontAwesome CSS -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- Customized CSS -->
    <link href="{{ asset('css/app_admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <!-- Scripts (modal) -->
    <script src="{{ asset('js/app.js') }}" defer></script>
{{--    <script src="{{ asset('js/script.js') }}" defer></script>--}}

    @stack('css')

    <style>
        .user-panel{
            display: flex;
            align-items: center;
        }
        .user-panel img {
            height: 25px;
            width: 25px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div id="progress">
    <span id="progress-value"><i class="fa-solid fa-arrow-up"></i></span>
</div>
<div class="wrapper">

    @yield('preloader')

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.home') }}" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto mr-3">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa-regular fa-bell fa-lg"></i>
                    @if($notifications->where('notif_read',0)->count() != 0)
                        <span class="badge badge-danger navbar-badge">
                                    @if($notifications->where('notif_read',0)->count() <= 99)
                                {{ $notifications->where('notif_read',0)->count() }}
                            @else
                                99+
                            @endif
                            </span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notif-message shadow">
                    <span class="dropdown-header">Notifications</span>
                    <span class="dropdown-header">
{{--                                <form action="{{ route('admin.markAllAsRead') }}" method="POST">--}}
{{--                                    @csrf--}}
                        <button type="button" class="btn btn-secondary btn-sm" id="btn_all_notif">All</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm ml-auto" id="btn_unread_notif">Unread</button>
{{--                                    <button type="submit" class="btn btn-outline-primary btn-sm float-right">mark all as read</button>--}}
{{--                                </form>--}}
                    </span>
                    <div class="dropdown-divider"></div>
                    @if($notifications->count() == 0)
                        <p style="text-align: center!important;">You have 0 notifications.</p>
                    @endif
                    <div id="all_notif">
                        @foreach($notifications as $notification)
                            <form action="{{ route('admin.readClickedNotification',$notification->id)}}" method="POST">
                                @csrf
                                    <button type="submit" class="dropdown-item
                                @if($notification->notif_read == 0)
                                    unread
                                @else
                                    read
                                @endif
                                    ">
                                    <span>{{ $notification->notif_message }}</span>
                                    <br><span class="float-right text-muted text-sm">
                                    <i class="fa fa-envelope mr-2 fa-lg"></i>{{ $notification->created_at->diffForHumans() }}</span>
                                    </button>
                            </form>
                        @endforeach
                    </div>
                    <div id="unread_notif" style="display: none">
                        @foreach($unread as $unread_msg)
                            <form action="{{ route('admin.readClickedNotification', $unread_msg->id) }}" method="POST">
                                @csrf
                                <button type="submit" href="#" class="dropdown-item unread">
                                    <span>{{ $unread_msg->notif_message }}</span>
                                    <br><span class="float-right text-muted text-sm">
                                        <i class="fa fa-envelope mr-2 fa-lg"></i>{{ $unread_msg->created_at->diffForHumans() }}</span>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.home') }}" class="brand-link">
            <img src="{{ asset('img/index/Logo-2.png') }}" alt="LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span style="text-decoration: none;" class="brand-text font-weight-light">Lakbay Agapay</span>
        </a>


        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset(Auth::guard('web')->user()->user_picture) }}" class="img-circle elevation-2" alt="User Image" style="object-fit:cover;">
                </div>
                <div class="info">
                    <a href="{{ route('admin.profile.show',Auth::guard('web')->user()->id) }}" class="d-block">{{ Auth::guard('web')->user()->user_fname }} {{ Auth::guard('web')->user()->user_mname }} {{ Auth::guard('web')->user()->user_lname }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.requests.new_destination.approved.index') }}" class="nav-link
                        @if ((Route::current()->getName() == 'admin.requests.new_destination.approved.index') ||
                                    (Route::current()->getName() == 'admin.requests.new_destination.rejected.index') ||
                                    (Route::current()->getName() == 'admin.requests.new_destination.approved.show') ||
                                    (Route::current()->getName() == 'admin.requests.new_destination.rejected.show'))
                        active
                        @endif
                        ">
                            <i class="fa-solid fa-location-dot"></i>
                            <p class="ml-1">Destinations
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.requests.new_tour_operator.approved.index') }}" class="nav-link
                        @if ((Route::current()->getName() == 'admin.requests.new_tour_operator.approved.index') ||
                                    (Route::current()->getName() == 'admin.requests.new_tour_operator.rejected.index') ||
                                    (Route::current()->getName() == 'admin.requests.new_tour_operator.approved.show') ||
                                    (Route::current()->getName() == 'admin.requests.new_tour_operator.rejected.show'))
                        active
                        @endif
                        ">
                            <i class="fa-solid fa-hat-cowboy"></i>
                            <p class="ml-1">Tour Operators
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu">
                            <a href="#" class="nav-link
                            @if ((Route::current()->getName() == 'admin.requests.new_destination.index') ||
                                (Route::current()->getName() == 'admin.requests.edit_destination.index') ||
                                (Route::current()->getName() == 'admin.requests.edit_destination.approved.index') ||
                                (Route::current()->getName() == 'admin.requests.edit_destination.rejected.index') ||
                                (Route::current()->getName() == 'admin.requests.new_tour_operator.index') ||
                                (Route::current()->getName() == 'admin.requests.new_destination.show') ||
                                (Route::current()->getName() == 'admin.requests.edit_destination.show') ||
                                (Route::current()->getName() == 'admin.requests.new_tour_operator.show') ||
                                (Route::current()->getName() == 'admin.requests.edit_destination.approved.show') ||
                                        (Route::current()->getName() == 'admin.requests.edit_destination.rejected.show'))
                                active
                            @endif
                            ">
                            <i class="fa-solid fa-code-pull-request"></i>
                            <p class="ml-1">Requests
                                <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.requests.new_destination.index') }}" class="nav-link
                                @if (Route::current()->getName() == 'admin.requests.new_destination.index' || Route::current()->getName() == 'admin.requests.new_destination.show')
                                active
                                @endif
                                ">
                                    <i class="fa-solid fa-plus mr-2 ml-3"></i>
                                    <p>New Destination Requests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.requests.edit_destination.index') }}" class="nav-link
                                @if ((Route::current()->getName() == 'admin.requests.edit_destination.index') ||
                                    (Route::current()->getName() == 'admin.requests.edit_destination.approved.index') ||
                                    (Route::current()->getName() == 'admin.requests.edit_destination.rejected.index') ||
                                    (Route::current()->getName() == 'admin.requests.edit_destination.show') ||
                                    (Route::current()->getName() == 'admin.requests.edit_destination.approved.show') ||
                                    (Route::current()->getName() == 'admin.requests.edit_destination.rejected.show'))
                                active
                                @endif
                                ">
                                    <i class="fa-solid fa-edit mr-2 ml-3"></i>
                                    <p>Edit Destination Requests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.requests.new_tour_operator.index') }}" class="nav-link
                                @if (Route::current()->getName() == 'admin.requests.new_tour_operator.index' || Route::current()->getName() == 'admin.requests.new_tour_operator.show')
                                active
                                @endif
                                ">
                                    <i class="fa-solid fa-hat-cowboy mr-1 ml-3"></i>
                                    <p>Tour Operator Requests</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item menu">

                        <a href="#" class="nav-link
                         @if ((Route::current()->getName() == 'admin.users.index') ||
                        (Route::current()->getName() == 'admin.users.admin_user.index') ||
                        (Route::current()->getName() == 'admin.users.super_admin_user.index') ||
                        (Route::current()->getName() == 'admin.users.tour_operator_user.index') ||
                        (Route::current()->getName() == 'admin.users.tourist_user.index') ||
                        (Route::current()->getName() == 'admin.users.show') ||
                        (Route::current()->getName() == 'admin.users.admin_user.show') ||
                        (Route::current()->getName() == 'admin.users.super_admin_user.show') ||
                        (Route::current()->getName() == 'admin.users.tour_operator_user.show') ||
                        (Route::current()->getName() == 'admin.users.tourist_user.show'))
                        active
                        @endif
                        ">
                            <i class="fa-solid fa-user-group"></i>
                            <p class="ml-1">Users
                                <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link
                                @if (Route::current()->getName() == 'admin.users.index' || (Route::current()->getName() == 'admin.users.show'))
                                active
                                @endif
                                ">
                                    <i class="fa-solid fa-people-group mr-2 ml-3"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                            @if(Auth::guard('web')->user()->user_type == 'Super Admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.users.super_admin_user.index') }}" class="nav-link
                                @if (Route::current()->getName() == 'admin.users.super_admin_user.index' || (Route::current()->getName() == 'admin.users.super_admin_user.show'))
                                active
                                @endif
                                ">
                                    <i class="fa-solid fa-user-gear mr-2 ml-3"></i>
                                    <p>Super Admins</p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('admin.users.admin_user.index') }}" class="nav-link
                                @if (Route::current()->getName() == 'admin.users.admin_user.index' || (Route::current()->getName() == 'admin.users.admin_user.show'))
                                active
                                @endif
                                ">
                                    <i class="fa-solid fa-user-gear mr-2 ml-3"></i>
                                    <p>Admins</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.tour_operator_user.index') }}" class="nav-link
                                @if (Route::current()->getName() == 'admin.users.tour_operator_user.index' || (Route::current()->getName() == 'admin.users.tour_operator_user.show'))
                                active
                                @endif
                                ">
                                    <i class="fa-solid fa-user-tie fa-lg mr-2 ml-3"></i>
                                    <p>Tour Operators</p>
                                </a>
                            </li>
                            <li class="nav-item">

                                <a href="{{ route('admin.users.tourist_user.index') }}" class="nav-link
                                 @if (Route::current()->getName() == 'admin.users.tourist_user.index' || (Route::current()->getName() == 'admin.users.tourist_user.show'))
                                    active
                                 @endif">
                                    <i class="fa-solid fa-person-hiking fa-lg mr-2 ml-3"></i>
                                    <p>Tourists</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <p class="nav-header mb-0 mt-3 ml-3" style="color: gray">
                            Actions
                        </p>
                    </li>
                    <li class="nav-item">
                            <a href="{{ route('admin.add_destination.index') }}" class="nav-link
                        @if (Route::current()->getName() == 'admin.add_destination.index')
                        active
                        @endif
                        ">
                            <i class="fa-solid fa-map-location-dot mr-2"></i>
                            <p>Add Destination</p>
                        </a>
                    </li>
                    @if(Auth::guard('web')->user()->user_type == 'Super Admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.logs.index') }}" class="nav-link
                        @if (Route::current()->getName() == 'admin.logs.index')
                        active
                        @endif
                        ">
                            <i class="fa-solid fa-book-open mr-2"></i>
                            <p>Activity Logs</p>
                        </a>
                    </li>
                    @endif
                    {{-- Logout --}}
                    <li class="nav-item admin-logout">
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="submit-form logout-btn">
                            @csrf
                            <button type="submit" style="color:white;margin-bottom:8px; margin-top: 30px; background-color: #DC3545;" value="Logout" name="logout" class="nav-link btn btn-danger"><i class="fa-solid fa-power-off"></i></button>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
        @yield('sidebar')
    </aside>

    @yield('content')

    <footer class="main-footer">
        <strong>Copyright &copy; 2022 <a href="#">Lakbay Agapay</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('js/packages/jquery-3.6.0.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('js/function.js') }}"></script>
<script>
{{--    Active dropdown menu stays open--}}
    $('.menu').each(function() {
        if($(this).find('a.active').length !== 0) {
            $(this).addClass('menu-open');
        }
    });
    {{--    Notification View All or Unread--}}
    $("#btn_all_notif").click(function (e){
        $("#unread_notif").hide();
        $("#all_notif").show();
        document.getElementById("btn_all_notif").classList.remove('btn-outline-secondary');
        document.getElementById("btn_all_notif").classList.add('btn-secondary');
        document.getElementById("btn_unread_notif").classList.remove('btn-secondary');
        document.getElementById("btn_unread_notif").classList.add('btn-outline-secondary');
        e.stopPropagation();
    });
    $("#btn_unread_notif").click(function (e){
        $("#all_notif").hide();
        $("#unread_notif").show();
        document.getElementById("btn_unread_notif").classList.remove('btn-outline-secondary');
        document.getElementById("btn_unread_notif").classList.add('btn-secondary');
        document.getElementById("btn_all_notif").classList.remove('btn-secondary');
        document.getElementById("btn_all_notif").classList.add('btn-outline-secondary');
        e.stopPropagation();
    });
    $("#btn_all_notif_mobile").click(function (e){
        $("#unread_notif_mobile").hide();
        $("#all_notif_mobile").show();
        document.getElementById("btn_all_notif_mobile").classList.remove('btn-outline-secondary');
        document.getElementById("btn_all_notif_mobile").classList.add('btn-secondary');
        document.getElementById("btn_unread_notif_mobile").classList.remove('btn-secondary');
        document.getElementById("btn_unread_notif_mobile").classList.add('btn-outline-secondary');
        e.stopPropagation();
    });
    $("#btn_unread_notif_mobile").click(function (e){
        $("#all_notif_mobile").hide();
        $("#unread_notif_mobile").show();
        document.getElementById("btn_unread_notif_mobile").classList.remove('btn-outline-secondary');
        document.getElementById("btn_unread_notif_mobile").classList.add('btn-secondary');
        document.getElementById("btn_all_notif_mobile").classList.remove('btn-secondary');
        document.getElementById("btn_all_notif_mobile").classList.add('btn-outline-secondary');
        e.stopPropagation();
    });

    $(".dropdown-item").click(function (e){
        e.stopPropagation();
    });
</script>
<script src="{{ asset('js/scroll-top.js') }}"></script>
@stack('scripts')
</body>
</html>
