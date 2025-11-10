@extends('layouts.app')

@section('content')

<a href="{{route('leech-movie')}}" class="btn btn-primary btn-sm">Tất cả phim Leech</a>
<div class="table-responsive">
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên phim</th>
        <th scope="col">server_name</th>
        <th scope="col">Nguồn Embeb</th>
        <th scope="col">Nguồn M3U8</th>
        <th scope="col">manager</th>
      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($resp['episodes'] as $key => $res)
      <tr id="">
        <td scope="row">{{$key}}</td>
        <td scope="row">{{$resp['movie']['name']}}</td>
        <td scope="row">{{$res['server_name']}}</td>
       
        <td scope="row">
            <ul>
              
                @foreach($res['server_data'] as $key => $episode)
                <li>Tập: {{$episode['name']}}<input class="form-control" type="text" value="{{$episode['link_embed']}}"></li>
                @endforeach
               
               
            </ul>
        </td>
        <td scope="row">
            <ul>
              
                @foreach($res['server_data'] as $key => $episode2)
                <li>Tập: {{$episode2['name']}}<input class="form-control" type="text" value="{{$episode2['link_embed']}}"></li>
                @endforeach
               
               
            </ul>
        </td>
        <td>
            @if($movie)
              @if($count>0)
              <a href="{{route('leech-delete-episode',$resp['movie']['slug'])}}" class="btn btn-danger btn-sm">Xóa tất cả tập phim</a>
             
              @else
              <a href="{{route('leech-insert-episode',$resp['movie']['slug'])}}" class="btn btn-primary btn-sm">Đồng bộ tất cả tập phim</a>
              @endif
            
            @else
            <span class="text text-danger">Phim chưa thêm vui lòng thêm phim nhé.</span>
            <form action="{{route('leech-store')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$resp['movie']['slug']}}" name="slug">
                <input type="submit" class="btn btn-success btn-sm" value="Thêm phim">
              </form>
            @endif
        </td>
        
       
      
        
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection