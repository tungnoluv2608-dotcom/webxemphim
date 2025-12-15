{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="main-page">
    <!-- Phim mới nhất và Phim hot -->
    <div class="row" style="margin-top: 20px;">
        <!-- Phim mới nhất -->
        <div class="col-md-6">
            <div class="panel panel-default" style="background: white; border-radius: 5px; padding: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h4 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <i class="fa fa-star"></i> Phim mới nhất
                </h4>
                <div>
                    @foreach($recentMovies as $movie)
                    <div style="padding: 8px 0; border-bottom: 1px solid #f5f5f5;">
                        <a href="{{ route('movie.edit', $movie->id) }}" style="color: #333; text-decoration: none;">
                            {{ Str::limit($movie->title, 25) }}
                        </a>
                        <br>
                        <small style="color: #888; font-size: 12px;">
                            {{ $movie->created_at->format('d/m/Y') }}
                        </small>
                    </div>
                    @endforeach
                    @if($recentMovies->isEmpty())
                    <div style="text-align: center; color: #888; padding: 20px;">
                        Chưa có phim nào
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Phim hot -->
        <div class="col-md-6">
            <div class="panel panel-default" style="background: white; border-radius: 5px; padding: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h4 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <i class="fa fa-fire"></i> Phim Hot
                </h4>
                <div>
                    @foreach($hotMovies as $movie)
                    <div style="padding: 8px 0; border-bottom: 1px solid #f5f5f5;">
                        <a href="{{ route('movie.edit', $movie->id) }}" style="color: #333; text-decoration: none;">
                            {{ Str::limit($movie->title, 25) }}
                        </a>
                        <br>
                        <small style="color: #888; font-size: 12px;">
                            <span style="background: #ff6b6b; color: white; padding: 2px 5px; border-radius: 3px; font-size: 10px;">Hot</span>
                            {{ $movie->ngaycapnhat ? \Carbon\Carbon::parse($movie->ngaycapnhat)->format('d/m/Y') : 'N/A' }}
                        </small>
                    </div>
                    @endforeach
                    @if($hotMovies->isEmpty())
                    <div style="text-align: center; color: #888; padding: 20px;">
                        Chưa có phim hot
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Phân bổ phim theo danh mục -->
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="panel panel-default" style="background: white; border-radius: 5px; padding: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h4 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <i class="fa fa-chart-pie"></i> Phân bổ phim theo danh mục
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered" style="margin-bottom: 0;">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th>Danh mục</th>
                                <th>Số lượng phim</th>
                                <th>Tỷ lệ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($moviesByCategory as $category)
                            <tr>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->movies_count }}</td>
                                <td>
                                    <div style="background: #e9ecef; border-radius: 3px; height: 20px;">
                                        <div style="background: #007bff; height: 100%; border-radius: 3px; text-align: center; color: white; font-size: 12px; line-height: 20px; width: {{ ($category->movies_count / max($movie_total, 1)) * 100 }}%;">
                                            {{ round(($category->movies_count / max($movie_total, 1)) * 100, 1) }}%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if($moviesByCategory->isEmpty())
                            <tr>
                                <td colspan="3" style="text-align: center; color: #888;">Chưa có danh mục nào</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Thao tác nhanh -->
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="panel panel-default" style="background: white; border-radius: 5px; padding: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h4 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <i class="fa fa-bolt"></i> Thao tác nhanh
                </h4>
                <div class="row">
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <a href="{{ route('movie.create') }}" style="display: block; background: #007bff; color: white; padding: 10px; text-align: center; border-radius: 3px; text-decoration: none;">
                            <i class="fa fa-plus"></i> Thêm phim mới
                        </a>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <a href="{{ route('leech-movie') }}" style="display: block; background: #28a745; color: white; padding: 10px; text-align: center; border-radius: 3px; text-decoration: none;">
                            <i class="fa fa-plus-circle"></i> Thêm tập phim
                        </a>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <a href="{{ route('category.create') }}" style="display: block; background: #17a2b8; color: white; padding: 10px; text-align: center; border-radius: 3px; text-decoration: none;">
                            <i class="fa fa-tags"></i> Thêm danh mục
                        </a>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <a href="{{ route('ads.create') }}" style="display: block; background: #ffc107; color: #212529; padding: 10px; text-align: center; border-radius: 3px; text-decoration: none;">
                            <i class="fa fa-ad"></i> Thêm quảng cáo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection