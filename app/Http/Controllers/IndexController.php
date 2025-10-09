<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\Rating;
use App\Models\LinkMovie;
use App\Models\Info;
use App\Models\Ads;
use App\Models\AdsPosition;
use App\Models\Comments;
use Carbon\Carbon;
use DB;

class IndexController extends Controller
{
    public function insert_comment(Request $request){
        $data = $request->all();
        $comment = new Comments();
        $comment->name = $data['name'];
        $comment->email = $data['email'];
        $comment->movie_id = $data['movie_id'];
        $comment->visitor_id = $data['visitor_id'];
        $comment->comment = $data['comment'];
        $comment->date_created = Carbon::now('Asia/Ho_Chi_Minh');
        $comment->save();

    }
    public function locphim(){
        
         //get
            $order = $_GET['order'];
            $genre_get = $_GET['genre'];
            $country_get = $_GET['country'];
            $year_get = $_GET['year'];

        if($order=='' && $genre_get=='' && $country_get=='' && $year_get==''){

            return redirect()->back();

        }else{
            $meta_title = "Lọc theo phim.";
            $meta_description = "Lọc theo phim.";
            $meta_image = "";

            //lay du lieu
            $movie = Movie::withCount(['episode'=> function($q)
            {
             $q->where('server',3); 
            }   
            ]);
            if($genre_get){
                $movie = $movie->where('genre_id','=',$genre_get);
            }elseif($country_get){
                $movie = $movie->where('country_id','=',$country_get);
            }elseif($year_get){
                $movie = $movie->where('year','=',$year_get);
            }elseif($order){
                $movie = $movie->orderBy($order,'ASC');
            }
            $movie = $movie->orderBy('id','DESC')->paginate(40);
           
           return view('pages.locphim', compact('movie','meta_title','meta_description','meta_image'));
        }

       
    }
    public function timkiem()
    {
        if(isset($_GET['search'])){
            $search = $_GET['search'];
         
            $meta_title = "Tìm phim theo từ khóa:".$search;
            $meta_description = "Tìm phim theo từ khóa:".$search;
            $meta_image = "";

            $movie = Movie::withCount(['episode'=> function($q)
            {
             $q->where('server',3); 
            }   
            ])->where('title','LIKE','%'.$search.'%')->orderBy('ngaycapnhat','DESC')->paginate(40);

            return view('pages.timkiem', compact('search','movie','meta_description','meta_image','meta_title'));

        }else{
            return redirect()->to('/');
        }
        
        

    }
    public function home(){
        $info = Info::find(1);

        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = url('uploads/movie/Love-like-the-Galaxy13.jpg');


        $phimhot = Movie::withCount(['episode'=> function($q)
        {
         $q->where('server',3); 
        }   
        ])->where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        
        $category_home = Category::with(['movie'=> function($q)
                                                                {
                                                                 $q->withCount('episode')->where('status',1); 
                                                                }   
                                                            ])->orderBy('position','ASC')->where('status',1)->get();
                                                               
      
        
    	return view('pages.home', compact('category_home','phimhot','meta_title','meta_description','meta_image'));
    }
    public function category($slug){

        $cate_slug = Category::where('slug',$slug)->first();

        $meta_title = $cate_slug->title;
        $meta_description = $cate_slug->description;
        $meta_image = '';
        $movie = Movie::withCount(['episode'=> function($q)
        {
         $q->where('server',3); 
        }   
        ])->where('category_id',$cate_slug->id)->orderBy('position','ASC')->paginate(40);
    	return view('pages.category', compact('cate_slug','movie','meta_title','meta_description','meta_image'));
    }
    public function year($year){
      
        $meta_title = 'Năm phim: '.$year;
        $meta_description = 'Tìm phim năm :'.$year;
        $meta_image = '';
        $year = $year;
        $movie = Movie::withCount(['episode'=> function($q)
        {
         $q->where('server',3); 
        }   
        ])->where('year',$year)->orderBy('ngaycapnhat','DESC')->paginate(40);
        return view('pages.year', compact('year','movie','meta_title','meta_description','meta_image'));
    }
    public function tag($tag){
        $meta_title = $tag;
        $meta_description = $tag;
        $meta_image = '';
        $tag = $tag;
        $movie = Movie::withCount(['episode'=> function($q)
        {
         $q->where('server',3); 
        }   
        ])->where('tags','LIKE','%'.$tag.'%')->orderBy('ngaycapnhat','DESC')->paginate(40);
        return view('pages.tag', compact('tag','movie','meta_title','meta_description','meta_image'));
    }
    public function genre($slug){
        
        $genre_slug = Genre::where('slug',$slug)->first();
        $meta_title = $genre_slug->title;
        $meta_description = $genre_slug->description;
        $meta_image = '';
        //nhiu the loai
        
        $movie_genre = Movie_Genre::where('genre_id',$genre_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $key => $movi){
            $many_genre[] = $movi->movie_id;
        }
        if(isset($_GET['phimle'])){
            $movie = Movie::withCount(['episode'=> function($q)
            {
             $q->where('server',3); 
            }   
            ])->where('thuocphim','phimle')->whereIn('id',$many_genre)->orderBy('ngaycapnhat','DESC')->paginate(40);
        }else{
            $movie = Movie::withCount(['episode'=> function($q)
            {
             $q->where('server',3); 
            }   
            ])->whereIn('id',$many_genre)->orderBy('ngaycapnhat','DESC')->paginate(40);
        }
       
    	return view('pages.genre', compact('genre_slug','movie','meta_title','meta_description','meta_image'));
    }
    public function country($slug){
      
        $country_slug = Country::where('slug',$slug)->first();
         $meta_image = '';
        $meta_title = $country_slug->title;
        $meta_description = $country_slug->description;
        if(isset($_GET['phimbo'])){
            $movie = Movie::withCount(['episode'=> function($q)
            {
             $q->where('server',3); 
            }   
            ])->where('thuocphim','phimbo')->where('country_id',$country_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
        }else{
            $movie = Movie::withCount(['episode'=> function($q)
            {
             $q->where('server',3); 
            }   
            ])->where('country_id',$country_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
        }
       
    	return view('pages.country', compact('country_slug','movie','meta_title','meta_description','meta_image'));
    }
    public function movie($slug){

        $movie = Movie::with('category','genre','country','movie_genre')->where('slug',$slug)->where('status',1)->first();

        $meta_title = $movie->title;
        $meta_description = $movie->description;
        $meta_image = url('uploads/movie/'.$movie->image);

        $episode_tapdau = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','ASC')->take(1)->first();

        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        //lay 5 tập gần nhất
        $episode = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('id','DESC')->take(5)->get();
        // lấy tổng tập phim đã thêm
        
        $episode_current_list = Episode::with('movie')->where('movie_id',$movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();

        //rating movie
        $rating = Rating::where('movie_id',$movie->id)->avg('rating'); //average 3
        $rating = round($rating);
        $count_total = Rating::where('movie_id',$movie->id)->count();
        //increase movie views
        $count_views = $movie->count_views; //12908
        $count_views= $count_views + 1; 
        $movie->count_views = $count_views;
        $movie->save();
       
    	return view('pages.movie', compact('movie','related','episode','episode_tapdau','episode_current_list_count','rating','count_total','meta_title','meta_description','meta_image'));
    }
    public function add_rating(Request $request){
        $data = $request->all();
        $ip_address = $request->ip();
       
        $rating_count = Rating::where('movie_id',$data['movie_id'])->where('ip_address',$ip_address)->count();
        
        if($rating_count>0){
            echo 'exist';
        }else{
            $rating = new Rating();
            $rating->movie_id = $data['movie_id'];
            $rating->rating = $data['index'];
            $rating->ip_address = $ip_address;
            $rating->save();
            echo 'done';
        }
        
    }
    public function watch($slug,$tap,$server_active){

        $movie = Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug)->where('status',1)->first();
        $meta_title = 'Xem phim: '.$movie->title;
        $meta_description = $movie->description;
        $meta_image = url('uploads/movie/'.$movie->image);

        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();

        if(isset($tap)){
            $server_phim = substr($server_active, 7,100);

            $tapphim = $tap;
            $tapphim = substr($tap, 4,100);
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->where('server',$server_phim)->first();
        }else{
            $tapphim = 1;
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->where('server',$server_phim)->first();
        }

        $server = LinkMovie::orderBy('id','DESC')->get();
        $episode_movie = Episode::where('movie_id',$movie->id)->get()->unique('server');
        $episode_list = Episode::where('movie_id',$movie->id)->orderBy('movie_id','ASC')->get();
        //server_active = server-3;
        $comments = Comments::where('movie_id',$movie->id)->orderBy('id','DESC')->where('status',1)->take(5)->get();
    	return view('pages.watch', compact('comments','movie','episode','tapphim','related','meta_title','meta_description','meta_image','server','episode_movie','episode_list','server_active'));
    }
    public function episode(){
    	return view('pages.episode');
    }
}
