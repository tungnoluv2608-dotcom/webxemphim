<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Episode;
use Carbon\Carbon;
class LeechMovieController extends Controller
{
    public function store_all_movie_by_page_api($page){
      
        $resp = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat?page='.$page)->json();
        //lọc tất cả các phim theo trang
        foreach($resp['items'] as $key => $res){
            //lấy chi tiết phim theo slug
            $movie = Movie::where('slug',$res['slug'])->first();
            if(!$movie){
                $resp_slug = Http::get('https://ophim1.com/phim/'.$res['slug'])->json();
                $resp_array_movie_episode[] = $resp_slug;
                //$resp_episode[] = $resp_slug['episodes'];

            }
           
        }
        foreach($resp_array_movie_episode as $key => $res){
           
           // thêm dữ liệu tất cả phim của trang lấy được vào cơ sở dữ liệu
            $movie = new Movie();
            $movie->trailer = $res['movie']['trailer_url'];
            if($res['movie']['episode_total']=='?' || !is_numeric($res['movie']['episode_total'])){
                $movie->sotap = '?';
            }else{
                $movie->sotap = $res['movie']['episode_total'];
            }
            $movie->title = $res['movie']['name'];
            $movie->tags = $res['movie']['name'].','.$res['movie']['slug'];
            $movie->thoiluong = $res['movie']['time'];
            $movie->phude = 0;
            $movie->resolution = 0;
            $movie->slug = $res['movie']['slug'];
            $movie->name_eng = $res['movie']['origin_name'];
            $movie->phim_hot = 1;
            $movie->description = $res['movie']['content'];
            $movie->status = 1;
            $movie->tags = $res['movie']['name'].','.$res['movie']['slug'];
          
            foreach($res['movie']['country'] as $coun){
            //them quốc gia phim
             $country = Country::where('slug',$coun['slug'])->first();
             if(!$country){
                $country_one = Country::orderBy('id','DESC')->first();
                $movie->country_id = $country_one->id;
             }else{
                $movie->country_id = $country->id;
             }
            
             
            }
            
            //them danh mục phim
            if($res['movie']['type']=='series'){
            $category = Category::where('slug','phim-bo')->first();
            }elseif($res['movie']['type']=='single'){
            $category = Category::where('slug','phim-le')->first();
            }elseif($res['movie']['type']=='tvshows'){
            $category = Category::where('slug','tvshows')->first();
            }elseif($res['movie']['type']=='hoathinh'){
            $category = Category::where('slug','phim-hoat-hinh')->first();
            }else{
            $category = Category::orderBy('id','DESC')->first();
            }
            $movie->category_id = $category->id;
           
            //them thể loại cho phim
            foreach($res['movie']['category'] as $cate){
                $genres = Genre::where('slug',$cate['slug'])->first(); 
                if(!$genres){
                    $genres_one = Country::orderBy('id','DESC')->first();
                    $movie->genre_id = $genres_one->id;
                 }else{
                    $movie->genre_id = $genres->id;
                }
            }

            $movie->thuocphim = $res['movie']['type'];
            $movie->topview = rand(0,2);
          
            $movie->year = $res['movie']['year'];
            $movie->count_views = rand(100,99999);
            $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->image = $res['movie']['thumb_url'];
            $movie->save();

            foreach($res['movie']['category'] as $mov_gen){
                $movie_genre = new Movie_Genre();
                $movie_genre->movie_id = $movie->id;
                $genre_movie = Genre::where('slug',$mov_gen['slug'])->first(); 
                if(!$genre_movie){
                    $genres_one = Genre::inRandomOrder()->first();
                    $movie_genre->genre_id = $genres_one->id;
                }else{
                    $movie_genre->genre_id = $genre_movie->id;
                }   
              
                $movie_genre->save();
            }
            //thêm tập phim
            foreach($res['episodes'] as $key => $res_ep){
          
                foreach($res_ep['server_data'] as $key2 => $episode){
                            
                    $ep = new Episode();
                    $ep->movie_id = $movie->id;
                
                        $ep->linkphim = '<p><iframe allowfullscreen frameborder="0" height="360" scrolling="0" src="'.$episode['link_embed'].'" width="100%"></iframe></p>';
                        if($key==0){
                            $ep->server = 3;
                        }else{
                            $ep->server = 2;
                        }
                        
                
                    $string =  $episode['name'];
                    $arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$string);           
                    // print_r($matches);
                    //dd($arr);
                  
                    $ep->episode = $arr[0];

                    $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $ep->save();
                    }
                
            }
           
        }
     
        toastr()->success('Thành công','Đã thêm tất cả phim trang '.$page.' thành công.');
        return redirect()->back();
    }
    public function leech_movie(){
        // $client = new \GuzzleHttp\Client();
        // $res = $client->request('GET','https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1');
        // return $res->getBody()->getContents(); 
        $movie = Movie::all();
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page=1;
        }
        $resp = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat?page='.$page)->json();
       
        return view('admincp.leech.index',compact('resp','movie'));
    }
    public function leech_detail($slug){
        
        $resp = Http::get('https://ophim1.com/phim/'.$slug)->json();
        $resp_array[] = $resp['movie'];
      
        return view('admincp.leech.detail_movie',compact('resp_array','resp'));
    }
    public function watch_leech_detail(Request $request){
        $slug = $request->slug;
        $resp = Http::get('https://ophim1.com/phim/'.$slug)->json();
        $resp_array[] = $resp['movie'];
        $output['content_title'] = '<h3 style="text-align: center;text-transform: uppercase;">'.$resp['movie']['name'].'</h3>';
    	$output['content_detail'] = '
            <div class="row">
                <div class="col-md-5"><img src="'.$resp['movie']['thumb_url'].'" width="100%"></div>
                <div class="col-md-7">
                    <h5><b>Tên phim :</b>'.$resp['movie']['name'].'</h5>
                    <p><b>'.$resp['movie']['origin_name'].'</b></p>
                    <p><b>Trạng thái :</b> '.$resp['movie']['episode_current'].'</p>
                    <p><b>Số tập :</b> '.$resp['movie']['episode_total'].'</p>
                    <p><b>Thời lượng : </b>'.$resp['movie']['time'].'</p>
                    <p><b>Năm phát hành : </b>'.$resp['movie']['year'].'</p>
                    <p><b>Chất lượng : </b>'.$resp['movie']['quality'].'</p>
                    <p><b>Ngôn ngữ : </b>'.$resp['movie']['lang'].'</p>';
                    foreach($resp['movie']['director'] as $dir){
                        $output['content_detail'].='Đạo diễn: <span class="badge badge-pill badge-info">'.$dir.'</span><br>';
                    }
                    $output['content_detail'].='<b>Thể loại :</b>';
                    foreach($resp['movie']['category'] as $cate){
                        $output['content_detail'].='
                        <p><span class="badge badge-pill badge-info">'.$cate['name'].'</span></p>';
                    }
                    $output['content_detail'].='<b>Diễn viên :</b>';
                    foreach($resp['movie']['actor'] as $act){
                        $output['content_detail'].='
                        <p><span class="badge badge-pill badge-info">'.$act.'</span></p>';
                    }
                    $output['content_detail'].='<b>Quốc gia :</b>';
                    foreach($resp['movie']['country'] as $country){
                        $output['content_detail'].='
                        <p><span class="badge badge-pill badge-info">'.$country['name'].'</span></p>';
                    }
                    $output['content_detail'].='

                </div>
            </div>
        ';
          
    	echo json_encode($output);
    }
    public function leech_episode($slug){
        $movie = Movie::where('slug',$slug)->first();
        if($movie){
            $count = Episode::where('movie_id',$movie->id)->count();
        }else{
            $count = 0;
        }
        $resp = Http::get('https://ophim1.com/phim/'.$slug)->json();
        return view('admincp.leech.detail_episode',compact('resp','movie','count'));
    }
    public function leech_store(Request $request){
        //get data movie by slug
        $resp = Http::get('https://ophim1.com/phim/'.$request->slug)->json();
        $resp_array[] = $resp['movie'];
        //save data
        $movie = new Movie();

        foreach($resp_array as $key => $res){
            $movie->title = $res['name'];
            $movie->trailer = $res['trailer_url'];
            $movie->sotap = $res['episode_total'];
            $movie->tags = $res['name'].','.$res['slug'];
            $movie->thoiluong = $res['time'];
            $movie->phude = 0;
            $movie->resolution = 0;
            $movie->slug = $res['slug'];
            $movie->name_eng = $res['origin_name'];
            $movie->phim_hot = 1;
            $movie->description = $res['content'];
            $movie->status = 1;
            $movie->tags = $res['name'].','.$res['slug'];
          
            foreach($res['country'] as $coun){
            //them quốc gia phim
             $country = Country::where('slug',$coun['slug'])->first();
             $movie->country_id = $country->id;
             
            }
            
            //them danh mục phim
            if($res['type']=='series'){
            $category = Category::where('slug','phim-bo')->first();
            }elseif($res['type']=='single'){
            $category = Category::where('slug','phim-le')->first();
            }elseif($res['type']=='tvshows'){
            $category = Category::where('slug','tvshows')->first();
            }elseif($res['type']=='hoathinh'){
            $category = Category::where('slug','phim-hoat-hinh')->first();
            }else{
            $category = Category::orderBy('id','DESC')->first();
            }
            $movie->category_id = $category->id;
           
            //them thể laoi5 cho phim
            foreach($res['category'] as $cate){
                $genres = Genre::where('slug',$cate['slug'])->first(); 
                $movie->genre_id = $genres->id;
              
            }

            $movie->thuocphim = $res['type'];
            $movie->topview = rand(0,2);
          
            $movie->year = $res['year'];
            $movie->count_views = rand(100,99999);
            $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->image = $res['thumb_url'];
            $movie->save();

            foreach($res['category'] as $mov_gen){
                $movie_genre = new Movie_Genre();
                $movie_genre->movie_id = $movie->id;
                $genre_movie = Genre::where('slug',$mov_gen['slug'])->first(); 
                $movie_genre->genre_id = $genre_movie->id;
                $movie_genre->save();
            }
           
        }
        return redirect()->back();

    }
    public function leech_insert_episode($slug){
        
        $movie = Movie::where('slug',$slug)->first();
        $resp = Http::get('https://ophim1.com/phim/'.$slug)->json();
        
        foreach($resp['episodes'] as $key => $res){
          
                foreach($res['server_data'] as $key2 => $episode){
                            
                    $ep = new Episode();
                    $ep->movie_id = $movie->id;
                
                        $ep->linkphim = '<p><iframe allowfullscreen frameborder="0" height="360" scrolling="0" src="'.$episode['link_embed'].'" width="100%"></iframe></p>';
                        if($key==0){
                            $ep->server = 3;
                        }else{
                            $ep->server = 2;
                        }
                        
                
                    $string =  $episode['name'];
                    $arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$string);           
                    // print_r($matches);
                    //dd($arr);
                  
                    $ep->episode = $arr[0];

                    $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $ep->save();
                    }
                
        }
        
        return redirect()->back(); 
    }
    public function leech_delete_episode($slug){
        $movie = Movie::where('slug',$slug)->first();
        if($movie){
            $episode = Episode::whereIn('movie_id',[$movie->id])->delete();
            return redirect()->back(); 
        }else{
            return redirect()->back(); 
        }
        
    }
}
