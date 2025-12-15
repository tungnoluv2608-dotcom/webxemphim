<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LinkMovieController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\AdsNetworkController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\LoginFBController;
use App\Http\Controllers\LeechMovieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\MovieApiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RevenueController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
  'login' => false
]);

// ========== ROUTES PUBLIC (Không cần đăng nhập) ==========
// Route đăng ký
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Login routes
Route::get('login',[LoginController::class, 'showLoginForm']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Trang chủ phim
Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}/{server_active}', [IndexController::class, 'watch']);
Route::get('/so-tap', [IndexController::class, 'episode'])->name('so-tap');
Route::get('/nam/{year}', [IndexController::class, 'year']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::get('/tim-kiem', [IndexController::class, 'timkiem'])->name('tim-kiem');
Route::get('/locphim', [IndexController::class, 'locphim'])->name('locphim');
Route::post('/add-rating', [IndexController::class, 'add_rating'])->name('add-rating');
Route::post('/insert-comment', [IndexController::class, 'insert_comment'])->name('insert-comment');
Route::post('/comment/edit/{id}', [IndexController::class, 'edit_comment'])->name('comment.edit');
Route::delete('/comment/delete/{id}', [IndexController::class, 'delete_comment'])->name('comment.delete');
//Thong tin website
Route::resource('info', InfoController::class);

// Login social
Route::get('/auth/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('login-by-google');
Route::get('/auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('auth/facebook', [LoginFBController::class, 'redirectToFacebook'])->name('login-by-facebook');
Route::get('auth/facebook/callback', [LoginFBController::class, 'handleFacebookCallback']);

// ========== ROUTES CHO USER THƯỜNG (Cần đăng nhập) ==========
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    
    // Payment
    Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment']);
    Route::get('/vnpay_return', [PaymentController::class, 'vnpay_return']);
    //Comment
    
    // Route /home redirect theo role
    Route::get('/home', function() {
        // Nếu là admin → admin dashboard
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        // Nếu là user thường → trang cá nhân
        return redirect()->route('homepage');
    })->name('home');
});

// ========== ROUTES CHỈ DÀNH CHO ADMIN ==========
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Quản lý users (của bạn)
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}/package', [UserController::class, 'updateUserPackage'])->name('user.package.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    
    // Quản lý admincp (có sẵn)
    Route::get('/admincp/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admincp.users.index');
    Route::get('/admincp/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admincp.users.show');
    Route::delete('/admincp/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admincp.users.destroy');
    
    // Các route quản lý khác
    Route::post('resorting', [CategoryController::class,'resorting'])->name('resorting');
    Route::resource('category', CategoryController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('country', CountryController::class);
    Route::resource('movie', MovieController::class);
    Route::resource('linkmovie', LinkMovieController::class);
    
    // Episode
    Route::get('add-episode/{id}', [EpisodeController::class,'add_episode'])->name('add-episode');
    Route::resource('episode', EpisodeController::class);
    Route::get('select-movie', [EpisodeController::class,'select_movie'])->name('select-movie');
    
    // Update movie
    Route::get('/update-year-phim', [MovieController::class, 'update_year'])->name('update-year-phim');
    Route::get('/update-topview-phim', [MovieController::class, 'update_topview'])->name('update-topview-phim');
    Route::get('/update-season-phim', [MovieController::class, 'update_season'])->name('update-season-phim');
    Route::post('/filter-topview-phim', [MovieController::class, 'filter_topview']);
    Route::get('/filter-topview-default', [MovieController::class, 'filter_default']);
    Route::get('/sort_movie', [MovieController::class, 'sort_movie'])->name('sort_movie');
    Route::post('/resorting_navbar', [MovieController::class, 'resorting_navbar'])->name('resorting_navbar');
    Route::post('/resorting_movie', [MovieController::class, 'resorting_movie'])->name('resorting_movie');
    Route::post('capnhat-theloai', [MovieController::class, 'capnhat_theloai'])->name('capnhat-theloai');
    Route::post('sync-genre', [MovieController::class, 'sync_genre'])->name('sync-genre');
    Route::post('update-tags', [MovieController::class, 'update_tags'])->name('update-tags');
    
    // Ads
    Route::resource('ads', AdsController::class);
    Route::get('/ads-gif/{id}', [AdsController::class, 'ads_gif'])->name('ads-gif');
    Route::post('/turn-onoff-ads/{id}', [AdsController::class, 'turn_onoff_ads'])->name('turn-onoff-ads');
    Route::resource('adsnetwork', AdsNetworkController::class);
    Route::get('/add-ads-script', [AdsNetworkController::class, 'add_ads_script'])->name('add-ads-script');
    Route::get('/update-adsnetwork-script/{id}', [AdsNetworkController::class, 'update_adsnetwork_script'])->name('update-adsnetwork-script');
    Route::post('/put-script-adsnetwork/{id}', [AdsNetworkController::class, 'put_script_adsnetwork'])->name('put-script-adsnetwork');
    Route::post('/store-script-adsnetwork', [AdsNetworkControllerController::class, 'store_script_adsnetwork'])->name('store-script-adsnetwork');
    
    // Leech Movie
    Route::get('leech-movie', [LeechMovieController::class, 'leech_movie'])->name('leech-movie');
    Route::get('leech-detail/{slug}', [LeechMovieController::class, 'leech_detail'])->name('leech-detail');
    Route::get('leech-episode/{slug}', [LeechMovieController::class, 'leech_episode'])->name('leech-episode');
    Route::post('leech-store', [LeechMovieController::class, 'leech_store'])->name('leech-store');
    Route::get('leech-insert-episode/{slug}', [LeechMovieController::class, 'leech_insert_episode'])->name('leech-insert-episode');
    Route::get('leech-delete-episode/{slug}', [LeechMovieController::class, 'leech_delete_episode'])->name('leech-delete-episode');
    Route::post('watch-leech-detail', [LeechMovieController::class, 'watch_leech_detail'])->name('watch-leech-detail');
    Route::post('store-all-movie-by-page-api/{page}', [LeechMovieController::class, 'store_all_movie_by_page_api'])->name('store-all-movie-by-page-api');
    
    // Comments
    Route::get('/comments', [MovieController::class, 'comments'])->name('comments');
    Route::get('/toggle-comment/{status}/{id}', [MovieController::class, 'toggle_comment'])->name('toggle-comment');
    
    // Revenua
    Route::get('/revenue', [RevenueController::class, 'index'])->name('revenue.index');
    // Ajax updates
    Route::get('/category-choose', [MovieController::class, 'category_choose'])->name('category-choose');
    Route::get('/country-choose', [MovieController::class, 'country_choose'])->name('country-choose');
    Route::get('/phimhot-choose', [MovieController::class, 'phimhot_choose'])->name('phimhot-choose');
    Route::get('/phude-choose', [MovieController::class, 'phude_choose'])->name('phude-choose');
    Route::get('/trangthai-choose', [MovieController::class, 'trangthai_choose'])->name('trangthai-choose');
    Route::get('/thuocphim-choose', [MovieController::class, 'thuocphim_choose'])->name('thuocphim-choose');
    Route::get('/resolution-choose', [MovieController::class, 'resolution_choose'])->name('resolution-choose');
    Route::post('/update-image-movie-ajax', [MovieController::class, 'update_image_movie_ajax'])->name('update-image-movie-ajax');
    Route::post('/watch-video', [MovieController::class, 'watch_video'])->name('watch-video');
});

// ========== ROUTES KHÔNG CẦN PHÂN QUYỀN (Visitor, etc) ==========
Route::resource('visitor', VisitorController::class);
Route::get('logout-home', [LoginGoogleController::class, 'logout_home'])->name('logout-home');

