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
   <style>
    /* CSS cải tiến header - phiên bản tối giản */
    #header {
        background: #1a2b3a !important;
        padding: 8px 0 !important;
        border-bottom: 1px solid #2d4254 !important;
        min-height: 80px !important;
    }

    #headwrap {
        align-items: center !important;
        display: flex !important;
        flex-wrap: nowrap !important;
        gap: 15px !important;
        justify-content: space-between !important;
        height: 64px !important;
    }

    /* Logo nhỏ gọn */
    .slogan {
        flex: 0 0 auto !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .slogan a.logo {
        display: inline-block !important;
        transition: all 0.3s ease !important;
    }

    .slogan a.logo:hover {
        transform: translateY(-1px) !important;
    }

    .slogan a.logo img {
        height: 50px !important;
        width: auto !important;
        object-fit: contain !important;
        filter: brightness(1.1) !important;
    }

    /* Thanh tìm kiếm nhỏ gọn */
    .halim-search-form {
        flex: 0 1 350px !important;
        min-width: 280px !important;
        max-width: 350px !important;
        position: relative !important;
        margin: 0 auto !important;
    }

    .form-timkiem .form-group {
        margin: 0 !important;
    }

    .form-timkiem .input-group {
        display: flex !important;
        gap: 0 !important;
    }

    .form-timkiem form {
        display: flex !important;
        width: 100% !important;
        background: rgba(255, 255, 255, 0.95) !important;
        border-radius: 20px !important;
        overflow: hidden !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
        border: 1px solid #3a5068 !important;
        transition: all 0.3s ease !important;
    }

    .form-timkiem form:focus-within {
        box-shadow: 0 4px 12px rgba(68, 226, 255, 0.2) !important;
        border-color: #44e2ff !important;
    }

    .form-timkiem input {
        flex: 1 !important;
        border: none !important;
        padding: 8px 15px !important;
        background: transparent !important;
        font-size: 14px !important;
        color: #333 !important;
        outline: none !important;
        min-width: 0 !important;
    }

    .form-timkiem input::placeholder {
        color: #666 !important;
        font-size: 13px !important;
    }

    .form-timkiem button {
        background: #44e2ff !important;
        color: #1a2b3a !important;
        border: none !important;
        padding: 8px 15px !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        white-space: nowrap !important;
    }

    .form-timkiem button:hover {
        background: #3bd1e9 !important;
    }

    /* Phần bên phải để chèn banner */
    .col-md-4.hidden-xs {
        flex: 0 0 300px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
        height: 100% !important;
    }

    /* Banner quảng cáo header */
    .header-banner {
        height: 60px !important;
        width: 100% !important;
        background: #2d4254 !important;
        border-radius: 6px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #89b8d6 !important;
        font-size: 12px !important;
        border: 1px dashed #44e2ff !important;
    }

    /* Navigation cũng ngắn hơn */
    .navbar-container {
        background: #1a2b3a !important;
        border-bottom: 1px solid #2d4254 !important;
    }

    .halim-navbar .navbar-nav > li > a {
        padding: 12px 15px !important;
        font-size: 13px !important;
    }

    /* Kết quả tìm kiếm */
    ul#result {
        position: absolute !important;
        z-index: 9999 !important;
        background: #1b2d3c !important;
        width: 100% !important;
        padding: 8px !important;
        margin: 5px 0 0 0 !important;
        border-radius: 0 0 10px 10px !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
        border: 1px solid #44e2ff !important;
        border-top: none !important;
        max-height: 300px !important;
        overflow-y: auto !important;
    }

    #result li {
        padding: 8px 12px !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        color: #e0e0e0 !important;
        font-size: 13px !important;
    }

    #result li:hover {
        background: rgba(68, 226, 255, 0.1) !important;
    }

    #result li img {
        width: 40px !important;
        height: 40px !important;
        object-fit: cover !important;
        border-radius: 3px !important;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .halim-search-form {
            flex: 0 1 300px !important;
            min-width: 250px !important;
        }
        
        .col-md-4.hidden-xs {
            flex: 0 0 250px !important;
        }
    }

    @media (max-width: 992px) {
        #headwrap {
            flex-wrap: wrap !important;
            height: auto !important;
            gap: 10px !important;
        }
        
        .halim-search-form {
            flex: 1 !important;
            max-width: 100% !important;
            order: 3 !important;
        }
        
        .col-md-4.hidden-xs {
            display: none !important;
        }
    }

    @media (max-width: 576px) {
        .form-timkiem form {
            border-radius: 15px !important;
        }
        
        .form-timkiem input {
            padding: 10px 15px !important;
        }
        
        .form-timkiem button {
            padding: 10px 15px !important;
        }
        
        .slogan a.logo img {
            height: 40px !important;
        }
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
                                                ref="{{ route('genre', $gen->slug) }}">{{ $gen->title }}</a></li>
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
                            <li class="mega dropdown">
                                <a title="Tài khoản" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                    aria-haspopup="true">

                                    Tài khoản @if (Auth::user())
                                        : {{ Auth::user()->name }} <span class="caret"></span>
                                    @endif </a>
                                <ul role="menu" class=" dropdown-menu">
                                    @if (!Auth::user())
                                        <li><a title="đăng nhập bằng google" {{--  href="{{ route('login-by-google') }}">Đăng nhập google</a></li> --}} <li><a
                                                title="đăng nhập bằng facebook" {{-- href="{{ route('login-by-facebook') }}">Đăng nhập facebook</a></li>  --}} @else <li><a
                                                        title="Đăng xuất" href="{{ route('logout-home') }}">Đăng
                                                        xuất</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul>

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
    <style type="text/css">
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
    <script type="text/javascript">
        $(window).on('load', function() {
            var segment = $('.segment').val();
            if (segment == '') {
                $('#banner_quangcao').modal('show');
            }

        });
    </script>
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
    </style>

    <style>
        #overlay_pc {
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
        {{-- <div id="hide_balloon_ck"><a href="javascript:hide_balloon_ck()">Tắt Quảng Cáo [X]</a>
               </div> --}}
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
    </div>
    <style>
        .sidebar_ads_left {
            position: fixed;
            display: flex;
            width: 100%;
            top: 35%;
            right: 8%;
            z-index: 8000;
        }

        .sidebar_ads_left ul li {
            list-style: none;

        }
    </style>
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

</body>

</html>
