<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Info;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Ads;
use App\Models\AdsNetWorkScript;
use Carbon\Carbon;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            // PHIM
            $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)
                ->orderBy('ngaycapnhat', 'DESC')->take(30)->get();

            $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)
                ->orderBy('ngaycapnhat', 'DESC')->take(10)->get();

            // DANH MỤC
            $category = Category::orderBy('position', 'ASC')->where('status', 1)->get();
            $genre = Genre::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();

            // TỔNG SỐ 
            $category_total = $category->count();
            $genre_total = $genre->count();
            $country_total = $country->count();
            $movie_total = Movie::count();
            $total_users = \App\Models\User::count();
            $total_users_week = \App\Models\User::whereBetween('created_at', [now()->subWeek(), now()])->count();
            $total_users_month = \App\Models\User::whereMonth('created_at', now()->month)->count();

            // THÔNG TIN WEBSITE
            $info = Info::find(1);

            // QUẢNG CÁO
            $ads_bottom_trai = Ads::where('ads_position', 1)->where('ads_status', 1)
                ->inRandomOrder()->take(1)->get();

            $ads_bottom_phai = Ads::where('ads_position', 2)->where('ads_status', 1)
                ->inRandomOrder()->take(1)->get();

            $ads_bottom_duoihot = Ads::where('ads_position', 4)->where('ads_status', 1)
                ->inRandomOrder()->take(1)->get();

            $ads_bottom_duoi = Ads::where('ads_position', 6)->where('ads_status', 1)
                ->inRandomOrder()->take(3)->get();

            $ads_sidebar_trai = Ads::where('ads_position', 5)->where('ads_status', 1)
                ->inRandomOrder()->take(1)->get();

            $ads_sidebar_phai = Ads::where('ads_position', 8)->where('ads_status', 1)
                ->inRandomOrder()->take(1)->get();

            $ads_popup = Ads::where('ads_position', 9)->where('ads_status', 1)
                ->inRandomOrder()->take(1)->get();

            // ADS NETWORK
            $ads_network = AdsNetWorkScript::with('adsnetwork')
                ->where('status', 1)->orderBy('id', 'DESC')->get();

            $segment = request()->segment(1) ?? 'home';

            // 🔥 SHARE CHO TOÀN BỘ VIEW
            View::share([
                'segment' => $segment,
                'ads_popup' => $ads_popup ?? collect(),
                'ads_network' => $ads_network ?? collect(),
                'ads_sidebar_trai' => $ads_sidebar_trai ?? collect(),
                'ads_sidebar_phai' => $ads_sidebar_phai ?? collect(),
                'ads_bottom_duoi' => $ads_bottom_duoi ?? collect(),
                'ads_bottom_trai' => $ads_bottom_trai ?? collect(),
                'ads_bottom_phai' => $ads_bottom_phai ?? collect(),
                'ads_bottom_duoihot' => $ads_bottom_duoihot ?? collect(),

                'info' => $info ?? null,

                'category_total' => $category_total,
                'genre_total' => $genre_total,
                'country_total' => $country_total,
                'movie_total' => $movie_total,
                'total_users' => $total_users,
                'total_users_week' => $total_users_week,
                'total_users_month' => $total_users_month,

                'phimhot_sidebar' => $phimhot_sidebar ?? collect(),
                'phimhot_trailer' => $phimhot_trailer ?? collect(),
                'category_home' => $category ?? collect(),
                'genre_home' => $genre ?? collect(),
                'country_home' => $country ?? collect(),

                // ✅ Thêm meta mặc định (fix lỗi undefined)
                'meta_title' => 'Website Xem Phim P33',
                'meta_description' => 'Website xem phim trực tuyến chất lượng cao',
                'meta_keyword' => 'phim hay, xem phim, phim mới',
                'meta_image' => asset('public\uploads\logo\logoweb.png'),
                'meta_url' => url()->current(),
                'meta_type' => 'website',
                'body_class' => 'default-body',
                'canonical' => url()->current(),
            ]);
        } catch (\Exception $e) {
            // Nếu có lỗi DB (chưa migrate, thiếu bảng...)
            View::share([
                'segment' => 'home',
                'ads_network' => collect(),
                'ads_popup' => collect(),
                'ads_sidebar_trai' => collect(),
                'ads_sidebar_phai' => collect(),
                'ads_bottom_duoi' => collect(),
                'ads_bottom_trai' => collect(),
                'ads_bottom_phai' => collect(),
                'ads_bottom_duoihot' => collect(),
                'info' => null,
                'category_home' => collect(),
                'genre_home' => collect(),
                'country_home' => collect(),

                // meta fallback
                'meta_title' => 'Website Xem Phim P33',
                'meta_description' => 'Website xem phim trực tuyến chất lượng cao',
                'meta_keyword' => 'phim hay, xem phim, phim mới',
                'meta_image' => asset('public\uploads\logo\logoweb.png'),
                'meta_url' => url()->current(),
                'meta_type' => 'website',
                'body_class' => 'default-body',
                'canonical' => url()->current(),
            ]);
        }
    }
}
