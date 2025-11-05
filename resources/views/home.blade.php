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
    /* Header Styles */
    .header-compact {
        background: #1a2b3a;
        padding: 8px 0;
        border-bottom: 1px solid #2d4254;
        min-height: 80px;
    }

    .header-wrapper {
        align-items: center;
        display: flex;
        flex-wrap: nowrap;
        gap: 15px;
        justify-content: space-between;
        height: 64px;
    }

    /* Logo compact */
    .logo-section {
        flex: 0 0 auto;
        margin: 0;
        padding: 0;
    }

    .logo-link {
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .logo-link:hover {
        transform: translateY(-1px);
    }

    .logo-image {
        height: 50px;
        width: auto;
        object-fit: contain;
        filter: brightness(1.1);
    }

    /* Search bar compact */
    .search-section {
        flex: 0 1 350px;
        min-width: 280px;
        max-width: 350px;
        position: relative;
        margin: 0 auto;
    }

    .search-form .form-group {
        margin: 0;
    }

    .search-form .input-group {
        display: flex;
        gap: 0;
    }

    .search-form form {
        display: flex;
        width: 100%;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #3a5068;
        transition: all 0.3s ease;
    }

    .search-form form:focus-within {
        box-shadow: 0 4px 12px rgba(68, 226, 255, 0.2);
        border-color: #44e2ff;
    }

    .search-input {
        flex: 1;
        border: none;
        padding: 8px 15px;
        background: transparent;
        font-size: 14px;
        color: #333;
        outline: none;
        min-width: 0;
    }

    .search-input::placeholder {
        color: #666;
        font-size: 13px;
    }

    .search-button {
        background: #44e2ff;
        color: #1a2b3a;
        border: none;
        padding: 8px 15px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: background 0.3s ease;
        white-space: nowrap;
    }

    .search-button:hover {
        background: #3bd1e9;
    }

    /* Right section for banner */
    .banner-section {
        flex: 0 0 300px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        height: 100%;
    }

    /* Header banner ad */
    .header-banner {
        height: 60px;
        width: 100%;
        background: #2d4254;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #89b8d6;
        font-size: 12px;
        border: 1px dashed #44e2ff;
    }

    /* Navigation */
    .navbar-compact {
        background: #1a2b3a;
        border-bottom: 1px solid #2d4254;
    }

    .halim-navbar .navbar-nav > li > a {
        padding: 12px 15px;
        font-size: 13px;
    }

    /* Search results */
    .search-results {
        position: absolute;
        z-index: 9999;
        background: #1b2d3c;
        width: 100%;
        padding: 8px;
        margin: 5px 0 0 0;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        border: 1px solid #44e2ff;
        border-top: none;
        max-height: 300px;
        overflow-y: auto;
    }

    .search-result-item {
        padding: 8px 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: background 0.2s ease;
        color: #e0e0e0;
        font-size: 13px;
    }

    .search-result-item:hover {
        background: rgba(68, 226, 255, 0.1);
    }

    .search-result-item img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 3px;
    }

    /* Footer styles */
    .footer-title {
        text-transform: uppercase;
        color: #44e2ff;
        font-weight: bold;
    }

    .footer-list {
        padding: 0;
        font-size: 12px;
    }

    .footer-list li {
        padding: 2px 0;
    }

    .footer-list a {
        color: #7d7d7e;
        border-radius: 50%;
    }

    .social-link {
        color: #555;
        font-size: 15px;
    }

    .copyright {
        text-align: center;
        line-height: 32px;
        color: black;
    }

    /* Balloon styles */
    .balloon-list li {
        list-style: none;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .search-section {
            flex: 0 1 300px;
            min-width: 250px;
        }
        
        .banner-section {
            flex: 0 0 250px;
        }
    }

    @media (max-width: 992px) {
        .header-wrapper {
            flex-wrap: wrap;
            height: auto;
            gap: 10px;
        }
        
        .search-section {
            flex: 1;
            max-width: 100%;
            order: 3;
        }
        
        .banner-section {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .search-form form {
            border-radius: 15px;
        }
        
        .search-input {
            padding: 10px 15px;
        }
        
        .search-button {
            padding: 10px 15px;
        }
        
        .logo-image {
            height: 40px;
        }
    }

    /* Additional existing styles */
    #overlay_mb, #overlay_pc {
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

    .float-ck {
        position: fixed;
        bottom: 0px;
        z-index: 9;
    }

    .sidebar-ads {
        position: fixed;
        display: flex;
        width: 100%;
        top: 35%;
        z-index: 8000;
    }

    .sidebar-ads ul li {
        list-style: none;
    }
</style>

</head>

<body class="home blog halimthemes halimmovies" data-masonry="">
    <header id="header" class="header-compact">
        <div class="container">
            <div class="row header-wrapper">
                <div class="col-md-3 col-sm-6 logo-section">
                    <p class=""><a class="logo-link" href="" title="phim hay">
                            <img src="{{ asset('uploads/logo/' . $info->logo) }}" class="logo-image" alt="Logo">
                        </a></p>
                </div>
                <div class="col-md-5 col-sm-6 search-section hidden-xs">
                    <div class="header-nav">
                        <div class="col-xs-12">
                            <div class="form-group search-form">
                                <div class="input-group col-xs-12">
                                    <form action="{{ route('tim-kiem') }}" method="GET">
                                        <input type="text" name="search" id="timkiem" class="search-input"
                                            placeholder="Tìm kiếm phim..." autocomplete="off">
                                        <button class="search-button">Tìm kiếm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs banner-section">
                    <!-- Banner space -->
                </div>
            </div>
        </div>
    </header>

    <!-- Rest of your HTML remains the same, just remove inline styles -->
    <div class="navbar-container navbar-compact">
        <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
                <!-- Navigation content unchanged -->
            </nav>
        </div>
    </div>

    <!-- Page content -->
    <div class="container">
        <div class="row fullwith-slider"></div>
    </div>
    <div class="container">
        <input type="hidden" value="{{ $segment }}" class="segment">
        @yield('content')
        @include('pages.include.banner')
    </div>

    <!-- Footer -->
    <footer id="footer" class="clearfix">
        <div class="container footer-columns">
            <div class="row container">
                <div class="widget about col-xs-12 col-sm-4 col-md-4">
                    <div class="footer-logo">
                        <img src="{{ asset('uploads/logo/' . $info->logo) }}" height="85">
                        <p>{{ $info->description }}</p>
                    </div>
                </div>
                <div class="widget about col-xs-12 col-sm-4 col-md-4">
                    <div class="footer-logo">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="footer-title">Phim mới</h4>
                                <ul class="footer-list">
                                    @foreach ($category_home->random(5) as $key => $cate_footer)
                                        <li><a target="_blank" title="{{ $cate_footer->title }}"
                                                href="{{ route('category', $cate_footer->slug) }}">{{ $cate_footer->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4 class="footer-title">Phim lẻ</h4>
                                <ul class="footer-list">
                                    @foreach ($genre_home->random(5) as $key => $gen_footer)
                                        <li><a target="_blank" title="{{ $gen_footer->title }}"
                                                href="{{ route('genre', $gen_footer->slug . '?phimle') }}">Phim lẻ
                                                {{ $gen_footer->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4 class="footer-title">Phim bộ</h4>
                                <ul class="footer-list">
                                    @foreach ($country_home->random(5) as $key => $country_footer)
                                        <li><a target="_blank" title="{{ $country_footer->title }}"
                                                href="{{ route('country', $country_footer->slug . '?phimbo') }}">Phim bộ
                                                {{ $country_footer->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget about col-xs-12 col-sm-4 col-md-4">
                    <div class="social">
                        <a target="_blank" href="https://telegram.me/@tugpham268" class="call social-link">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span class="info">
                                <span class="follow">Telegram:</span>
                                <span class="num">@tugpham268</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="col-xs-12 col-sm-4 col-md-12">
        <p class="copyright">{{ $info->copyright }}</p>
    </div>

    <!-- Scripts and additional content remain the same -->
    <script type='text/javascript' src='{{ asset('js/bootstrap.min.js?ver=5.7.2') }}' id='bootstrap-js'></script>
    <script type='text/javascript' src='{{ asset('js/owl.carousel.min.js?ver=5.7.2') }}' id='carousel-js'></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <script type='text/javascript' src='{{ asset('js/halimtheme-core.min.js?ver=1626273138') }}' id='halim-init-js'></script>

    <!-- Your existing JavaScript code remains the same -->
</body>
</html>