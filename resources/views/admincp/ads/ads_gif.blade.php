@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <style>
              ul.position_ads li {
              display: inline-block;
              /* border: 1px solid #ddd; */
              margin: 0 6px;
              text-align: center;
              font-weight: bold;
          }
            </style>
             <a href="{{route('ads.create')}}" class="btn btn-primary">Thêm quảng cáo</a>
             <a href="{{route('ads.index')}}" class="btn btn-danger">Liệt kê quảng cáo</a>
              <div class="card-header">Quản Lý Quảng cáo</div>
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
               @endif
              
                  
                 
           
              <ul class="position_ads">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Vị trí</th>
                      <th>Thêm quảng cáo</th>
                      <th>Tình trạng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($ads_position as $key => $position2)
                    <tr>
                      <td>{{$position2->ads_position_name}} </td>
                      <td><a href="{{route('ads-gif',[$position2->id])}}" class="btn btn-primary btn-sm">Thêm quảng cáo theo vị trí</a></td>
                      <td><form method="POST" action="{{url('admin/turn-onoff-ads'.'/'.$position2->id)}}">
                        @csrf
                          @if($position2->ads_position_status==1)
                          
                          <input type="hidden" name="ads_status" value="0">
                          <input type="submit" class="btn btn-danger btn-sm" value="Tắt">
                          @else
                         
                          <input type="hidden" name="ads_status" value="1">
                          <input type="submit" class="btn btn-success btn-sm" value="Bật">
                          @endif
                        </form></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
               
             
              </ul>
              <form method="POST" action="{{route('ads.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên quảng cáo</label>
                  <input type="text" name="ads_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="....">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Link quảng cáo</label>
                  <input type="text" name="ads_link" class="form-control" id="exampleInputPassword1" placeholder="....">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Hình ảnh quảng cáo</label>
                    <input type="file" name="ads_gif" class="form-control-file" id="exampleInputPassword1">
                  </div>
                  <div class="form-group form-check">
                    <label for="exampleInputPassword1">Vị trí</label>
                    <select class="form-control" name="ads_position">
                        @foreach($ads_position as $key => $posi)

                        <option {{($posi->id==$id) ? 'selected' : ''}} value="{{$posi->id}}">{{$posi->ads_position_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-check">
                    <label for="exampleInputPassword1">Tình trạng</label>
                    <select class="form-control" name="ads_status">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Thêm</button>
              </form>
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <div class="card-body">
                <table class="table" id="tablephim">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tên quảng cáo</th>
                      <th scope="col">Link quảng cáo</th>
                      <th scope="col">Hình ảnh</th>
                      <th scope="col">Vị trí</th>
                      <th scope="col">Trạng thái</th>
                      <th scope="col">Quản lý</th>
                    </tr>
                  </thead>
                  <tbody class="">
                    @foreach($ads as $key => $ad)
                    <tr>
                      <th scope="row">{{$key}}</th>
                      <td>{{$ad->ads_name}}</td>
                      <td>{{$ad->ads_link}}</td>
                      <td><img width="150" src="{{asset('uploads/ads/'.$ad->ads_gif)}}"></td>
                      <td>
                        @foreach($ads_position as $key => $position)
                          @if($position->id == $ad->ads_position)

                            {{$position->ads_position_name}}
                          @endif
                        @endforeach
                      </td>
                      <td>
                        @if($ad->ads_status==1)
                            Hiển thị
                        @else
                            Không hiển thị
                        @endif
                      </td>
                      <td>
                          {!! Form::open(['method'=>'DELETE','route'=>['ads.destroy',$ad->id],'onsubmit'=>'return confirm("Bạn có chắc muốn xóa?")']) !!}
                            {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                          {!! Form::close() !!}
                          <a href="{{route('ads.edit',$ad->id)}}" class="btn btn-warning">Sửa</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              
              </div>
          </div>
         
      </div>
  </div>
</div>


@endsection