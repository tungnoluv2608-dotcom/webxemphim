<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Info;
use App\Models\Comments;
use GuzzleHttp\Client;

use Carbon\Carbon;
use Storage;
use File;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function category_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->category_id = $data['category_id'];
        $movie->save();
    }
    public function country_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->country_id = $data['country_id'];
        $movie->save();
    }
    public function phimhot_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->phim_hot = $data['phimhot_val'];
        $movie->save();
    }
    public function phude_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->phude = $data['phude_val'];
        $movie->save();
    }
    public function trangthai_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->status = $data['trangthai_val'];
        $movie->save();
    }
    public function thuocphim_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->thuocphim = $data['thuocphim_val'];
        $movie->save();
    }
    public function resolution_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->resolution = $data['resolution_val'];
        $movie->save();
    }
    public function update_image_movie_ajax(Request $request){
        $get_image = $request->file('file');
        $movie_id = $request->movie_id;

        if($get_image){
                //xóa ảnh củ 
                $movie = Movie::find($movie_id);
                if(file_exists('uploads/movie/'.$movie->image)){
                    unlink('uploads/movie/'.$movie->image);
                }else{
                    //thêm ảnh mới
                    $get_name_image = $get_image->getClientOriginalName(); //61bc7baa3cf02 . jpg
                    $name_image = current(explode('.',$get_name_image));  //61bc7baa3cf02
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //61bc7baa3cf0256.jpg
                    $get_image->move('uploads/movie/',$new_image);
                    $movie->image = $new_image;
                    $movie->save(); 
                }
               
               
            
        }
    }
    public function comments()
    {
        $comments = Comments::with('movie')->orderBy('id','desc')->get();
       
        return view('admincp.comments.list', compact('comments'));
    }
    public function toggle_comment($status,$id){
        $comment = Comments::find($id);
        if($status==0){
           
            $comment->status = 0;
        }else{
            
            $comment->status = 1;
        }
        $comment->save();
       // dd($comment);
        return redirect()->back();

    }
    public function index(Request $request)
    {
        $list_genre = Genre::all();
        $list = Movie::with('category','movie_genre','country','genre')->withCount('episode')->orderBy('id','DESC')->get();
        // return response()->json($list);
        $category = Category::pluck('title','id');
        $country = Country::pluck('title','id');
        $path= public_path()."/json/";

        if (!is_dir($path)) {  
            mkdir($path,0777,true);  
        }
        File::put($path.'movies.json',json_encode($list));
        

        return view('admincp.movie.index', compact('list','category','country','list_genre'));
    }
    public function capnhat_theloai(Request $request){
       $movie_id = $request->movie_id;
       $list_genre = Genre::all();
       $movie =  Movie::find($movie_id);
       $movie_genre = $movie->movie_genre;
     
       $output['body_capnhat'] = '';
       foreach($list_genre as $key => $gen){
        $check = $movie_genre->contains($gen->id);
       
        if(isset($movie)){
        $output['body_capnhat'] .= '<div class="form-check" id="check-theloai">';
        if($movie_genre->contains($gen->id)){
            $output['body_capnhat'] .= '<input checked class="form-check-input" 
       
            name="genre[]" type="checkbox" value="'.$gen->id.'" id="'.$gen->id.'">';
        }else{
            $output['body_capnhat'] .= '<input class="form-check-input" 
       
            name="genre[]" type="checkbox" value="'.$gen->id.'" id="'.$gen->id.'">';
        }
        

        $output['body_capnhat'] .= '<label class="form-check-label" for="'.$gen->id.'">
          '.$gen->title.'
        </label>
        </div>';
        }
       }    
        echo json_encode($output);
    }
    public function sort_movie(){
        $category = Category::orderBy('id','ASC')->get();
        $category_home = Category::with(['movie'=> function($q)
        {
         $q->withCount('episode')->where('status',1); 
        }   
        ])->orderBy('position','ASC')->where('status',1)->get();

        return view('admincp.movie.sort_movie',compact('category','category_home'));
    }
    public function resorting_navbar(Request $request){
      
        $data = $request->all();
    
        foreach ($data['array_id'] as $key => $value) { 
                $category = Category::find($value);
                $category->position = $key;
                $category->save();
        }
      
    }
    public function resorting_movie(Request $request){
        $data = $request->all();
    
        foreach ($data['movie_array'] as $key => $value) { 
                $movie = Movie::find($value);
                $movie->position = $key;
                $movie->save();
        }
    }
    
    public function update_year(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }
    public function update_topview(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->save();
    }
    public function update_season(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->season = $data['season'];
        $movie->save();
    }
    public function filter_topview(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview',$data['value'])->orderBy('ngaycapnhat','DESC')->take(20)->get();
        $output = '';
        foreach($movie as $key => $mov){

              if($mov->resolution==0){
                                       $text = 'HD';
                                    }elseif($mov->resolution==1){
                                       $text = 'SD';
                                    }
                                    elseif($mov->resolution==2){
                                       $text = 'HDCam';
                                    }
                                    elseif($mov->resolution==3){
                                       $text = 'Cam';
                                    }
                                    elseif($mov->resolution==4){
                                       $text = 'FullHD';
                                    }else{
                                        $text = 'Tralier';
                                    }
            $output.='<div class="item">
                              <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                                 <div class="item-link">';
                                 $img = substr($mov->image,0,5);
                                 if($img != 'https'){
                                 $output.='<img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />';
                                 }else{
                                 $output.='<img src="'.$mov->image.'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />';
                                 }
                                 $output.='<span class="is_trailer">
                                        '.$text.'
                                    </span>
                                 </div>
                                 <p class="title">'.$mov->title.'</p>
                              </a>';
                              if($mov->count_views>0){
                                $count_views = $mov->count_views;
                              }else{
                                $count_views = rand(100,99999);
                              }
                              $output.='<div class="viewsCount" style="color: #9d9d9d;">
                                  '.$count_views.' lượt quan tâm
                              </div>';

                              $output.='<div class="viewsCount" style="color: #9d9d9d;">'.$mov->year.'</div>
                              <div style="float: left;">
                                  <ul class="list-inline rating"  title="Average Rating">
                                  ';
                                                   for($count=1; $count<=5; $count++){
                                                    
                                                    $output.='<li title="star_rating" style="font-size:20px;color:#ffcc00;padding:0"                  

                                                    >&#9733;
                                                    </li>';
                                                     }
                                                            $output.='<ul class="list-inline rating"  title="Average Rating">
                              </div>
                           </div>';
        }
        echo $output;
    }
    public function filter_default(Request $request){
        
        $data = $request->all();
        $movie = Movie::where('topview',0)->orderBy('ngaycapnhat','DESC')->take(20)->get();
        $output = '';
        foreach($movie as $key => $mov){
            
             if($mov->resolution==0){
                                       $text = 'HD';
                                    }elseif($mov->resolution==1){
                                       $text = 'SD';
                                    }
                                    elseif($mov->resolution==2){
                                       $text = 'HDCam';
                                    }
                                    elseif($mov->resolution==3){
                                       $text = 'Cam';
                                    }
                                    elseif($mov->resolution==4){
                                       $text = 'FullHD';
                                    }else{
                                        $text = 'Tralier';
                                    }
            $output.='<div class="item">
                              <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                                 <div class="item-link">
                                    ';
                                    $img = substr($mov->image,0,5);
                                    if($img != 'https'){
                                    $output.='<img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />';
                                    }else{
                                    $output.='<img src="'.$mov->image.'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />';
                                    }
                                    $output.='<span class="is_trailer">
                                        '.$text.'
                                    </span>
                                 </div>
                                 <p class="title">'.$mov->title.'</p>
                              </a>';
                              
                              if($mov->count_views>0){
                                $count_views = $mov->count_views;
                              }else{
                                $count_views = rand(100,99999);
                              }
                              $output.='<div class="viewsCount" style="color: #9d9d9d;">
                                  '.$count_views.' lượt quan tâm
                              </div>';
                               $output.='<div class="viewsCount" style="color: #9d9d9d;">'.$mov->year.'</div>
                              <div style="float: left;">
                                   <ul class="list-inline rating"  title="Average Rating">
                                  ';
                                                   for($count=1; $count<=5; $count++){
                                                    
                                                    $output.='<li title="star_rating" style="font-size:20px;color:#ffcc00;padding:0"                  

                                                    >&#9733;
                                                    </li>';
                                                     }
                                                            $output.='<ul class="list-inline rating"  title="Average Rating">
                              </div>
                           </div>';
        }
        echo $output;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $list_genre = Genre::all();
        $country = Country::pluck('title','id');
        return view('admincp.movie.form', compact('category','genre','country','list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->trailer = $data['trailer'];
        $movie->sotap = $data['sotap'];
        $movie->tags = $data['tags'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->phude = $data['phude'];
        $movie->resolution = $data['resolution'];
        $movie->slug = $data['slug'];
        $movie->name_eng = $data['name_eng'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->country_id = $data['country_id'];
        $movie->count_views = rand(100,99999);
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        //them nhiu the loai phim
        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }
        
        $get_image = $request->file('image');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/',$new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        //them nhieu thể loại cho phim
        $movie->movie_genre()->attach($data['genre']);
        //them tap dau tien cho phim
        

        return redirect()->route('movie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $list_genre = Genre::all();
        $movie =  Movie::find($id);
        $movie_genre = $movie->movie_genre;
        return view('admincp.movie.form', compact('category','genre','country','movie','list_genre','movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();
        // return response()->json($data['genre']);
        $movie = Movie::find($id);
        $movie->resolution = $data['resolution'];
        $movie->tags = $data['tags'];
        $movie->trailer = $data['trailer'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->phude = $data['phude'];
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->name_eng = $data['name_eng'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->sotap = $data['sotap'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->country_id = $data['country_id'];
        // $movie->count_views = rand(100,99999);
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->file('image');

        if($get_image){
            if(file_exists('uploads/movie/'.$movie->image)){
                unlink('uploads/movie/'.$movie->image);
            }else{
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('uploads/movie/',$new_image);
                $movie->image = $new_image;
            }
        }

        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }
        $movie->save();
        $movie->movie_genre()->sync($data['genre']);
       
        return redirect()->route('movie.index');
    }
    public function sync_genre(Request $request){
        $movie = Movie::find($request->movie_id);
        $movie->movie_genre()->sync($request->genre);
    }
    public function update_tags(Request $request){
        $movie = Movie::find($request->movie_id);
        $movie->tags = $request->tags;
        $movie->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id); //30
        //xoa anh
        if(file_exists('uploads/movie/'.$movie->image)){
            unlink('uploads/movie/'.$movie->image);
        }
        //xoa the loai
        Movie_Genre::whereIn('movie_id',[$movie->id])->delete();
        //xoa tap phim
        Episode::whereIn('movie_id',[$movie->id])->delete();
        $movie->delete();

        return redirect()->back();
    }
    public function watch_video(Request $request){
    	$data = $request->all();
        $movie = Movie::find($data['movie_id']); //55
    	$video = Episode::where('movie_id',$data['movie_id'])->where('episode',$data['episode_id'])->first(); //8

    	$output['video_title'] = $movie->title.'- tập '.$video->episode;
    	$output['video_desc'] = $movie->description;

    	$output['video_link'] = $video->linkphim;

    	echo json_encode($output);

    }
   
}
