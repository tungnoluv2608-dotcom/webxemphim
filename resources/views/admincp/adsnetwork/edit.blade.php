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
           <a href="{{route('adsnetwork.create')}}" class="btn btn-success">Thêm nhà mạng quảng cáo</a>
             <a href="{{route('adsnetwork.create')}}" class="btn btn-danger">Liệt kê nhà mạng quảng cáo</a>
              <div class="card-header">Quản Lý Quảng cáo</div>
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
               @endif
              
                  
                 
           
             
              <form method="POST" action="{{route('adsnetwork.update',[$ads->id])}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên nhà mạng</label>
                  <input type="text" name="title" value="{{$ads->title}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="....">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Link xác thực</label>
                  <input type="text" name="link_confirmed" value="{{$ads->link_confirmed}}"  required class="form-control" id="exampleInputPassword1" placeholder="....">
                </div>
               
                <div class="form-group form-check">
                    <label for="exampleInputPassword1">Tình trạng</label>
                    <select class="form-control" name="status">
                        @if($ads->status==1)
                        <option selected value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                        @else
                        <option value="1">Hiển thị</option>
                        <option selected value="0">Ẩn</option>

                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
            
          </div>
         
      </div>
  </div>
</div>


@endsection