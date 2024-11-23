<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('images/logo-icon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title> Admin Dashboard </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Files -->
    <link href="{{ URL::asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ URL::asset('demo/demo.css')}}" rel="stylesheet"/>
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="blue">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                AD
            </a>
            <a href="#" class="simple-text logo-normal">
                Admin Dashboard
            </a>
        </div>
        <div class="sidebar-wrapper" id="sidebar-wrapper">
            <ul class="nav">
                <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="now-ui-icons design_app"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="{{ Route::is('admin.manageUser') ? 'active' : '' }}">
                    <a href="{{ route('admin.manageUser') }}">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="{{ Route::is('admin.manageCategory') ? 'active' : '' }}">
                    <a href="{{ route('admin.manageCategory') }}">
                        <i class="now-ui-icons shopping_tag-content"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="{{ Route::is('admin.manageRecipes') ? 'active' : '' }}">
                    <a href="{{ route('admin.manageRecipes') }}">
                        <i class="now-ui-icons education_paper"></i>
                        <p>Recipes</p>
                    </a>
                </li>
                <li class="{{ Route::is('admin.manageOrders') ? 'active' : '' }}">
                    <a href="{{ route('admin.manageOrders') }}">
                        <i class="now-ui-icons shopping_cart-simple"></i>
                        <p>Orders</p>
                    </a>
                </li>
                <li class="{{ Route::is('admin.manageComments') ? 'active' : '' }}">
                    <a href="{{ route('admin.manageComments') }}">
                        <i class="now-ui-icons ui-2_chat-round"></i>
                        <p>Comments & Reviews</p>
                    </a>
                </li>
                <li class="{{ Route::is('admin.manageMessages') ? 'active' : '' }}">
                    <a href="{{ route('admin.manageMessages') }}">
                        <i class="now-ui-icons ui-1_send"></i>
                        <p>Messages</p>
                    </a>
                </li>
                <li class="{{ Route::is('admin.adminProfile') ? 'active' : '' }}">
                    <a href="{{ route('admin.adminProfile') }}">
                        <i class="now-ui-icons loader_gear"></i>
                        <p>Settings</p>
                    </a>
                </li>
                <li class="active-pro">
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="now-ui-icons sport_user-run"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#pablo">
                        @yield('page-title', 'Default Page Name')
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form>
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">                                <i class="now-ui-icons users_single-02"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Account</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href ="{{ route('admin.adminProfile') }}"> Profile</a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Panel Header -->
        @section('panel-header')
            <div class="panel-header panel-header-sm"></div>
        @show

        <div class="content">
            <div class="row">
                @yield('content')
            </div>
        </div>

    </div>
</div>
<!--   Core JS Files   -->
<script src="{{ asset('js/core/jquery.min.js') }}"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>

<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Chart JS -->
<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>

<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('js/now-ui-dashboard.min.js?v=1.5.0') }}" type="text/javascript"></script>

<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('demo/demo.js') }}"></script>
<script>
    $(document).ready(function () {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
</script>
</body>
</html>

