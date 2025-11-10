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
           
           
              <div class="card-header">Thêm Script quảng cáo</div>
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
               @endif
              
                  
                 
           
             
              <form method="POST" action="{{route('store-script-adsnetwork')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên đoạn quảng cáo</label>
                  <input type="text" name="title" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="....">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Đoạn Script</label>
                  <textarea name="script" rows="10" style="resize:none" required class="form-control" id="exampleInputPassword1" placeholder="...."></textarea>
                </div>
                <div class="form-group form-check">
                    <label for="exampleInputPassword1">Tình trạng</label>
                    <select class="form-control" name="adsnetwork_id">
                        @foreach($ads as $key => $ad)
                        <option value="{{$ad->id}}">{{$ad->title}}</option>
                        @endforeach
                    </select>
                </div>
               
                <div class="form-group form-check">
                    <label for="exampleInputPassword1">Tình trạng</label>
                    <select class="form-control" name="status">
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
               <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên quảng cáo</th>
                        <th>Script</th>
                        <th>Nhà quảng cáo</th>
                        <th>Tình trạng</th>
                        <th>Quản lý</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($ads_script as $key => $ad)
                      <tr>
                        <td>{{$key}}</td>
                        <td>{{$ad->title}}</td>
                        <td>{{$ad->script}}</td>
                        <td>{{$ad->adsnetwork->title}}</td>
                        <td>
                            @if($ad->status==1)
                                Hiển thị
                            @else
                                Ẩn

                            @endif
                        </td>
                        <td>
                            <a href="{{route('update-adsnetwork-script',[$ad->id])}}" class="btn btn-warning btn-sm">Cập nhật</a>
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