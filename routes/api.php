<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Api\MovieApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ==================== CHATBOT ROUTES ====================

/**
 * TÌM PHIM THÔNG MINH CHO CHATBOT - ƯU TIÊN
 * Endpoint: POST /api/chatbot/search-smart
 * Mục đích: Tìm kiếm phim từ câu hỏi tự nhiên của người dùng
 */
Route::post('/chatbot/search-smart', function (Request $request) {
    try {
        $userQuery = $request->input('query', '');
        $limit = $request->input('limit', 6);
        
        \Log::info('🔍 Chatbot Smart Search Called', [
            'query' => $userQuery,
            'limit' => $limit
        ]);
        
        // Validate input
        if (empty($userQuery)) {
            return response()->json([
                'success' => false,
                'message' => 'Query không được để trống',
                'movies' => []
            ], 400);
        }
        
        // 1. Làm sạch và chuẩn hóa query
        $cleanQuery = strtolower(trim($userQuery));
        
        // 2. Loại bỏ các từ không cần thiết (stop words tiếng Việt)
        $stopWords = ['tìm', 'phim', 'cho', 'tôi', 'xem', 'có', 'nào', 'không', 'các', 'về', 'phim nào', 'mới nhất', 'hay nhất'];
        $keywords = array_values(array_filter(
            explode(' ', $cleanQuery),
            function($word) use ($stopWords) {
                return !in_array($word, $stopWords) && strlen($word) > 1;
            }
        ));
        
        // 3. Nếu không có từ khóa thực sự, trả về phim hot/mới nhất
        if (empty($keywords)) {
            \Log::info('📝 No valid keywords, returning popular movies');
            $movies = \App\Models\Movie::where('status', 1)
                ->orderBy('phim_hot', 'DESC')
                ->orderBy('ngaycapnhat', 'DESC')
                ->take($limit)
                ->get(['id', 'title', 'slug', 'image', 'year', 'resolution', 'description']);
                
            return response()->json([
                'success' => true,
                'query' => $userQuery,
                'search_type' => 'popular',
                'count' => $movies->count(),
                'movies' => formatMoviesForChatbot($movies)
            ]);
        }
        
        // 4. Phân tích query để xác định loại tìm kiếm
        $searchType = 'keyword';
        $isMovieRequest = str_contains($cleanQuery, 'phim');
        
        // Kiểm tra xem có phải tìm theo thể loại không
        $genreMap = [
            'hành động' => 'hanh-dong',
            'tình cảm' => 'tinh-cam', 
            'hài' => 'hai',
            'kinh dị' => 'kinh-di',
            'hoạt hình' => 'hoat-hinh',
            'viễn tưởng' => 'vien-tuong',
            'vịt' => 'hoat-hinh',
            'animation' => 'hoat-hinh'
        ];
        
        $detectedGenre = null;
        foreach ($genreMap as $keyword => $genreSlug) {
            if (str_contains($cleanQuery, $keyword)) {
                $detectedGenre = $genreSlug;
                $searchType = 'genre';
                break;
            }
        }
        
        // 5. Xây dựng query tìm kiếm
        $searchQuery = \App\Models\Movie::where('status', 1);
        
        if ($detectedGenre) {
            // Tìm theo thể loại
            $searchQuery->whereHas('genre', function($q) use ($detectedGenre) {
                $q->where('slug', $detectedGenre);
            });
        } else {
            // Tìm theo từ khóa trong nhiều trường
            $searchQuery->where(function($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $q->orWhere('title', 'like', "%{$keyword}%")
                      ->orWhere('name_eng', 'like', "%{$keyword}%")
                      ->orWhere('tags', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
                }
            });
        }
        
        // 6. Thực hiện tìm kiếm
        $movies = $searchQuery
            ->orderBy('phim_hot', 'DESC')
            ->orderBy('ngaycapnhat', 'DESC')
            ->take($limit)
            ->get(['id', 'title', 'slug', 'image', 'year', 'resolution', 'description', 'phim_hot']);
        
        // 7. Nếu không tìm thấy với tìm kiếm phức tạp, thử tìm đơn giản hơn
        if ($movies->isEmpty() && !$detectedGenre) {
            \Log::info('🔄 No results, trying simple title search');
            $simpleQuery = \App\Models\Movie::where('status', 1);
            
            // Chỉ tìm trong title và name_eng
            $simpleQuery->where(function($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $q->orWhere('title', 'like', "%{$keyword}%")
                      ->orWhere('name_eng', 'like', "%{$keyword}%");
                }
            });
            
            $movies = $simpleQuery
                ->orderBy('ngaycapnhat', 'DESC')
                ->take($limit)
                ->get(['id', 'title', 'slug', 'image', 'year', 'resolution', 'description']);
        }
        
        \Log::info('✅ Search completed', [
            'query' => $userQuery,
            'keywords' => $keywords,
            'search_type' => $searchType,
            'found' => $movies->count()
        ]);
        
        return response()->json([
            'success' => true,
            'query' => $userQuery,
            'keywords' => $keywords,
            'search_type' => $searchType,
            'is_movie_request' => $isMovieRequest,
            'count' => $movies->count(),
            'movies' => formatMoviesForChatbot($movies)
        ]);
        
    } catch (\Exception $e) {
        \Log::error('💥 Chatbot Search Error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'query' => $request->input('query', '')
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Lỗi khi tìm kiếm phim',
            'movies' => []
        ], 500);
    }
});

