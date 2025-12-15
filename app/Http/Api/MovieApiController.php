<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;

class MovieApiController extends Controller
{
    /**
     * Danh sách phim cho chatbot
     */
    public function listMovies(Request $request)
    {
        try {
            $filters = $request->only(['genre', 'country', 'category', 'year', 'search', 'limit']);
            
            $query = Movie::where('status', 1)
                        ->with(['category', 'country', 'genre', 'movie_genre'])
                        ->withCount('episode');
            
            // Áp dụng filters
            if (!empty($filters['genre'])) {
                $query->whereHas('movie_genre', function($q) use ($filters) {
                    $q->where('slug', $filters['genre']);
                });
            }
            
            if (!empty($filters['country'])) {
                $query->whereHas('country', function($q) use ($filters) {
                    $q->where('slug', $filters['country']);
                });
            }
            
            if (!empty($filters['category'])) {
                $query->whereHas('category', function($q) use ($filters) {
                    $q->where('slug', $filters['category']);
                });
            }
            
            if (!empty($filters['year'])) {
                $query->where('year', $filters['year']);
            }
            
            if (!empty($filters['search'])) {
                $query->where(function($q) use ($filters) {
                    $q->where('title', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('name_eng', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('description', 'like', '%' . $filters['search'] . '%');
                });
            }
            
            $limit = $filters['limit'] ?? 10;
            $movies = $query->orderBy('ngaycapnhat', 'DESC')
                           ->take($limit)
                           ->get(['id', 'title', 'name_eng', 'slug', 'image', 'year', 'quality', 'resolution', 'time', 'episode_count', 'description', 'count_views', 'phim_hot']);
            
            // Format response
            $formattedMovies = $movies->map(function($movie) {
                return [
                    'id' => $movie->id,
                    'title' => $movie->title,
                    'english_title' => $movie->name_eng,
                    'slug' => $movie->slug,
                    'image' => $movie->image,
                    'year' => $movie->year,
                    'quality' => $this->getQualityText($movie->resolution),
                    'duration' => $movie->time,
                    'episodes' => $movie->episode_count,
                    'description' => $movie->description,
                    'views' => $movie->count_views,
                    'is_hot' => $movie->phim_hot == 1,
                    'category' => $movie->category->title ?? '',
                    'country' => $movie->country->title ?? '',
                    'genres' => $movie->movie_genre->pluck('title')->toArray(),
                    'url' => url('phim/' . $movie->slug)
                ];
            });
            
            return response()->json([
                'success' => true,
                'data' => [
                    'movies' => $formattedMovies,
                    'total' => $movies->count(),
                    'filters' => $filters
                ]
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Movie API Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Không thể lấy danh sách phim',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Lấy phim hot
     */
    public function hotMovies(Request $request)
    {
        try {
            $limit = $request->get('limit', 10);
            
            $movies = Movie::where('status', 1)
                         ->where('phim_hot', 1)
                         ->with(['category', 'country'])
                         ->withCount('episode')
                         ->orderBy('ngaycapnhat', 'DESC')
                         ->take($limit)
                         ->get(['id', 'title', 'slug', 'image', 'year', 'resolution', 'count_views']);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'movies' => $movies,
                    'total' => $movies->count()
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Không thể lấy phim hot'
            ], 500);
        }
    }
    
    /**
     * Lấy phim mới nhất
     */
    public function latestMovies(Request $request)
    {
        try {
            $limit = $request->get('limit', 10);
            
            $movies = Movie::where('status', 1)
                         ->with(['category', 'country'])
                         ->withCount('episode')
                         ->orderBy('ngaycapnhat', 'DESC')
                         ->take($limit)
                         ->get(['id', 'title', 'slug', 'image', 'year', 'resolution', 'count_views']);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'movies' => $movies,
                    'total' => $movies->count()
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Không thể lấy phim mới nhất'
            ], 500);
        }
    }
    
    /**
     * Tìm kiếm phim
     */
    public function searchMovies(Request $request)
    {
        try {
            $keyword = $request->get('q');
            $limit = $request->get('limit', 10);
            
            if (empty($keyword)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Từ khóa tìm kiếm không được để trống'
                ], 400);
            }
            
            $movies = Movie::where('status', 1)
                         ->where(function($query) use ($keyword) {
                             $query->where('title', 'like', '%' . $keyword . '%')
                                   ->orWhere('name_eng', 'like', '%' . $keyword . '%')
                                   ->orWhere('description', 'like', '%' . $keyword . '%');
                         })
                         ->with(['category', 'country'])
                         ->withCount('episode')
                         ->orderBy('ngaycapnhat', 'DESC')
                         ->take($limit)
                         ->get(['id', 'title', 'slug', 'image', 'year', 'resolution', 'count_views', 'description']);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'movies' => $movies,
                    'total' => $movies->count(),
                    'keyword' => $keyword
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Không thể tìm kiếm phim'
            ], 500);
        }
    }
    
    /**
     * Lấy thể loại phim
     */
    public function getGenres()
    {
        try {
            $genres = Genre::where('status', 1)
                          ->orderBy('position', 'ASC')
                          ->get(['id', 'title', 'slug', 'description']);
            
            return response()->json([
                'success' => true,
                'data' => $genres
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Không thể lấy danh sách thể loại'
            ], 500);
        }
    }
    
    /**
     * Lấy quốc gia
     */
    public function getCountries()
    {
        try {
            $countries = Country::where('status', 1)
                              ->orderBy('id', 'DESC')
                              ->get(['id', 'title', 'slug']);
            
            return response()->json([
                'success' => true,
                'data' => $countries
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Không thể lấy danh sách quốc gia'
            ], 500);
        }
    }
    
    /**
     * Chuyển đổi resolution sang text
     */
    private function getQualityText($resolution)
    {
        $qualityMap = [
            0 => 'HD',
            1 => 'SD',
            2 => 'HDCam',
            3 => 'Cam',
            4 => 'FullHD',
            5 => 'Trailer'
        ];
        
        return $qualityMap[$resolution] ?? 'Unknown';
    }
}