<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="theme-color" content="#234556">
    <meta http-equiv="Content-Language" content="vi" />
    <meta content="VN" name="geo.region" />
    <meta name="DC.language" scheme="utf-8" content="vi" />
    <meta name="language" content="Việt Nam">
    <!--------------------Ads Network Meta-------------------------->
    @foreach ($ads_network as $key => $ads_net)
        @if ($ads_net->adsnetwork->status == 1)
            {!! $ads_net->adsnetwork->link_confirmed !!}
        @endif
    @endforeach
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('uploads/logo/' . $info->logo) }}" type="image/x-icon" />
    <meta name="revisit-after" content="1 days" />
    <meta name='robots' content='index, follow' />
    <title>{{ $meta_title }}</title>

    <meta name="description" content="{{ $meta_description }}" />
    <link rel="canonical" href="{{ Request::url() }}">
    <!-- Thêm Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="next" href="" />
    <!-- Facebook Meta Tags -->
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="{{ $meta_title }}" />

    <meta property="og:image" content="{{ $meta_image }}" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="55" />
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ Request::url() }}">
    <meta property="twitter:url" content="{{ Request::url() }}">
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">
    <meta name="twitter:image" content="{{ $meta_image }}">


    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
        type='text/css'>
    <link rel='dns-prefetch' href='//s.w.org' />


    <link rel='stylesheet' id='bootstrap-css' href='{{ asset('css/bootstrap.min.css') }}' media='all' />
    <link rel='stylesheet' id='bootstrap-css' href='{{ asset('css/balloon.css') }}' media='all' />
    <link rel='stylesheet' id='bootstrap-css' href='{{ asset('css/style_ads_ben.css') }}' media='all' />
    <link rel='stylesheet' id='style-css' href='{{ asset('css/style.css') }}' media='all' />
    <link rel='stylesheet' id='wp-block-library-css' href='{{ asset('css/style.min.css') }}' media='all' />
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />

    <script type='text/javascript' src='{{ asset('js/jquery.min.js') }}' id='halim-jquery-js'></script>
    <style type="text/css" id="wp-custom-css">
        .textwidget p a img {
            width: 100%;
        }
    </style>


</head>