/**
 * COHERE AI API - DÙNG KHI KHÔNG TÌM THẤY PHIM
 * Endpoint: POST /api/chatbot/cohere
 */
Route::post('/chatbot/cohere', function (Request $request) {
    $userMessage = $request->input('message');
    
    \Log::info('🤖 Cohere API Called', ['message' => $userMessage]);
    
    // Validate input
    if (empty($userMessage)) {
        return response()->json([
            'success' => false,
            'response' => 'Tin nhắn không được để trống.'
        ]);
    }
    
    $apiKey = env('COHERE_API_KEY');
    
    if (empty($apiKey) || $apiKey === 'your-cohere-api-key-here') {
        \Log::error('Cohere API Key not configured');
        return response()->json([
            'success' => false,
            'response' => 'API Key chưa được cấu hình.'
        ]);
    }
    
    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->timeout(15)->post('https://api.cohere.ai/v1/chat', [
            'message' => $userMessage,
            'model' => 'command-r-08-2024',  
            'temperature' => 0.7,
            'chat_history' => [],
            'prompt_truncation' => 'AUTO',
            'stream' => false
        ]);

        \Log::info('Cohere API Response Status', ['status' => $response->status()]);
        
        if ($response->successful()) {
            $data = $response->json();
            \Log::info('Cohere API Success', ['response_length' => strlen($data['text'] ?? '')]);
            
            $aiResponse = $data['text'] ?? 'Xin lỗi, tôi không thể trả lời ngay lúc này.';
            
            return response()->json([
                'success' => true,
                'response' => trim($aiResponse)
            ]);
        } else {
            $errorData = $response->json();
            $errorMessage = $errorData['message'] ?? 'Lỗi không xác định từ Cohere API';
            $statusCode = $response->status();
            
            \Log::error('Cohere API Error', [
                'status' => $statusCode,
                'error' => $errorMessage
            ]);
            
            return response()->json([
                'success' => false,
                'response' => "Lỗi Cohere API ($statusCode): " . $errorMessage
            ], 500);
        }

    } catch (\Illuminate\Http\Client\ConnectionException $e) {
        \Log::error('Cohere Connection Exception', ['error' => $e->getMessage()]);
        
        return response()->json([
            'success' => false,
            'response' => 'Lỗi kết nối đến Cohere API. Vui lòng kiểm tra internet.'
        ], 500);
        
    } catch (\Exception $e) {
        \Log::error('Cohere General Exception', ['error' => $e->getMessage()]);
        
        return response()->json([
            'success' => false,
            'response' => 'Lỗi hệ thống: ' . $e->getMessage()
        ], 500);
    }
});

