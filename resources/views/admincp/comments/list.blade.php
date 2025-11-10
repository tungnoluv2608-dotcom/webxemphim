@extends('layouts.app')

@section('content')


<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Họ tên</th>
        <th scope="col">Email</th>
        <th scope="col">Bình luận</th>
        <th scope="col">Phim</th>
        <th scope="col">ID bình luận</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Quản lý</th>
      </tr>
    </thead>
    <tbody class="order_position">
      @foreach($comments as $key => $com)
      <tr id="{{$com->id}}">
        <th scope="row">{{$key}}</th>
        <td>{{$com->name}}</td>
        <td>{{$com->email}}</td>
        <td>{{$com->comment}}</td>
        <td>{{$com->movie->title}}</td>
        <td>{{$com->visitor_id}}</td>
        <td>
          @if($com->status==0)
              Ẩn
          @else
              Hiển thị
          @endif
        </td>
        <td>
            @if($com->status==0)
                <a href="{{route('toggle-comment',['status'=>1,'id'=>$com->id])}}" class="btn btn-warning btn-success">Bật</a>
            @else
                <a href="{{route('toggle-comment',['status'=>0,'id'=>$com->id])}}" class="btn btn-warning btn-danger">Tắt</a>
            @endif
           
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>


@endsection