<body class="home blog halimthemes halimmovies" data-masonry="">
    <header id="header">
        <div class="container">
            <div class="row" id="headwrap">
                <style>
                    a.logo img {
                        height: 110px;
                    }
                </style>
                <div class="col-md-3 col-sm-6 slogan">
                    <p class=""><a class="logo" href="" title="phim hay ">
                            <img src="{{ asset('uploads/logo/' . $info->logo) }}" height="85">
                        </a></p>
                    </a>
                </div>
                <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                    <div class="header-nav">
                        <div class="col-xs-12">
                            <style type="text/css">
                                ul#result {
                                    position: absolute;
                                    z-index: 9999;
                                    background: #1b2d3c;
                                    width: 94%;
                                    padding: 10px;
                                    margin: 1px;
                                }
                            </style>
                            <div class="form-group form-timkiem">
                                <div class="input-group col-xs-12">
                                    <form action="{{ route('tim-kiem') }}" method="GET"
                                        style="display: contents;">
                                        <input type="text" name="search" id="timkiem" class="form-control"
                                            placeholder="Tìm kiếm phim..." autocomplete="off">
                                        <button class="btn btn-primary">Tìm kiếm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs">
                    {{-- <div id="get-bookmark" class="box-shadow"><i class="hl-bookmark"></i><span> Bookmarks</span><span class="count">0</span></div>
                  <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                     <ul style="margin: 0;"></ul>
                  </div> --}}
                </div>
            </div>
        </div>
    </header>
    <div class="navbar-container">
        <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse"
                        data-target="#halim" aria-expanded="false">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <button type="button" class="navbar-toggle collapsed pull-right expand-search-form"
                        data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                        <span class="hl-search" aria-hidden="true"></span>
                    </button>
                    {{-- <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                  Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                  <span class="count">0</span>
                  </button> --}}
                    <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">

                </div>
                <div class="collapse navbar-collapse" id="halim">
                    <div class="menu-menu_1-container">
                        <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                            <li class="current-menu-item active"><a title="Trang Chủ"
                                    href="{{ route('homepage') }}">Trang Chủ</a></li>
                            <li class="mega dropdown">
                                <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                    aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                                <ul role="menu" class=" dropdown-menu">
                                    @foreach ($genre_home as $key => $gen)
                                        <li><a title="{{ $gen->title }}"
                                                href="{{ route('genre', $gen->slug) }}">{{ $gen->title }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="mega dropdown">
                                <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                    aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                                <ul role="menu" class=" dropdown-menu">
                                    @foreach ($country_home as $key => $count)
                                        <li><a title="{{ $count->title }}"
                                                href="{{ route('country', $count->slug) }}">{{ $count->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="mega dropdown">
                                <a title="Năm Phim" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                    aria-haspopup="true">Năm phim <span class="caret"></span></a>
                                <ul role="menu" class=" dropdown-menu">
                                    @for ($year = 2000; $year <= 2025; $year++)
                                        <li><a title="{{ $year }}"
                                                href="{{ url('nam/' . $year) }}">{{ $year }}</a></li>
                                    @endfor
                                </ul>
                            </li>
                            @foreach ($category_home as $key => $cate)
                                <li class="mega"><a title="{{ $cate->title }}"
                                        href="{{ route('category', $cate->slug) }}">{{ $cate->title }}</a></li>
                            @endforeach
                            <li class="mega dropdown user-account-menu">
                                @auth
                                    {{-- Khi ĐÃ đăng nhập --}}
                                    <a title="Tài khoản" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                        aria-haspopup="true">
                                        <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a title="Trang cá nhân" href="{{ route('user.profile') }}"><i
                                                    class="fa fa-user-circle"></i> Trang cá nhân</a></li>
                                        {{-- Kiểm tra admin --}}
                                        @php
                                            $isAdmin =
                                                Auth::user()->role == 'admin' ||
                                                (property_exists(Auth::user(), 'is_admin') &&
                                                    Auth::user()->is_admin == 1);
                                        @endphp

                                        @if (auth()->user()->is_admin)
                                            <li class="divider"></li>
                                            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>
                                                    Dashboard</a></li>
                                        @endif

                                        <li class="divider"></li>
                                        <li>
                                            <a title="Đăng xuất" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i> Đăng xuất
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                @else
                                    {{-- Khi CHƯA đăng nhập --}}
                                    <a title="Đăng nhập" href="{{ route('login') }}">
                                        <i class="fa fa-user"></i> Tài khoản
                                    </a>
                                @endauth
                            </li>


                    </div>
                    {{--  <ul class="nav navbar-nav navbar-left" style="background:#000;">
                     <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>
                  </ul> --}}
                </div>
            </nav>
            <div class="collapse navbar-collapse" id="search-form">
                <div id="mobile-search-form" class="halim-search-form"></div>
            </div>
            <div class="collapse navbar-collapse" id="user-info">
                <div id="mobile-user-login"></div>
            </div>
        </div>
    </div>
    </div>

    <div class="container">
        <div class="row fullwith-slider"></div>
    </div>
    <div class="container">
        <input type="hidden" value="{{ $segment }}" class="segment">

        @yield('content')
        @include('pages.include.banner')
    </div>
    <div class="clearfix"></div>
    <footer id="footer" class="clearfix">
        <div class="container footer-columns">
            <div class="row container">
                <div class="widget about col-xs-12 col-sm-4 col-md-4">
                    <div class="footer-logo">
                        <img src="{{ asset('uploads/logo/' . $info->logo) }}" height="85">
                        <p>{{ $info->description }}</p>
                    </div>

                </div>
                <style>
                    ul.title_footer {
                        padding: 0;
                        font-size: 12px;
                        /* margin: 0; */
                    }

                    h4.title-footer-h {
                        text-transform: uppercase;
                        color: #44e2ff;
                        font-weight: bold;

                    }

                    #footer ul li a {
                        color: #7d7d7e;
                        border-radius: 50% !important;
                    }

                    ul.title_footer li {
                        padding: 2px 0;
                    }
                </style>
                <div class="widget about col-xs-12 col-sm-4 col-md-4">
                    <div class="footer-logo">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="title-footer-h">Phim mới</h4>
                                <ul class="title_footer">
                                    @foreach ($category_home->random(5) as $key => $cate_footer)
                                        <li><a target="_blank" title="{{ $cate->title }}"
                                                href="{{ route('category', $cate_footer->slug) }}">{{ $cate_footer->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4 class="title-footer-h">Phim lẻ</h4>
                                <ul class="title_footer">

                                    @foreach ($genre_home->random(5) as $key => $gen_footer)
                                        <li><a target="_blank" title="{{ $gen_footer->title }}"
                                                href=" {{ route('genre', $gen_footer->slug . '?phimle') }}">Phim lẻ
                                                {{ $gen_footer->title }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4 class="title-footer-h">Phim bộ</h4>
                                <ul class="title_footer">
                                    @foreach ($country_home->random(5) as $key => $country_footer)
                                        <li><a target="_blank" title="{{ $country_footer->title }}"
                                                href="{{ route('country', $country_footer->slug . '?phimbo') }}">Phim
                                                bộ
                                                {{ $country_footer->title }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <style>
                    .social a {
                        color: #555;
                        font-size: 15px;
                    }
                </style>
                <div class="widget about col-xs-12 col-sm-4 col-md-4">
                    <div class="social">
                        <a target="_blank" href="https://telegram.me/@tugpham268" class="call"><i
                                class="fa fa-phone" aria-hidden="true"></i>
                            <span class="info"><span class="follow">Telegram:</span>
                                <span class="num">@tugpham268</span></span></a>
                    </div>

                </div>

            </div>
        </div>
    </footer>
    <style>
        .balloon-ck ul li {
            list-style: none;
        }

        .copyright_footer {
            text-align: center;
            line-height: 32px;
            color: black;
        }
    </style>

    <div class="col-xs-12 col-sm-4 col-md-12 ">
        <p class="copyright_footer" style="color:white">{{ $info->copyright }}</p>
    </div>
    <div id='easy-top'></div>

    <script type='text/javascript' src='{{ asset('js/bootstrap.min.js?ver=5.7.2') }}' id='bootstrap-js'></script>
    <script type='text/javascript' src='{{ asset('js/owl.carousel.min.js?ver=5.7.2') }}' id='carousel-js'></script>

    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>


    <script type='text/javascript' src='{{ asset('js/halimtheme-core.min.js?ver=1626273138') }}' id='halim-init-js'>
    </script>
    @if(!Auth::user() || Auth::user()->is_vip == 0)
        <script>
            $(window).on('load', function() {
                // Hiển thị sau 1 giây
                setTimeout(function() {
                    $('#banner_quangcao').modal('show');
                }, 1000);
            });
        </script>
    @endif
    <script type="text/javascript">
        function remove_background(movie_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + movie_id + '-' + count).css('color', '#ccc');
            }
        }

        //hover chuột đánh giá sao
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data("index");
            var movie_id = $(this).data('movie_id');
            // alert(index);
            // alert(movie_id);
            remove_background(movie_id);
            for (var count = 1; count <= index; count++) {
                $('#' + movie_id + '-' + count).css('color', '#ffcc00');
            }
        });
        //nhả chuột ko đánh giá
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data("index");
            var movie_id = $(this).data('movie_id');
            var rating = $(this).data("rating");
            remove_background(movie_id);
            //alert(rating);
            for (var count = 1; count <= rating; count++) {
                $('#' + movie_id + '-' + count).css('color', '#ffcc00');
            }
        });

        //click đánh giá sao
        $(document).on('click', '.rating', function() {

            var index = $(this).data("index");
            var movie_id = $(this).data('movie_id');

            $.ajax({
                url: "{{ route('add-rating') }}",
                method: "POST",
                data: {
                    index: index,
                    movie_id: movie_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data == 'done') {

                        alert("Bạn đã đánh giá " + index + " trên 5");
                        location.reload();

                    } else if (data == 'exist') {
                        alert("Bạn đã đánh giá phim này rồi,cảm ơn bạn nhé");
                    } else {
                        alert("Lỗi đánh giá");
                    }

                }
            });



        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#timkiem').keyup(function() {
                $('#result').html('');
                var search = $('#timkiem').val();
                if (search != '') {
                    $('#result').css('display', 'inherit');
                    var expression = new RegExp(search, "i");
                    $.getJSON('/json/movies.json', function(data) {
                        $.each(data, function(key, value) {
                            if (value.title.search(expression) != -1) {
                                $('#result').append(
                                    '<li class="list-group-item" style="cursor:pointer"><img height="40" width="40" src="/uploads/movie/' +
                                    value.image + '">' + value.title +
                                    '<br/> | <span>' + value.description +
                                    '</span></li>');
                            }
                        });
                    })
                } else {
                    $('#result').css('display', 'none');
                }
            })
            $('#result').on('click', 'li', function() {
                var click_text = $(this).text().split('|');

                $('#timkiem').val($.trim(click_text[0]));

                $("#result").html('');
                $('#result').css('display', 'none');
            });

        })
    </script>
    <script type="text/javascript">
        $(".watch_trailer").click(function(e) {
            e.preventDefault();
            var aid = $(this).attr("href");
            $('html,body').animate({
                scrollTop: $(aid).offset().top
            }, 'slow');
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            //lấy ra top view ngày phim 
            $.ajax({
                url: "{{ url('/filter-topview-default') }}",
                method: "GET",

                success: function(data) {
                    $('#show_data_default').html(data);
                }
            });
            $('.filter-sidebar').click(function() {
                var href = $(this).attr('href');
                if (href == '#ngay') {
                    var value = 0;
                } else if (href == '#tuan') {
                    var value = 1;
                } else {
                    var value = 2;
                }
                $.ajax({
                    url: "{{ url('/filter-topview-phim') }}",
                    method: "POST",
                    data: {
                        value: value
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        $('#halim-ajax-popular-post-default').css("display", "none");
                        $('#show_data').html(data);
                    }
                });
            })
        })
    </script>
    <style>
        #overlay_mb {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            cursor: pointer
        }

        #overlay_mb .overlay_mb_content {
            position: relative;
            height: 100%
        }

        .overlay_mb_block {
            display: inline-block;
            position: relative
        }

        #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
            width: 600px;
            height: auto;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center
        }

        #overlay_mb .overlay_mb_content .cls_ov {
            color: #fff;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 999999;
            font-size: 14px;
            padding: 4px 10px;
            border: 1px solid #aeaeae;
            background-color: rgba(0, 0, 0, 0.7)
        }

        #overlay_mb img {
            position: relative;
            z-index: 999
        }

        @media only screen and (max-width: 768px) {
            #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
                width: 400px;
                top: 3%;
                transform: translate(-50%, 3%)
            }
        }

        @media only screen and (max-width: 400px) {
            #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
                width: 310px;
                top: 3%;
                transform: translate(-50%, 3%)
            }
        }

        </styl><style>#overlay_pc {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            cursor: pointer;
        }

        #overlay_pc .overlay_pc_content {
            position: relative;
            height: 100%;
        }

        .overlay_pc_block {
            display: inline-block;
            position: relative;
        }

        #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 600px;
            height: auto;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        #overlay_pc .overlay_pc_content .cls_ov {
            color: #fff;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 999999;
            font-size: 14px;
            padding: 4px 10px;
            border: 1px solid #aeaeae;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #overlay_pc img {
            position: relative;
            z-index: 999;
        }

        @media only screen and (max-width: 768px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
                width: 400px;
                top: 3%;
                transform: translate(-50%, 3%);
            }
        }

        @media only screen and (max-width: 400px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
                width: 310px;
                top: 3%;
                transform: translate(-50%, 3%);
            }
        }
    </style>

    <style>
        .float-ck {
            position: fixed;
            bottom: 0px;
            z-index: 9
        }

        * html .float-ck

        /* IE6 position fixed Bottom */
            {
            position: absolute;
            bottom: auto;
            top: expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop, 10)||0)-(parseInt(this.currentStyle.marginBottom, 10)||0)));
        }

        #hide_float_left a {
            background: #0098D2;
            padding: 5px 15px 5px 15px;
            color: #FFF;
            font-weight: 700;
            float: left;
        }

        #hide_float_left_m a {
            background: #0098D2;
            padding: 5px 15px 5px 15px;
            color: #FFF;
            font-weight: 700;
        }

        span.bannermobi2 img {
            height: 70px;
            width: 300px;
        }

        #hide_float_right a {
            background: #01AEF0;
            padding: 5px 5px 1px 5px;
            color: #FFF;
            float: left;
        }
    </style>
    <script>
        //Script quảng cáo bên trái
        function hide_balloon_left() {
            var content = document.getElementById('balloon_left');
            var hide = document.getElementById('hide_balloon_left');
            if (content.style.display == "none") {
                content.style.display = "block";
                hide.innerHTML = '<a href="javascript:hide_balloon_left()">Tắt quảng cáo [X]</a>';

            } else {
                hide.style.display = "none";
                content.style.display = "none";
                // hide.innerHTML = '<a href="javascript:hide_balloon_left()">Xem quảng cáo...</a>';
            }
        }
    </script>
    @if(!Auth::user() || Auth::user()->is_vip == 0)
        @foreach ($ads_bottom_trai as $key => $ads_trai)
            <div class="balloon-ck" style="left: 0px">
                <div id="hide_balloon_left"><a href="javascript:hide_balloon_left()">Tắt Quảng Cáo [X]</a>
                </div>
                <a title="{{ $ads_trai->ads_name }}" href="{{ $ads_trai->ads_link }}" target="_blank" rel="nofollow">
                    <div id="balloon_left">
                        <img src="{{ asset('uploads/ads/' . $ads_trai->ads_gif) }}" alt="{{ $ads_trai->ads_name }}"
                            width="100%">

                    </div>
                </a>
            </div>
        @endforeach
    @endif
    <script>
        //Script quảng cáo bên phải
        function hide_balloon_right() {
            var content = document.getElementById('float_balloon_right');
            var hide = document.getElementById('hide_balloon_right');
            if (content.style.display == "none") {
                content.style.display = "block";
                hide.innerHTML = '<a href="javascript:hide_balloon_right()">Tắt quảng cáo [X]</a>';
            } else {
                hide.style.display = "none";
                content.style.display = "none";
                //hide.innerHTML = '<a href="javascript:hide_balloon_right()">Xem quảng cáo...</a>';
            }
        }
    </script>
    @if(!Auth::user() || Auth::user()->is_vip == 0)
        @foreach ($ads_bottom_phai as $key => $ads_phai)
            <div class="balloon-ck" style="right: 0px">
                <div id="hide_balloon_right"><a href="javascript:hide_balloon_right()">Tắt Quảng Cáo [X]</a>
                </div>
                <div id="float_balloon_right">
                    <a title="{{ $ads_phai->ads_name }}" href="{{ $ads_phai->ads_link }}" target="blank"
                        rel="nofollow">
                        <img src="{{ asset('uploads/ads/' . $ads_phai->ads_gif) }}" alt="{{ $ads_phai->ads_name }}"
                            width="80%">
                    </a>
                </div>
            </div>
        @endforeach
    @endif
    <style>
        div#float_balloon_ck {
            position: fixed;
            bottom: 0;
            width: 100%;
            display: flex;
            justify-content: center;
        }
    </style>
    <script>
        //Script quảng cáo bên phải
        function hide_balloon_ck() {
            var content = document.getElementById('float_balloon_ck');
            var hide = document.getElementById('hide_balloon_ck');
            if (content.style.display == "none") {
                content.style.display = "block";
                hide.innerHTML = '<a href="javascript:hide_balloon_ck()">Tắt quảng cáo [X]</a>';
            } else {
                hide.style.display = "none";
                content.style.display = "none";
                //hide.innerHTML = '<a href="javascript:hide_balloon_right()">Xem quảng cáo...</a>';
            }
        }
    </script>

    <div class="balloon-ck">
        @if(!Auth::user() || Auth::user()->is_vip == 0)
            <div id="float_balloon_ck">
                <ul>
                    @foreach ($ads_bottom_duoi as $key => $ads_duoi)
                        <li> <a title="{{ $ads_duoi->ads_name }}" href="{{ $ads_duoi->ads_link }}" target="blank"
                                rel="nofollow">
                                <img src="{{ asset('uploads/ads/' . $ads_duoi->ads_gif) }}"
                                    alt="{{ $ads_duoi->ads_name }}" width="80%"></li></a>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <style>
        .sidebar_ads_left {
            position: fixed;
            display: flex;
            width: 300px;
            top: 35%;
            right: auto;
            z-index: 8000;
        }

        .sidebar_ads_left ul li {
            list-style: none;

        }
    </style>
    @if(!Auth::user() || Auth::user()->is_vip == 0)
        <div class="sidebar_ads_left">
            <ul>
                @foreach ($ads_sidebar_trai as $key => $ads_side_trai)
                    <li>
                        <a title="{{ $ads_side_trai->ads_name }}" href="{{ $ads_side_trai->ads_link }}" target="blank"
                            rel="nofollow">
                            <img src="{{ asset('uploads/ads/' . $ads_side_trai->ads_gif) }}"
                                alt="{{ $ads_side_trai->ads_name }}" width="80%"></a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <style>
        .sidebar_ads_right {
            position: fixed;
            display: flex;
            width: 100%;
            top: 35%;
            left: 86%;
            z-index: 8000;
        }

        .sidebar_ads_right ul li {
            list-style: none;

        }
    </style>
    @if(!Auth::user() || Auth::user()->is_vip == 0)
        <div class="sidebar_ads_right">
            <ul>
                @foreach ($ads_sidebar_phai as $key => $ads_side_phai)
                    <li>
                        <a title="{{ $ads_side_phai->ads_name }}" href="{{ $ads_side_phai->ads_link }}" target="blank"
                            rel="nofollow">
                            <img src="{{ asset('uploads/ads/' . $ads_side_phai->ads_gif) }}"
                                alt="{{ $ads_side_phai->ads_name }}" width="80%"></a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--------------------Ads Network Script-------------------------->
    @foreach ($ads_network as $key => $ads_net_footer)
        @if ($ads_net_footer->adsnetwork->status == 1)
            {!! $ads_net_footer->script !!}
        @endif
    @endforeach

    <script>
        $(".btn-comment").click(function() {

            var name = $('.name').val();
            var comment = $('.comment').val();
            var email = $('.email').val();
            var movie_id = $('.movie_id').val();
            var visitor_id = $('.visitor_id').val();


            $.ajax({
                // url: "{{ route('insert-comment') }}",
                method: "POST",
                data: {
                    name: name,
                    comment: comment,
                    email: email,
                    movie_id: movie_id,
                    visitor_id: visitor_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    alert('Bình luận thành công,vui lòng chờ duyệt để hiển thị nhé.');
                    $('.name').val('');
                    $('.comment').val('');
                    $('.email').val('');
                }
            });

        })
    </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0&appId=6125793717446054&autoLogAppEvents=1"
        nonce="kCg4sAGb"></script>




    {{-- ==================== CHATBOT WIDGET ==================== --}}
    <div id="chatbot-widget">
        <div id="chatbot-toggle">
            <i class="fas fa-robot"></i>
        </div>
        <div id="chatbot-container">
            <div id="chatbot-header">
                <div class="chatbot-title">
                    <i class="fas fa-robot"></i>
                    <span>Trợ lý ảo</span>
                </div>
                <button id="chatbot-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="chatbot-messages">
                <div class="message bot-message">
                    <div class="message-avatar">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="message-content">
                        <p>Xin chào! Tôi là trợ lý ảo của website phim, được hỗ trợ bởi Cohere AI. Tôi có thể giúp gì
                            cho bạn?</p>
                        <small>Vừa xong</small>
                    </div>
                </div>
            </div>
            <div id="chatbot-input">
                <input type="text" id="chatbot-text" placeholder="Nhập tin nhắn của bạn...">
                <button id="chatbot-send">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <style>
        /* Chatbot Styles - FIXED */
        #chatbot-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 10000;
        }

        #chatbot-toggle {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        #chatbot-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        #chatbot-container {
            position: absolute;
            bottom: 70px;
            right: 0;
            width: 380px;
            /* Tăng width để hiển thị tốt hơn */
            height: 500px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            overflow: hidden;
        }

        #chatbot-container.active {
            display: flex;
        }

        #chatbot-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chatbot-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            font-size: 16px;
        }

        #chatbot-close {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            transition: background 0.3s ease;
        }

        #chatbot-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        #chatbot-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f8f9fa;
        }

        .message {
            display: flex;
            margin-bottom: 15px;
            gap: 10px;
        }

        .bot-message {
            align-items: flex-start;
        }

        .user-message {
            align-items: flex-end;
            flex-direction: row-reverse;
        }

        .message-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .bot-message .message-avatar {
            background: #667eea;
            color: white;
        }

        .user-message .message-avatar {
            background: #28a745;
            color: white;
        }

        .message-content {
            max-width: 80%;
            /* Tăng max-width */
            background: white;
            padding: 12px 15px;
            border-radius: 18px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: #000000;
            /* ĐẢM BẢO CHỮ MÀU ĐEN */
        }

        .bot-message .message-content {
            border-bottom-left-radius: 5px;
            background: #ffffff;
            /* Nền trắng để chữ đen hiển thị rõ */
            border: 1px solid #e9ecef;
        }

        /* FIXED LINK STYLES - QUAN TRỌNG */
        .bot-message .message-content a {
            color: #007bff !important;
            text-decoration: none !important;
            font-weight: 600;
            transition: all 0.3s ease;
            border-bottom: 1px solid transparent;
            display: inline-block;
            margin: 2px 0;
        }

        .bot-message .message-content a:hover {
            color: #0056b3 !important;
            text-decoration: underline !important;
            border-bottom-color: #0056b3;
        }

        /* Đảm bảo text trong message content hiển thị đúng */
        .message-content div {
            line-height: 1.5;
            word-wrap: break-word;
            color: #000000;
            /* CHỮ MÀU ĐEN */
        }

        .message-content p {
            margin: 0;
            font-size: 14px;
            line-height: 1.4;
            color: #000000;
            /* CHỮ MÀU ĐEN */
        }

        .user-message .message-content {
            border-bottom-right-radius: 5px;
            background: #007bff;
            color: white;
        }

        .message-content small {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 5px;
            display: block;
            color: #666;
            /* Màu xám cho timestamp */
        }

        /* Movie list specific styles */
        .movie-list {
            margin: 8px 0;
        }

        .movie-item {
            margin: 8px 0;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 3px solid #007bff;
        }

        .movie-title {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 4px;
        }

        .movie-meta {
            font-size: 12px;
            color: #666;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        #chatbot-input {
            padding: 15px 20px;
            background: white;
            border-top: 1px solid #e9ecef;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        #chatbot-text {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 12px 20px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease;
            color: #000;
            /* Chữ input màu đen */
        }

        #chatbot-text:focus {
            border-color: #667eea;
        }

        #chatbot-send {
            background: #667eea;
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        #chatbot-send:hover {
            background: #5a6fd8;
            transform: scale(1.05);
        }

        #chatbot-send:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        /* Typing Indicator */
        .typing-indicator .message-content {
            background: #ffffff;
            padding: 12px 15px;
            border-bottom-left-radius: 5px;
            border: 1px solid #e9ecef;
        }

        .typing-dots {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .typing-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #666;
            animation: typing 1.4s infinite ease-in-out;
        }

        .typing-dots span:nth-child(1) {
            animation-delay: -0.32s;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes typing {

            0%,
            80%,
            100% {
                transform: scale(0);
                opacity: 0.5;
            }

            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Scrollbar styling */
        #chatbot-messages::-webkit-scrollbar {
            width: 6px;
        }

        #chatbot-messages::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #chatbot-messages::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        #chatbot-messages::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #chatbot-container {
                width: 320px;
                height: 450px;
                right: 10px;
            }

            #chatbot-widget {
                bottom: 10px;
                right: 10px;
            }

            .message-content {
                max-width: 85%;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatbotToggle = document.getElementById('chatbot-toggle');
            const chatbotContainer = document.getElementById('chatbot-container');
            const chatbotClose = document.getElementById('chatbot-close');
            const chatbotText = document.getElementById('chatbot-text');
            const chatbotSend = document.getElementById('chatbot-send');
            const chatbotMessages = document.getElementById('chatbot-messages');

            let isSending = false;

            // Toggle chatbot
            chatbotToggle.addEventListener('click', function() {
                chatbotContainer.classList.toggle('active');
                if (chatbotContainer.classList.contains('active')) {
                    chatbotText.focus();
                }
            });

            // Close chatbot
            chatbotClose.addEventListener('click', function() {
                chatbotContainer.classList.remove('active');
            });

            // ==================== LUỒNG XỬ LÝ CHÍNH ====================
            async function getBotResponse(message) {
                console.log('🔄 Bắt đầu xử lý:', message);
                showTypingIndicator();

                try {
                    // BƯỚC 1: LUÔN ưu tiên tìm phim trong database trước
                    console.log('🔍 Ưu tiên tìm phim trong database...');
                    const movieList = await searchMoviesInYourDatabase(message);

                    if (movieList && movieList.length > 0) {
                        // Nếu tìm thấy phim -> trả kết quả NGAY, không gọi Cohere
                        hideTypingIndicator();
                        console.log(`✅ Tìm thấy ${movieList.length} phim.`);
                        return formatMovieList(movieList, message);
                    }

                    // BƯỚC 2: Chỉ khi KHÔNG tìm thấy phim mới gọi Cohere AI
                    console.log('🤖 Không tìm thấy phim, chuyển sang Cohere AI...');
                    const cohereResponse = await fetch('/api/chatbot/cohere', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content') || ''
                        },
                        body: JSON.stringify({
                            message: message
                        })
                    });

                    if (cohereResponse.ok) {
                        const data = await cohereResponse.json();
                        hideTypingIndicator();

                        if (data.success) {
                            // Thêm gợi ý nếu không tìm thấy phim
                            const enhancedResponse =
                                "Tôi không tìm thấy phim nào phù hợp với yêu cầu của bạn. " +
                                data.response +
                                "<br><br>💡 <strong>Gợi ý:</strong> Hãy thử:<br>" +
                                "• Tìm với từ khóa đơn giản hơn<br>" +
                                "• Duyệt danh mục phim trên website<br>" +
                                "• Xem phim hot ở trang chủ";
                            return enhancedResponse;
                        }
                        return "Tôi không tìm thấy phim phù hợp. Bạn có thể thử tìm với từ khóa khác.";
                    }

                } catch (error) {
                    console.error('💥 Lỗi:', error);
                    hideTypingIndicator();
                    return 'Xin lỗi, hệ thống đang bận. Vui lòng thử lại sau!';
                }

                hideTypingIndicator();
                return 'Xin lỗi, có lỗi xảy ra. Vui lòng thử lại!';
            }

            // ==================== HÀM TÌM PHIM TRONG DATABASE ====================
            async function searchMoviesInYourDatabase(userQuery) {
                try {
                    // Gọi đến endpoint tìm phim THÔNG MINH
                    const response = await fetch('/api/chatbot/search-smart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content') || '',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            query: userQuery,
                            limit: 6 // Giới hạn kết quả
                        })
                    });

                    console.log('📡 API Search Status:', response.status);

                    if (response.ok) {
                        const data = await response.json();
                        console.log('🎬 Kết quả tìm phim:', data);
                        return data.success ? data.movies : [];
                    } else {
                        // Thử fallback đến API cũ nếu API mới lỗi
                        return await searchMoviesFallback(userQuery);
                    }
                } catch (error) {
                    console.error('Lỗi khi tìm phim:', error);
                    return await searchMoviesFallback(userQuery);
                }
            }

            // Fallback tìm phim nếu API mới lỗi
            async function searchMoviesFallback(userQuery) {
                try {
                    const response = await fetch('/api/chatbot/movies', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            search: extractSearchKeyword(userQuery),
                            limit: 6
                        })
                    });

                    if (response.ok) {
                        const data = await response.json();
                        return data.success ? data.data.movies : [];
                    }
                } catch (error) {
                    console.error('Fallback search error:', error);
                }
                return [];
            }

            // ==================== HÀM FORMAT DANH SÁCH PHIM ====================
            function formatMovieList(movies, userQuery) {
                if (!movies || movies.length === 0) {
                    return 'Không tìm thấy phim nào phù hợp với "<strong>' + userQuery + '</strong>".';
                }

                let response = `<strong>🎬 Tìm thấy ${movies.length} phim cho "${userQuery}":</strong><br><br>`;

                movies.forEach((movie, index) => {
                    // QUAN TRỌNG: Tạo URL đến trang chi tiết phim của bạn
                    const movieUrl = `/phim/${movie.slug}`;

                    response += `
            <div class="movie-item">
                <div class="movie-title">
                    <a href="${movieUrl}" target="_blank">${index + 1}. ${movie.title}</a>
                </div>
                <div class="movie-meta">
                    ${movie.year ? `<span>📅 ${movie.year}</span>` : ''}
                    ${movie.quality ? `<span>🎬 ${movie.quality}</span>` : ''}
                    ${movie.duration ? `<span>⏱️ ${movie.duration}</span>` : ''}
                </div>
            </div>`;
                });

                response += `<br><strong>👉 Bấm vào tên phim để xem chi tiết và xem phim!</strong>`;
                return response;
            }

            // ==================== CÁC HÀM HỖ TRỢ ====================
            function extractSearchKeyword(query) {
                // Loại bỏ các từ không cần thiết
                const stopWords = ['tìm', 'phim', 'cho', 'tôi', 'xem', 'có', 'nào', 'không', 'về'];
                const words = query.toLowerCase().split(' ').filter(word =>
                    !stopWords.includes(word) && word.length > 2
                );

                return words.length > 0 ? words.slice(0, 2).join(' ') : 'hot';
            }

            function showTypingIndicator() {
                const typingDiv = document.createElement('div');
                typingDiv.className = 'message bot-message typing-indicator';
                typingDiv.innerHTML = `
        <div class="message-avatar">
            <i class="fas fa-robot"></i>
        </div>
        <div class="message-content">
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>`;
                chatbotMessages.appendChild(typingDiv);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }

            function hideTypingIndicator() {
                const typingIndicator = document.querySelector('.typing-indicator');
                if (typingIndicator) typingIndicator.remove();
            }

            // ==================== EVENT HANDLERS ====================
            async function sendMessage() {
                if (isSending) return;

                const message = chatbotText.value.trim();
                if (message === '') return;

                isSending = true;
                chatbotSend.disabled = true;
                chatbotSend.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                // Add user message
                addMessage(message, 'user');
                chatbotText.value = '';

                try {
                    // Get AI response
                    const botResponse = await getBotResponse(message);
                    addMessage(botResponse, 'bot');
                } catch (error) {
                    console.error('Chat error:', error);
                    addMessage('Xin lỗi, có lỗi xảy ra. Vui lòng thử lại sau!', 'bot');
                } finally {
                    isSending = false;
                    chatbotSend.disabled = false;
                    chatbotSend.innerHTML = '<i class="fas fa-paper-plane"></i>';
                }
            }

            function addMessage(content, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${sender}-message`;

                const now = new Date();
                const timeString = now.getHours().toString().padStart(2, '0') + ':' +
                    now.getMinutes().toString().padStart(2, '0');

                messageDiv.innerHTML = `
        <div class="message-avatar">
            <i class="fas fa-${sender === 'bot' ? 'robot' : 'user'}"></i>
        </div>
        <div class="message-content">
            <div>${content}</div>
            <small>${timeString}</small>
        </div>`;

                chatbotMessages.appendChild(messageDiv);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }

            // Send on button click
            chatbotSend.addEventListener('click', sendMessage);

            // Send on Enter key
            chatbotText.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            // Auto-focus input when chatbot opens
            chatbotContainer.addEventListener('click', function(e) {
                if (e.target === this || e.target.closest('#chatbot-messages')) {
                    chatbotText.focus();
                }
            });

            // Close chatbot when clicking outside (on mobile)
            document.addEventListener('click', function(e) {
                if (!chatbotContainer.contains(e.target) && !chatbotToggle.contains(e.target)) {
                    if (window.innerWidth <= 768) {
                        chatbotContainer.classList.remove('active');
                    }
                }
            });
        });
    </script>


    <!--------------------- Toast Notification Container ------------------>
    <div id="toast-container"></div>

    <script>
        // Hiển thị thông báo khi trang load
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const paymentStatus = urlParams.get('payment');

            if (paymentStatus === 'success') {
                const amount = urlParams.get('amount');
                const message = urlParams.get('message') || 'Thanh toán thành công!';

                showSuccessToast(message, amount);
                clearQueryString();
            }

            if (paymentStatus === 'error') {
                const errorMessage = urlParams.get('message') || 'Thanh toán thất bại!';
                showErrorToast(errorMessage);
                clearQueryString();
            }
        });

        function showSuccessToast(message, amount) {
            const toast = createToastElement('success');

            toast.innerHTML = `
        <div class="toast-icon">🎉</div>
        <div class="toast-content">
            <h4>${message}</h4>
            <div class="price-display">
                <span class="price-icon">💰</span>
                <span class="price-amount">${formatCurrency(amount)}₫</span>
            </div>
        </div>
        <button class="toast-close">&times;</button>
    `;

            setupToastEvents(toast);
        }

        function showErrorToast(message) {
            const toast = createToastElement('error');

            toast.innerHTML = `
        <div class="toast-icon">❌</div>
        <div class="toast-content">
            <h4>${message}</h4>
        </div>
        <button class="toast-close">&times;</button>
    `;

            setupToastEvents(toast);
        }

        function createToastElement(type) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `payment-toast ${type}`;
            container.appendChild(toast);
            return toast;
        }

        function setupToastEvents(toast) {
            // Tự động ẩn sau 6 giây
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.5s ease';
                setTimeout(() => toast.remove(), 500);
            }, 6000);

            // Nút đóng
            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => {
                toast.style.animation = 'slideOutRight 0.5s ease';
                setTimeout(() => toast.remove(), 500);
            });
        }

        function formatCurrency(amount) {
            return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function clearQueryString() {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>

    <style>
        #toast-container {
            position: fixed;
            top: 25px;
            right: 25px;
            z-index: 999999;
            pointer-events: none;
        }

        .payment-toast {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 25px;
            width: 380px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            animation: slideInRight 0.5s ease;
            border-left: 5px solid;
            pointer-events: auto;
            position: relative;
            overflow: hidden;
        }

        .payment-toast.success {
            border-left-color: #00C851;
        }

        .payment-toast.error {
            border-left-color: #ff4444;
        }

        .toast-icon {
            font-size: 2.8rem;
            margin-right: 20px;
            filter: drop-shadow(0 3px 5px rgba(0, 0, 0, 0.1));
        }

        .toast-content {
            flex: 1;
        }

        .toast-content h4 {
            margin: 0 0 15px 0;
            font-size: 1.4rem;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1.3;
        }

        .payment-toast.success .toast-content h4 {
            color: #00C851;
        }

        .payment-toast.error .toast-content h4 {
            color: #ff4444;
        }

        .price-display {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .price-icon {
            font-size: 1.8rem;
        }

        .price-amount {
            font-size: 1.6rem;
            font-weight: 800;
            color: #2c3e50;
            letter-spacing: 0.5px;
        }

        .toast-close {
            background: rgba(0, 0, 0, 0.05);
            border: none;
            font-size: 1.8rem;
            color: #95a5a6;
            cursor: pointer;
            padding: 5px 12px;
            border-radius: 50%;
            line-height: 1;
            transition: all 0.3s ease;
            margin-left: 10px;
            font-weight: 300;
        }

        .toast-close:hover {
            background: rgba(0, 0, 0, 0.1);
            color: #e74c3c;
            transform: rotate(90deg);
        }

        /* Animation */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Progress bar */
        .payment-toast::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, #00C851, #2ecc71);
            animation: progressBar 6s linear forwards;
        }

        .payment-toast.error::after {
            background: linear-gradient(90deg, #ff4444, #e74c3c);
        }

        @keyframes progressBar {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            #toast-container {
                top: 15px;
                right: 15px;
                left: 15px;
            }

            .payment-toast {
                width: auto;
                padding: 20px;
            }

            .toast-content h4 {
                font-size: 1.2rem;
            }

            .price-amount {
                font-size: 1.4rem;
            }
        }
    </style>
    <!-- THÊM PHẦN NÀY SAU TOAST CONTAINER -->
    <div class="modal fade" id="banner_quangcao" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
            <div class="modal-content" style="background: transparent; border: none;">
                <div class="modal-body p-0">
                    <button type="button" class="close position-absolute"
                        style="top: -35px; right: -10px; z-index: 1000; color: white; font-size: 30px;"
                        data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>

                    @if (isset($ads_popup) && count($ads_popup) > 0)
                        @foreach ($ads_popup as $ad)
                            <a href="{{ $ad->ads_link }}" target="_blank" rel="nofollow">
                                <img src="{{ asset('uploads/ads/' . $ad->ads_gif) }}" alt="{{ $ad->ads_name }}"
                                    style="width: 100%; border-radius: 10px; cursor: pointer;">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