/**
 * API TÌM PHIM CƠ BẢN CHO CHATBOT (Fallback/legacy)
 * Endpoint: POST /api/chatbot/movies
 */
Route::post('/chatbot/movies', function (Request $request) {
    try {
        $filters = $request->only(['search', 'limit']);
        $limit = $filters['limit'] ?? 8;
        
        $query = \App\Models\Movie::where('status', 1)
                    ->with(['category', 'country'])
                    ->withCount('episode');
        
        if (!empty($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }
        
        $movies = $query->orderBy('ngaycapnhat', 'DESC')
                       ->take($limit)
                       ->get(['id', 'title', 'slug', 'year', 'resolution', 'time', 'episode_count', 'count_views']);
        
        $formattedMovies = $movies->map(function($movie) {
            $qualityMap = [0 => 'HD', 1 => 'SD', 2 => 'HDCam', 3 => 'Cam', 4 => 'FullHD', 5 => 'Trailer'];
            $quality = $qualityMap[$movie->resolution] ?? 'Unknown';
            
            return [
                'id' => $movie->id,
                'title' => $movie->title,
                'slug' => $movie->slug,
                'year' => $movie->year,
                'quality' => $quality,
                'duration' => $movie->time,
                'episodes' => $movie->episode_count,
                'views' => $movie->count_views,
                'url' => url('phim/' . $movie->slug)
            ];
        });
        
        return response()->json([
            'success' => true,
            'data' => [
                'movies' => $formattedMovies,
                'total' => $movies->count()
            ]
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Chatbot Movies API Error', ['error' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'error' => 'Cannot fetch movies: ' . $e->getMessage()
        ], 500);
    }
});

// ==================== OTHER API ROUTES ====================

Route::get('/movies', [MovieApiController::class, 'listMovies']);
Route::get('/movies/hot', [MovieApiController::class, 'hotMovies']);
Route::get('/movies/latest', [MovieApiController::class, 'latestMovies']);
Route::get('/movies/search', [MovieApiController::class, 'searchMovies']);
Route::get('/genres', [MovieApiController::class, 'getGenres']);
Route::get('/countries', [MovieApiController::class, 'getCountries']);

// Test endpoint
Route::get('/test-movies', function (Request $request) {
    try {
        $movies = \App\Models\Movie::where('status', 1)
                    ->orderBy('ngaycapnhat', 'DESC')
                    ->take(5)
                    ->get(['id', 'title', 'slug', 'year']);
        
        return response()->json([
            'success' => true,
            'data' => $movies
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
});

// ==================== HELPER FUNCTION ====================

/**
 * Format movies data for chatbot response
 */
function formatMoviesForChatbot($movies) {
    $qualityMap = [
        0 => 'HD', 
        1 => 'SD', 
        2 => 'HDCam', 
        3 => 'Cam', 
        4 => 'FullHD', 
        5 => 'Trailer'
    ];
    
    return $movies->map(function($movie) use ($qualityMap) {
        $description = $movie->description ?? '';
        $shortDescription = strlen($description) > 100 
            ? substr($description, 0, 100) . '...' 
            : $description;
        
        return [
            'id' => $movie->id,
            'title' => $movie->title,
            'slug' => $movie->slug,
            'year' => $movie->year,
            'quality' => $qualityMap[$movie->resolution] ?? 'Unknown',
            'image' => $movie->image ? url('uploads/movie/' . $movie->image) : null,
            'description' => $shortDescription,
            'is_hot' => (bool) ($movie->phim_hot ?? false),
            'url' => url('phim/' . $movie->slug) // Full URL for frontend
        ];
    });
}