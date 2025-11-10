@extends('layouts.app')

@section('content')
<!-- Modal -->
<div class="modal fade" id="theloai" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><span class="text-movie"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="hiddenValue" id="hiddenValue" value="" />
            <span id="body-capnhat"></span>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary luu-theloai">Lưu</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="videoModal"  tabindex="-1"  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span id="video_title"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="video_desc"></p>
        <p id="video_link"></p>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{route('movie.create')}}" class="btn btn-primary">Thêm Phim</a>
            
            <div class="table-responsive">
            <table class="table" id="tablephim">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tên phim</th>
                  <th scope="col" style="width: 50%">Thể loại</th>
                  <th scope="col">Tùy chỉnh</th>
                  {{-- <th scope="col">Phim hot</th>
                  <th scope="col">Định dạng</th>
                  <th scope="col">Phụ đề</th> --}}

                  <th scope="col">Tập phim</th>
                  {{-- <th scope="col">Số tập</th> --}}
                  <th scope="col">Tags</th> 
                  <th scope="col">Thời lượng phim</th>
                  <th scope="col">Hình ảnh</th>
                
                  <!-- <th scope="col">Mô tả</th> -->
                  <th scope="col">Đường dẫn</th>
                  {{-- <th scope="col">Trạng thái</th>

                  <th scope="col">Danh mục</th>
                 
                  <th scope="col">Quốc gia</th>

                  <th scope="col">Thuộc phim</th> --}}
                  <th scope="col">Ngày tạo</th>
                  {{-- <th scope="col">Ngày cập nhật</th> --}}
                  {{-- <th scope="col">Năm phim</th>
                  <th scope="col">Top views</th>
                  <th scope="col">Season</th> --}}
                  <th scope="col">Quản lý</th>
                </tr>
              </thead>
              <tbody>
                @foreach($list as $key => $cate)
                <tr>
                  <th scope="row">{{$key}}</th>
                  <td>{{$cate->title}}</td>
                  <td>
                    {{-- @foreach($cate->movie_genre as $gen)
                    <span class="badge badge-dark">{{$gen->title}}</span>
                    @endforeach --}}
                    @foreach($cate->movie_genre as $gen)
                    <span class="badge badge-dark">{{$gen->title}}</span>
                    
                    @endforeach
                    <button type="button" class="btn btn-success btn-sm capnhat-theloai" data-theloai_movie_id="{{$cate->id}}" data-movie_title="{{$cate->title}}" data-toggle="modal" data-target="#theloai">
                      Cập nhật
                    </button>
                  </td>
                  <td>
                    <p>Phim hot</p>
                    <select id="{{$cate->id}}" class="phimhot_choose">
                      @if($cate->phim_hot==0)
                      <option value="1">Hot</option>
                      <option selected value="0">Không</option>
                      @else
                      <option selected value="1">Hot</option>
                      <option value="0">Không</option>
                      @endif
                    </select>
                    <p>Định dạng</p>
                    
                    @php
                    $options = array('0'=>'HD','1'=>'SD','2'=>'HDCam','3'=>'Cam','4'=>'FullHD','5'=>'Trailer');
                    @endphp
                    <select id="{{$cate->id}}" class="resolution_choose">
                    
                    @foreach($options as $key => $resolution)

                      <option {{$cate->resolution==$key ? 'selected' : ''}} value="{{$key}}">{{$resolution}}</option>
                    @endforeach
                  </select>
                  <p>Phụ đề</p>
                  <select id="{{$cate->id}}" class="phude_choose">
                    @if($cate->phude==0)
                    <option value="1">Thuyết minh</option>
                    <option selected value="0">Phụ đề</option>
                    @else
                    <option selected value="1">Thuyết minh</option>
                    <option value="0">Phụ đề</option>
                    @endif
                  </select>
                  <p>Trạng thái</p>
                  <select id="{{$cate->id}}" class="trangthai_choose">
                    @if($cate->status==0)
                    <option value="1">Hiển thị</option>
                    <option selected value="0">Không</option>
                    @else
                    <option selected value="1">Hiển thị</option>
                    <option value="0">Không</option>
                    @endif
                  </select>
                  <p>Danh mục</p>
                  {!! Form::select('category_id', $category, isset($cate) ? $cate->category->id : '', ['class'=>' category_choose','id'=> $cate->id]) !!}
                  <p>Quốc gia</p>
                  {!! Form::select('country_id', $country, isset($cate) ? $cate->country->id : '', ['class'=>' country_choose','id'=> $cate->id]) !!}
                  {{-- <p>Thuộc phim</p>
                  <select id="{{$cate->id}}" class="thuocphim_choose">
                    @if($cate->thuocphim=='phimbo')
                    <option value="phimle">Phim lẻ</option>
                    <option selected value="phimbo">Phim Bộ</option>
                    @else
                    <option selected value="phimle">Phim lẻ</option>
                    <option value="phimbo">Phim Bộ</option>
                    @endif
                  </select> --}}
                  <p>Năm phim</p>
                  {!! Form::selectYear('year',2000,2030, isset($cate->year) ? $cate->year : '' ,['class'=>'select-year','id'=>$cate->id,'placeholder' => '--Năm phim--']) !!}
                  <p>Top views</p>
                  {!! Form::select('topview', ['0'=>'Ngày','1'=>'Tuần','2'=>'Tháng'], isset($cate->topview) ? $cate->topview : '', ['class'=>'select-topview','id'=>$cate->id,'placeholder' => '--Views--']) !!}
                  <p>Season</p>
                  {!! Form::selectRange('season',1,30, isset($cate->season) ? $cate->season : '' ,['class'=>'select-season','id'=>$cate->id,'placeholder' => '--Season--']) !!}
                  </td>
                 

                 
                  <td>
                    <p><a href="{{route('add-episode',[$cate->id])}}" class="btn btn-danger btn-sm">Thêm tập phim</a></p>
                    <p>Số tập : {{$cate->episode_count}}/{{$cate->sotap}}</p>
                    @if($cate->episode->count()>0)
                    <a class="" data-toggle="collapse" href="#collapseExample-{{$cate->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Xem tập phim
                    </a>
                    @endif
                    <div class="collapse" id="collapseExample-{{$cate->id}}">
                      <div class="card card-body">
                        @foreach($cate->episode as $key => $epi)
                        <a 
                          class="show_video" 
                          data-movie_video_id="{{$epi->movie_id}}" 
                          data-video_episode="{{$epi->episode}}" 
                          
                          style="color:#fff;cursor: pointer">
                          <span class="badge badge-dark">{{$epi->episode}}</span>
                        </a>
                        @endforeach
                      </div>
                    </div>
                       
                   
                  
                  
                  </td>
                  </td>
                 
                  <td>
                    @if(strlen($cate->tags)>10)
                      @php
                        $tags = substr($cate->tags, 0,200);
                       
                      @endphp
                        <textarea rows="5" name="tags" class="update-tags-{{$cate->id}}">{{$tags}}</textarea>
                        <input type="button" data-movie_id="{{$cate->id}}" class="btn btn-primary btn-sm btn-update-tags" value="Up">
                    @endif

                  </td>
                  <td>{{$cate->thoiluong}}</td>
                  <td>
                    
                    @php 
                      $img = substr($cate->image,0,5);
                    @endphp
                    @if($img != 'https')
                    <img width="100" src="{{asset('uploads/movie/'.$cate->image)}}">
                    @else
                    <img width="100" src="{{$cate->image}}">
                    @endif
                    
                    <input type="file" data-movie_id="{{$cate->id}}" id="file-{{$cate->id}}" class="form-control-file file_image" accept="image/*"> <!--jpg,png,gif...v..-->

                    <span id="success_image"></span>

                  </td>
                
                 
                  <td>{{$cate->slug}}</td>
                 
                
                  

                  
                 
                  

                 
                  <td>{{$cate->ngaytao}}</td>
                  {{-- <td>{{$cate->ngaycapnhat}}</td> --}}
                 
                  <td>
                      {!! Form::open(['method'=>'DELETE','route'=>['movie.destroy',$cate->id],'onsubmit'=>'return confirm("Bạn có chắc muốn xóa?")']) !!}
                        {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                      {!! Form::close() !!}
                      <a href="{{route('movie.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection
