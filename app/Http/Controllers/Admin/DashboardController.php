<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\User;
use App\Models\Ads;
use App\Models\AdsNetwork;
use App\Models\Comments;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Thống kê cơ bản
            $totalEpisodes = Episode::count();
            $totalAds = Ads::count();
            $totalAdNetworks = AdsNetwork::count();
            $totalComments = Comments::count();
            
            // Tổng số phim - THÊM DÒNG NÀY
            $movie_total = Movie::count();
            
            // Lấy phim mới nhất
            $recentMovies = Movie::with('category')
                ->latest()
                ->take(5)
                ->get();

            // Thống kê theo danh mục
            $moviesByCategory = Category::withCount('movies')->get();

            // Thống kê phim hot
            $hotMovies = Movie::where('phim_hot', 1)
                ->where('status', 1)
                ->orderBy('ngaycapnhat', 'DESC')
                ->take(10)
                ->get();

        } catch (\Exception $e) {
            // Nếu có lỗi, set giá trị mặc định
            $totalEpisodes = 0;
            $totalAds = 0;
            $totalAdNetworks = 0;
            $totalComments = 0;
            $movie_total = 0; // THÊM DÒNG NÀY
            $recentMovies = collect();
            $moviesByCategory = collect();
            $hotMovies = collect();
        }

        // Trả về view home.blade.php (file ở ngoài thư mục views)
        return view('home', [
            // Các biến thống kê
            'totalEpisodes' => $totalEpisodes,
            'totalComments' => $totalComments,
            'totalAds' => $totalAds,
            'totalAdNetworks' => $totalAdNetworks,
            'movie_total' => $movie_total, // THÊM DÒNG NÀY
            'recentMovies' => $recentMovies,
            'moviesByCategory' => $moviesByCategory,
            'hotMovies' => $hotMovies,
        ]);
    }
}