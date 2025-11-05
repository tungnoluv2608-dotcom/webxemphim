<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
    <title>
        Admin Web Phim
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="keywords" content="Admin Web Phimn" />
    <script type="application/x-javascript">
    addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);

    function hideURLbar() { window.scrollTo(0, 1); }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('backend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- font-awesome icons CSS -->
    <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- //font-awesome icons CSS-->
    <!-- side nav css file -->
    <link href="{{ asset('backend/css/SidebarNav.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <!-- //side nav css file -->
    <!-- js-->
    <script src="{{ asset('backend/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/modernizr.custom.js') }}"></script>
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet" />
    <!--//webfonts-->
    <!-- chart -->
    <script src="{{ asset('backend/js/Chart.js') }}"></script>
    <!-- //chart -->
    <!-- Metis Menu -->
    <script src="{{ asset('backend/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" />
    <!--//Metis Menu -->
    <style>
        #chartdiv {
            width: 100%;
            height: 295px;
        }
    </style>
    <!--pie-chart -->
    <!-- index page sales reviews visitors pie chart -->
    <script src="{{ asset('backend/js/pie-chart.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#demo-pie-1').pieChart({
                barColor: '#2dde98',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function(from, to, percent) {
                    $(this.element)
                        .find('.pie-value')
                        .text(Math.round(percent) + '%');
                },
            });

            $('#demo-pie-2').pieChart({
                barColor: '#8e43e7',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function(from, to, percent) {
                    $(this.element)
                        .find('.pie-value')
                        .text(Math.round(percent) + '%');
                },
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ffc168',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function(from, to, percent) {
                    $(this.element)
                        .find('.pie-value')
                        .text(Math.round(percent) + '%');
                },
            });
        });
    </script>
    <!-- //pie-chart -->
    <!-- index page sales reviews visitors pie chart -->
    <!-- requried-jsfiles-for owl -->
    <link href="{{ asset('backend/css/owl.carousel.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/js/owl.carousel.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#owl-demo').owlCarousel({
                items: 3,
                lazyLoad: true,
                autoPlay: true,
                pagination: true,
                nav: true,
            });
        });
    </script>
    <!-- //requried-jsfiles-for owl -->
</head>

<body class="cbp-spmenu-push">
    @if (Auth::check())
        <div class="main-content">

            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!--left-fixed -navigation-->
                <aside class="sidebar-left">
                    <nav class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target=".collapse" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <h1>
                                <a class="navbar-brand" href="{{ url('/home') }}"><span
                                        class="fa fa-area-chart"></span> P33<span class="dashboard_text">Design
                                        dashboard</span></a>
                            </h1>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="sidebar-menu">
                                <li class="header">Quản lý thành phần webphim</li>
                                <li class="treeview">
                                    <a href="{{ url('/home') }}">
                                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="treeview">
                                    <a href="{{ route('info.create') }}">
                                        <i class="fa fa-dashboard"></i> <span>Thông tin website</span>
                                    </a>
                                </li>

                                @php
                                    $segment = Request::segment(1);
                                @endphp
                                <li class="treeview {{ $segment == 'category' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-file"></i>
                                        <span>Danh mục phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('category.create') }}"><i class="fa fa-angle-right"></i>
                                                Thêm danh mục</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('category.index') }}"><i class="fa fa-angle-right"></i>
                                                Liệt kê danh mục</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'comments' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-file"></i>
                                        <span>Bình luận về phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">

                                        <li>
                                            <a href="{{ route('comments') }}"><i class="fa fa-angle-right"></i> Liệt kê
                                                bình luận</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'genre' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-child"></i>
                                        <span>Thể loại phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('genre.create') }}"><i class="fa fa-angle-right"></i>
                                                Thêm thể loại</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('genre.index') }}"><i class="fa fa-angle-right"></i> Liệt
                                                kê thể loại</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'country' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-globe"></i>
                                        <span>Quốc gia phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('country.create') }}"><i class="fa fa-angle-right"></i>
                                                Thêm quốc gia</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('country.index') }}"><i class="fa fa-angle-right"></i>
                                                Liệt kê quốc gia</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'movie' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-film"></i>
                                        <span>Phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('movie.create') }}"><i class="fa fa-angle-right"></i>
                                                Thêm phim</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('movie.index') }}"><i class="fa fa-angle-right"></i>
                                                Liệt kê phim</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('sort_movie') }}"><i class="fa fa-angle-right"></i> Sắp
                                                xếp phim</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('leech-movie') }}"><i class="fa fa-angle-right"></i>
                                                Leech phim</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'linkmovie' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-film"></i>
                                        <span>Link Phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('linkmovie.create') }}"><i
                                                    class="fa fa-angle-right"></i> Thêm link phim</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('linkmovie.index') }}"><i
                                                    class="fa fa-angle-right"></i> Liệt kê link phim</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'ads' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-film"></i>
                                        <span>Quảng cáo</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('ads.create') }}"><i class="fa fa-angle-right"></i>
                                                Thêm quảng cáo</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('ads.index') }}"><i class="fa fa-angle-right"></i> Liệt
                                                kê quảng cáo</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-child"></i>
                                        <span>Quản lý tài khoản</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                </li>
                                <li class="treeview {{ $segment == 'adsnetwork' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-film"></i>
                                        <span>Nhà mạng quảng cáo</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('adsnetwork.create') }}"><i
                                                    class="fa fa-angle-right"></i> Thêm nhà mạng</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('adsnetwork.create') }}"><i
                                                    class="fa fa-angle-right"></i> Liệt kê nhà mạng</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add-ads-script') }}"><i class="fa fa-angle-right"></i>
                                                Thêm script quảng cáo</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview active">
                                    <a href="#">
                                        <i class="fa fa-users"></i>
                                        <span>Users truy cập</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('visitor.index') }}"><i class="fa fa-angle-right"></i>
                                                Thống kê tất cả</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('visitor.create') }}"><i class="fa fa-angle-right"></i>
                                                Đang online <span style=" color: green;">●</span>

                                        </li>

                                    </ul>
                                </li>
                                {{-- <li class="treeview">
                  <a href="#">
                    <i class="fa fa-video-camera"></i>
                    <span>Tập phim</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="{{route('episode.create')}}"
                        ><i class="fa fa-angle-right"></i> Thêm tập phim</a
                      >
                    </li>
                    <li>
                      <a href="{{route('episode.index')}}"
                        ><i class="fa fa-angle-right"></i> Liệt kê tập phim</a
                      >
                    </li>
                  </ul>
                </li> --}}
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <!--notification menu end -->
                        <div class="clearfix"></div>
            </div>
            <div class="sticky-header header-section">
                <div class="header-left">
                    <!--toggle button start-->
                    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                    <!--toggle button end-->
                    <div class="profile_details_left">
                        <!--notifications of menu start -->
                        <ul class="nofitications-dropdown">
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false"><i class="fa fa-envelope"></i><span
                                        class="badge">4</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 3 new messages</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="images/1.jpg" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li class="odd">
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="images/4.jpg" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="images/3.jpg" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="images/2.jpg" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all messages</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false"><i class="fa fa-bell"></i><span
                                        class="badge blue">4</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 3 new notification</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="images/4.jpg" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li class="odd">
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="images/1.jpg" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="images/3.jpg" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="images/2.jpg" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all notifications</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false"><i class="fa fa-tasks"></i><span
                                        class="badge blue1">8</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 8 pending task</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Database update</span><span
                                                    class="percentage">40%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar yellow" style="width: 40%"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Dashboard done</span><span
                                                    class="percentage">90%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar green" style="width: 90%"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Mobile App</span><span
                                                    class="percentage">33%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar red" style="width: 33%"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Issues fixed</span><span
                                                    class="percentage">80%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar blue" style="width: 80%"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all pending tasks</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!--notification menu end -->
                    <div class="clearfix"></div>
                </div>
                <div class="header-right">
                    <!--search-box-->
                    <div class="search-box">
                        <form class="input">
                            <input class="sb-search-input input__field--madoka" placeholder="Search..."
                                type="search" id="input-31" />
                            <label class="input__label" for="input-31">
                                <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77"
                                    preserveAspectRatio="none">
                                    <path d="m0,0l404,0l0,77l-404,0l0,-77z" />
                                </svg>
                            </label>
                        </form>
                    </div>
                    <!--//end-search-box-->
                    <div class="profile_details">
                        <ul>
                            <li class="dropdown profile_details_drop">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="profile_img">
                                        <span class="prfil-img"><img src="images/2.jpg" alt="" />
                                        </span>
                                        <div class="user-name">
                                            <p>Admin Name</p>
                                            <span>Administrator</span>
                                        </div>
                                        <i class="fa fa-angle-down lnr"></i>
                                        <i class="fa fa-angle-up lnr"></i>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu drp-mnu">
                                    <li>
                                        <a href="#"><i class="fa fa-cog"></i> Settings</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-user"></i> My Account</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-suitcase"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-sign-out"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="header-right">
                <!--search-box-->
                <div class="search-box">
                    <form class="input">
                        <input class="sb-search-input input__field--madoka" placeholder="Search..." type="search"
                            id="input-31" />
                        <label class="input__label" for="input-31">
                            <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77"
                                preserveAspectRatio="none">
                                <path d="m0,0l404,0l0,77l-404,0l0,-77z" />
                            </svg>
                        </label>
                    </form>
                </div>
                <!--//end-search-box-->
                <div class="profile_details">
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img">
                                    <span class="prfil-img"><img src="images/2.jpg" alt="" />
                                    </span>
                                    <div class="user-name">
                                        <p>Admin Name</p>
                                        <span>Administrator</span>
                                    </div>
                                    <i class="fa fa-angle-down lnr"></i>
                                    <i class="fa fa-angle-up lnr"></i>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                                <li>
                                    <a href="#"><i class="fa fa-cog"></i> Settings</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-user"></i> My Account</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-suitcase"></i> Profile</a>
                                </li>
                                <li>
                                    {{-- <a href="#"><i class="fa fa-sign-out"></i> Logout</a>  --}}
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <i class="fa fa-sign-out"></i><input type="submit"
                                            class="btn btn-danger btn-sm" value="Logout" />
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>

        </div>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="col_3">
                    <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-file icon-rounded"></i>
                            <a href="{{ route('category.index') }}">
                                <div class="stats">
                                    <h5><strong>{{ $category_total }}</strong></h5>
                                    <span>Danh mục phim</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-child user1 icon-rounded"></i>
                            <a href="{{ route('genre.index') }}">
                                <div class="stats">
                                    <h5><strong>{{ $genre_total }}</strong></h5>
                                    <span>Thể loại phim</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-globe user2 icon-rounded"></i>
                            <a href="{{ route('country.index') }}">
                                <div class="stats">
                                    <h5><strong>{{ $country_total }}</strong></h5>
                                    <span>Quốc gia phim</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-film dollar1 icon-rounded"></i>
                            <a href="{{ route('movie.index') }}">
                                <div class="stats">
                                    <h5><strong>{{ $movie_total }}</strong></h5>
                                    <span>Phim</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 widget">
                        <div class="r3_counter_box">
                            {{-- <i class="pull-left fa fa-users dollar2 icon-rounded"></i> --}}
                            <div class="stats">
                                <span style=" color: green;">Đang Online :

                                    <span>Tổng Users truy cập : {{ $total_users }}<br />
                                        <span>Tổng Users truy cập tuần : {{ $total_users_week }}</span><br />
                                        <span>1 Tháng: {{ $total_users_month }}</span><br />


                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="row-one widgettable">

                </div>

                <!-- for amcharts js -->

                <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                <script src="{{ asset('backend/js/amcharts.js') }}"></script>
                <script src="{{ asset('backend/js/serial.js') }}"></script>
                <script src="{{ asset('backend/js/export.min.js') }}"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <link rel="stylesheet" href="{{ asset('backend/css/export.css') }}" type="text/css"
                    media="all" />
                <script src="{{ asset('backend/js/light.js') }}"></script>
                <!-- for amcharts js -->
                <script src="{{ asset('backend/js/index1.js') }}"></script>

                <div class="col-md-12">
                    @yield('content')

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--footer-->
        <div class="footer">
            <p>
                &copy; 2025 P33 Design Dashboard. All Rights Reserved | Design by
                <a href="#" target="_blank">Phòng 33</a>
            </p>
        </div>
        <!--//footer-->
        </div>
    @else
        @yield('content_login')
    @endif
</body>

</html>
