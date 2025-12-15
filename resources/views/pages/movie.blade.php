@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a
                                        href="{{ route('category', [$movie->category->slug]) }}">{{ $movie->category->title }}</a>
                                    »
                                    <span>
                                        <a
                                            href="{{ route('country', [$movie->country->slug]) }}">{{ $movie->country->title }}</a>
                                        »
                                        @foreach ($movie->movie_genre as $gen)
                                            <a href="{{ route('genre', [$gen->slug]) }}">{{ $gen->title }}</a> »
                                        @endforeach
                                        <span class="breadcrumb_last" aria-current="page">{{ $movie->title }}</span>
                                    </span>
                                </span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="content" class="test">
                <div class="clearfix wrap-content">

                    <div class="halim-movie-wrapper">
                        <div class="title-block">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                <div class="halim-pulse-ring"></div>
                            </div>
                            <div class="title-wrapper" style="font-weight: bold;">
                                Bookmark
                            </div>
                        </div>
                        <div class="movie_info col-xs-12">
                            <div class="movie-poster col-md-3">

                                @php
                                    $img = substr($movie->image, 0, 5);
                                @endphp
                                @if ($img != 'https')
                                    <img class="movie-thumb" src="{{ asset('uploads/movie/' . $movie->image) }}"
                                        alt="{{ $movie->title }}">
                                @else
                                    <img class="movie-thumb" src="{{ $movie->image }}" alt="{{ $movie->title }}">
                                @endif
                                @if ($movie->resolution != 5)
                                    @if ($episode_current_list_count > 0)
                                        <div class="bwa-content">
                                            <div class="loader"></div>
                                            <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $episode_tapdau->episode . '/server-' . $episode_tapdau->server) }}"
                                                class="bwac-btn">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <a href="#watch_trailer" style="display: block;"
                                        class="btn btn-primary watch_trailer">Xem Trailer</a>
                                @endif

                            </div>
                            <div class="film-poster col-md-9">
                                <h1 class="movie-title title-1"
                                    style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                    {{ $movie->title }}</h1>
                                <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->name_eng }}</h2>
                                <ul class="list-info-group">
                                    <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                                            @if ($movie->resolution == 0)
                                                HD
                                            @elseif($movie->resolution == 1)
                                                SD
                                            @elseif($movie->resolution == 2)
                                                HDCam
                                            @elseif($movie->resolution == 3)
                                                Cam
                                            @elseif($movie->resolution == 4)
                                                FullHD
                                            @else
                                                Trailer
                                            @endif
                                        </span>
                                        @if ($movie->resolution != 5)
                                            <span class="episode">
                                                @if ($movie->phude == 0)
                                                    Phụ đề
                                                @else
                                                    Thuyết minh
                                                @endif
                                            </span>
                                        @endif
                                    </li>

                                    <li class="list-info-group-item"><span>Thời lượng</span> :
                                        {{ $movie->thoiluong }}


                                    </li>
                                    <li class="list-info-group-item"><span>Tập phim</span> :
                                        @if ($movie->thuocphim == 'phimbo')
                                            {{ $episode_current_list_count }}/{{ $movie->sotap }} -
                                            @if ($episode_current_list_count == $movie->sotap)
                                                Hoàn thành
                                            @else
                                                Đang cập nhập
                                            @endif
                                        @else
                                            FullHD
                                            HD
                                        @endif

                                    </li>

                                    <li class="list-info-group-item"><span>Thể loại</span> :
                                        @foreach ($movie->movie_genre as $gen)
                                            <a href="{{ route('genre', $gen->slug) }}"
                                                rel="category tag">{{ $gen->title }}</a>
                                        @endforeach

                                    </li>
                                    <li class="list-info-group-item"><span>Danh mục</span> :
                                        <a href="{{ route('category', $movie->category->slug) }}"
                                            rel="category tag">{{ $movie->category->title }}</a>
                                    </li>
                                    <li class="list-info-group-item"><span>Quốc gia</span> :
                                        <a href="{{ route('country', $movie->country->slug) }}"
                                            rel="tag">{{ $movie->country->title }}</a>
                                    </li>
                                    <li class="list-info-group-item"><span>Tập phim mới nhất</span> :
                                        @if ($episode_current_list_count > 0)

                                            @if ($movie->thuocphim == 'phimbo' || $episode_current_list_count > 3)
                                                @foreach ($episode as $key => $ep)
                                                    <a href="{{ url('xem-phim/' . $ep->movie->slug . '/tap-' . $ep->episode . '/server-' . $ep->server) }}"
                                                        rel="tag">Tập {{ $ep->episode }}</a>
                                                @endforeach
                                            @else
                                                @foreach ($episode->take(1) as $key => $ep)
                                                    <a href="{{ url('xem-phim/' . $ep->movie->slug . '/tap-' . $ep->episode . '/server-' . $ep->server) }}"
                                                        rel="tag">Tập {{ $ep->episode }}</a>
                                                @endforeach
                                            @endif
                                        @else
                                            Đang cập nhật

                                        @endif
                                    </li>
                                    <ul class="list-inline rating" title="Average Rating">

                                        @for ($count = 1; $count <= 5; $count++)
                                            @php

                                                if ($count <= $rating) {
                                                    $color = 'color:#ffcc00;'; //mau vang
                                                } else {
                                                    $color = 'color:#ccc;'; //mau xam
                                                }

                                            @endphp

                                            <li title="star_rating" id="{{ $movie->id }}-{{ $count }}"
                                                data-index="{{ $count }}" data-movie_id="{{ $movie->id }}"
                                                data-rating="{{ $rating }}" class="rating"
                                                style="cursor:pointer; {{ $color }} 

                                                    font-size:30px;">
                                                &#9733;</li>
                                        @endfor

                                    </ul>

                                    <span class="total_rating"> Đánh giá : {{ $rating }}/{{ $count_total }}
                                        lượt</span>

                                </ul>
                                <div class="movie-trailer">
                                    @php
                                        $current_url = Request::url();
                                    @endphp
                                    <div class="fb-like" data-href="{{ $current_url }}" data-width=""
                                        data-layout="button_count" data-action="like" data-size="small" data-share="true">
                                    </div>
                                    <div class="fb-save" data-uri="{{ $current_url }}" data-size="small"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="halim_trailer"></div>
                    <div class="clearfix"></div>
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                {{ $movie->description }}
                            </article>
                        </div>
                    </div>
                    <!--Tags phim-->
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Tags phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                @if ($movie->tags != null)
                                    @php
                                        $tags = [];
                                        $tags = explode(',', $movie->tags);

                                    @endphp
                                    @foreach ($tags as $key => $tag)
                                        <a href="{{ url('tag/' . $tag) }}">{{ $tag }}</a>
                                    @endforeach
                                @else
                                    {{ $movie->title }}
                                @endif
                            </article>
                        </div>
                    </div>
                    <!--Comment fb-->
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">

                                <form action="{{ route('insert-comment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                    <input type="hidden" name="visitor_id" value="{{ session()->getId() }}">
                                    @if (Auth::check())
                                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                        <p>Bình luận dưới tên: <strong>{{ Auth::user()->name }}</strong></p>
                                    @else
                                        <input type="text" name="name" placeholder="Họ tên" required>
                                        <input type="email" name="email" placeholder="Email" required>
                                    @endif
                                    <textarea name="comment" placeholder="Viết bình luận..." required></textarea>
                                    <button type="submit">Gửi bình luận</button>
                                </form>

                                <hr>

                                <div class="comment-section">
                                    <h4>Các bình luận ({{ $comments->count() }})</h4>

                                    @if ($comments->count() > 0)
                                        @foreach ($comments as $com)
                                            <div class="comment-item" id="comment-{{ $com->id }}">
                                                <div class="comment-header">
                                                    <div>
                                                        <span class="comment-name">{{ $com->name }}</span>
                                                        <small class="text-muted">({{ $com->email }})</small>
                                                    </div>
                                                    <div class="comment-actions">
                                                        <span
                                                            class="comment-date">{{ date('d/m/Y H:i', strtotime($com->date_created)) }}</span>

                                                        @php
                                                            $canEdit = false;
                                                            // Admin luôn có quyền
                                                            if (Auth::check() && Auth::user()->role == 'admin') {
                                                                $canEdit = true;
                                                            }
                                                            // Kiểm tra theo email đơn giản
                                                            else {
                                                                // Lấy email hiện tại
                                                                $currentEmail = '';
                                                                if (Auth::check()) {
                                                                    $currentEmail = Auth::user()->email;
                                                                } else {
                                                                    // Lấy từ input email trong form (nếu có)
                                                                    $currentEmail = old('email', '');
                                                                }

                                                                if ($currentEmail && $com->email == $currentEmail) {
                                                                    $canEdit = true;
                                                                }
                                                            }
                                                        @endphp

                                                        @if ($canEdit)
                                                            <button class="btn-edit-comment btn-sm btn-link"
                                                                data-id="{{ $com->id }}">Sửa</button>
                                                            <button class="btn-delete-comment btn-sm btn-link text-danger"
                                                                data-id="{{ $com->id }}">Xóa</button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <p class="comment-content">{{ $com->comment }}</p>

                                                @if ($canEdit)
                                                    <div class="edit-comment-form" id="edit-form-{{ $com->id }}"
                                                        style="display: none;">
                                                        <textarea class="form-control edit-comment-text" rows="3">{{ $com->comment }}</textarea>
                                                        <div class="mt-2">
                                                            <button class="btn btn-sm btn-success btn-save-edit"
                                                                data-id="{{ $com->id }}">Lưu</button>
                                                            <button class="btn btn-sm btn-secondary btn-cancel-edit"
                                                                data-id="{{ $com->id }}">Hủy</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="no-comments">
                                            Chưa có bình luận nào. Hãy là người đầu tiên bình luận!
                                        </div>
                                    @endif
                                </div>

                            </article>
                        </div>
                    </div>

                    </article>
                </div>
    </div>
    @if ($movie->trailer != null)
        <!--Trailer phim-->
        <div class="section-bar clearfix">
            <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>

        </div>
        <div class="entry-content htmlwrap clearfix">
            <div class="video-item halim-entry-box">
                @php
                    $trailer = substr($movie->trailer, 17);
                @endphp
                <article id="watch_trailer" class="item-content">

                    <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $trailer }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>

                </article>
            </div>
        </div>
    @endif
    </div>
    </section>
    <section class="related-movies">
        <div id="halim_related_movies-2xx" class="wrap-slider">
            <div class="section-bar clearfix">
                <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
            </div>
            <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                @foreach ($related as $key => $hot)
                    <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{ route('movie', $hot->slug) }}" title="{{ $hot->title }}">
                                @php
                                    $img = substr($hot->image, 0, 5);
                                @endphp
                                @if ($img != 'https')
                                    <figure><img class="lazy img-responsive"
                                            src="{{ asset('uploads/movie/' . $hot->image) }}" alt="error"
                                            title="{{ $hot->title }}"></figure>
                                @else
                                    <figure><img class="lazy img-responsive" src="{{ $hot->image }}" alt="error"
                                            title="{{ $hot->title }}"></figure>
                                @endif
                                <span class="status">
                                    @if ($hot->resolution == 0)
                                        HD
                                    @elseif($hot->resolution == 1)
                                        SD
                                    @elseif($hot->resolution == 2)
                                        HDCam
                                    @elseif($hot->resolution == 3)
                                        Cam
                                    @else
                                        FullHD
                                    @endif

                                </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if ($hot->phude == 0)
                                        Phụ đề
                                    @else
                                        Thuyết minh
                                    @endif
                                </span>
                                <div class="icon_overlay"></div>
                                <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title">{{ $hot->title }}</p>
                                        <p class="original_title">{{ $hot->name_eng }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </article>
                @endforeach

            </div>
            <script>
                $(document).ready(function($) {
                    var owl = $('#halim_related_movies-2');
                    owl.owlCarousel({
                        loop: true,
                        margin: 4,
                        autoplay: true,
                        autoplayTimeout: 4000,
                        autoplayHoverPause: true,
                        nav: true,
                        navText: ['<i class="hl-down-open rotate-left"></i>',
                            '<i class="hl-down-open rotate-right"></i>'
                        ],
                        responsiveClass: true,
                        responsive: {
                            0: {
                                items: 2
                            },
                            480: {
                                items: 3
                            },
                            600: {
                                items: 4
                            },
                            1000: {
                                items: 4
                            }
                        }
                    })
                });
            </script>
        </div>
    </section>
    </main>
    @include('pages.include.sidebar')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        console.log('Script loaded'); // Thêm dòng này
        
        // Gửi bình luận
        $('#commentForm').submit(function(e) {
            e.preventDefault();
            console.log('Form submitted'); // Thêm dòng này
            
            $.ajax({
                url: '{{ route("insert-comment") }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    console.log('Response:', response); // Thêm dòng này
                    // ...
                }
            });
        });
        
        // Hiển thị form chỉnh sửa
        $(document).on('click', '.btn-edit-comment', function() {
            console.log('Edit button clicked, ID:', $(this).data('id')); // Thêm dòng này
            var commentId = $(this).data('id');
            $('#comment-' + commentId + ' .comment-content').hide();
            $('#edit-form-' + commentId).show();
        });
        
        // Lưu chỉnh sửa
        $(document).on('click', '.btn-save-edit', function() {
            var commentId = $(this).data('id');
            console.log('Save edit clicked, ID:', commentId); // Thêm dòng này
            
            var newContent = $('#edit-form-' + commentId + ' textarea').val();
            
            $.ajax({
                url: '/comment/edit/' + commentId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    comment: newContent
                },
                success: function(response) {
                    console.log('Edit response:', response); // Thêm dòng này
                    if(response.success) {
                        $('#comment-' + commentId + ' .comment-content').text(newContent).show();
                        $('#edit-form-' + commentId).hide();
                        alert('Bình luận đã được cập nhật');
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Edit error:', error); // Thêm dòng này
                    console.log('Status:', status);
                    console.log('XHR:', xhr);
                }
            });
        });
        
        // Xóa bình luận
        $(document).on('click', '.btn-delete-comment', function() {
            var commentId = $(this).data('id');
            console.log('Delete button clicked, ID:', commentId); // Thêm dòng này
            
            if(!confirm('Bạn có chắc chắn muốn xóa bình luận này?')) {
                return;
            }
            
            $.ajax({
                url: '/comment/delete/' + commentId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Delete response:', response); // Thêm dòng này
                    if(response.success) {
                        $('#comment-' + commentId).remove();
                        alert('Bình luận đã được xóa');
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Delete error:', error); // Thêm dòng này
                }
            });
        });
    });
    </script>
@endsection

