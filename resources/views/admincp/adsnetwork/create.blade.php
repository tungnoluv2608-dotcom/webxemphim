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
           
             <a href="{{route('adsnetwork.index')}}" class="btn btn-danger">Liệt kê nhà mạng quảng cáo</a>
              <div class="card-header">Quản Lý Quảng cáo</div>
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
               @endif
              
                  
                 
           
             
              <form method="POST" action="{{route('adsnetwork.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên nhà mạng</label>
                  <input type="text" name="title" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="....">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Link xác thực</label>
                  <input type="text" name="link_confirmed" required class="form-control" id="exampleInputPassword1" placeholder="....">
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
                        <th>Tên nhà mạng</th>
                        <th>Link xác nhận</th>
                        <th>Tình trạng</th>
                        <th>Quản lý</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($ads as $key => $ad)
                      <tr>
                        <td>{{$key}}</td>
                        <td>{{$ad->title}}</td>
                        <td>{{$ad->link_confirmed}}</td>
                        <td>
                            @if($ad->status==1)
                                Hiển thị
                            @else
                                Ẩn

                            @endif
                        </td>
                        <td>
                            <a href="{{route('adsnetwork.edit',[$ad->id])}}" class="btn btn-warning btn-sm">Cập nhật</a>
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