<!DOCTYPE html>
<html>
<head>
<title>管理系統</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Widow-target" Content="_top">
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="/css/fontawesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/dashboard/css/kaiadmin.min.css?v=@php echo time();@endphp" />
<link rel="stylesheet" type="text/css" href="/css/jquery-confirm/jquery-confirm.css">
<link rel="stylesheet" type="text/css" href="/dashboard/jquery-bootstrap-scrolling-tabs/jquery.scrolling-tabs.css?v=@php echo time();@endphp">
<script type="text/javascript" src="/dashboard/jquery-3.7.1.js"></script>
<script type="text/javascript" src="/dashboard/popper.min.js?v=@php echo time();@endphp"></script>
    <script type="text/javascript" src="/js/bootstrap/bootstrap.bundle.js?v=@php echo time();@endphp"></script>
<script type="text/javascript" src="/dashboard/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="/dashboard/kaiadmin.js?v=@php echo time();@endphp"></script>
<script type="text/javascript" src="/js/jquery-confirm/jquery-confirm.js"></script>
<script type="text/javascript" src="/dashboard/jquery-bootstrap-scrolling-tabs/jquery.scrolling-tabs.js?v=@php echo time();@endphp"></script>
</head>
<body scroll="no" style="overflow: hidden">
<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" style="background: #EBF4FA !important;">
        <div class="sidebar-logo">
            <!-- Logo Header -->
            <div class="logo-header" style="background: #EBF4FA !important;">
                <a href="/dashboards" class="logo">
                    <img src="/image/logo.png" alt="navbar brand" class="navbar-brand" height="20"/>
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item">
                        <a href="javascript:;" onclick="addTab('Main','後端首頁')">
                            <i class="fas fa-home"></i>
                            <p>後端首頁</p>
                        </a>
                    </li>
                    @if (in_array(Auth::guard('admin')->user()->id,$SuperAdminlist))

                    <li class="nav-item">
                        <a href="javascript:;" onclick="addTab('SystemSteeing','系統屬性')">
                            <i class="fa-sharp fa-regular fa-gears"></i>
                            <p>系統屬性</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" onclick="addTab('SuperAdmin','超級管理員')">
                            <i class="fa-regular fa-circle-user-circle-user" style="color: rgb(128, 128, 128);"></i>
                            <p>超級管理員</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" onclick="addTab('AdminList','管理員')">
                            <i class="fa-solid fa-user-tie" style="color: rgb(128, 128, 128);"></i>
                            <p>管理員</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" onclick="addTab('Permission','權限等級')">
                            <i class="fa-solid fa-message-code" style="color: rgb(128, 128, 128);"></i>
                            <p>權限等級</p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-section">
                        <hr>
                    </li>

                    @foreach ($Menu as $key=>$value)

                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#{{$key}}">
                            {!! $value['ico']!!}
                            <p>{{$value['name']}}</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="{{$key}}">
                            <ul class="nav nav-collapse">
                                @foreach ($value['option'] as $k=>$v)
                                <li>
                                    <a href="javascript:;" onclick="addTab('{{$k}}','{{$v}}')">
                                        <span class="sub-item">{{$v}}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="/dashboards" class="logo">
                        <img
                                src="/image/logo.png"
                                alt="navbar brand"
                                class="navbar-brand"
                                height="20"
                        />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                        <a href="javascript:;" onclick="navbarreload()">
                            <i class="fa-solid fa-arrows-rotate fa-2xl" style="color: rgb(30, 48, 80);"></i>
                        </a>
                    </nav>

                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                        <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                            <a href="javascript:;" onclick="navbarreload()">
                                <i class="fa-solid fa-arrows-rotate fa-2xl" style="color: rgb(30, 48, 80);"></i>
                            </a>

                        </li>
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="/image/profile.jpg" alt="..." class="avatar-img rounded-circle"/>
                                </div>
                                <span class="profile-username">
                                      <span class="op-7"></span>
                                      <span class="fw-bold">{{ Auth::guard('admin')->user()->username  }}</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <a class="dropdown-item" href="javascript:;" onclick="addTab('Personal','變更密碼')">變更密碼</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:;" onclick="Logout();">登出</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>



                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <div class="container margintop"   style="padding: 0;border: unset;" >
            <div class="tabs-inside-here"></div>




        </div>
        <!--
        <footer class="footer">
        </footer>
        -->
    </div>

</div>


<script type="text/javascript" src="/dashboard/global.js?v=@php echo time();@endphp"></script>

</body>
</html>