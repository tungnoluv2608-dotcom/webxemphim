@extends('layouts.app')

@section('content')
<div class="row">

 <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><div id="content-title"></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="content-detail"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>




  <div class="col-md-3">
    Tổng phim : {{$resp['pagination']['totalItems']}}
  </div>
  <div class="col-md-2">
    Phim từng trang : {{$resp['pagination']['totalItemsPerPage']}}
  </div>
  <div class="col-md-2">
    Trang hiện tại : 
    <select class="form-control select-currentpage">
      @for($i=1;$i<=$resp['pagination']['totalPages'];$i++)
          <option value="{{Request::url()}}?page={{$i}}" {{$i==$resp['pagination']['currentPage'] ? 'selected' : ''}}>{{$i}}</option>
      @endfor
     
    </select>
    
    
  </div>
  <div class="col-md-2">
    Tổng trang : {{$resp['pagination']['totalPages']}}
  </div>
  <div class="col-md-2">
    @php
    if(isset($_GET['page'])){
       $page = $_GET['page'];
    }else{
       $page=1;
    }
    @endphp
    <form method="POST" id="myForm" action="{{route('store-all-movie-by-page-api',[$page])}}">
      @csrf
      <button type="submit" id="btn-submit" class="btn btn-sm btn-success">Đồng bộ tất cả phim trang 
        @php
        if(isset($_GET['page'])){
          echo  $page = $_GET['page'];
        }else{
          echo  $page=1;
        }
        @endphp
        
      </button>
    </form>
  </div>
 
</div>
<div class="table-responsive">
<table class="table table-responsive" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Thêm</th>
        {{-- <th scope="col">_id</th> --}}
        <th scope="col">name</th>
        <th scope="col">origin_name</th>
        <th scope="col">thumb_url</th>
        {{-- <th scope="col">poster_url</th> --}}
        <th scope="col">slug</th>
        <th scope="col">year</th>
        <th scope="col">manager</th>
      </tr>
    </thead>
    <tbody class="order_position">
      @foreach($resp['items'] as $key => $res)
      <tr id="">
        <td scope="row">{{$key}}</td>
        <td> 
          @php
            $movie = \App\Models\Movie::where('slug',$res['slug'])->first();
          @endphp
          @if(!$movie)
          <form action="{{route('leech-store')}}" method="POST">
            @csrf
            <input type="hidden" value="{{$res['slug']}}" name="slug">
            <input type="submit" class="btn btn-success btn-sm" value="Thêm phim">
          </form>
          @else
          <span class="text text-danger">Đã thêm phim</span>
          @endif
          
        
        </td>
        {{-- <td>{{$res['_id']}}</td> --}}
        <td>{{$res['name']}}</td>
        <td>{{$res['origin_name']}}</td>
        <td><img width="100" src="{{$resp['pathImage'].$res['thumb_url']}}"></td>
        {{-- <td><img width="100" src="{{$resp['pathImage'].$res['poster_url']}}"></td> --}}
        <td>{{$res['slug']}}</td>
        <td>{{$res['year']}}</td>
        <td>
          <button type="button" class="btn btn-primary btn-sm leech_details" data-slug="{{$res['slug']}}" data-toggle="modal" data-target="#exampleModalCenter">
            Xem chi tiết phim
          </button>
            {{-- <a href="{{route('leech-detail',$res['slug'])}}" class="btn btn-warning btn-sm">Xem chi tiết phim</a> --}}
            <a href="{{route('leech-episode',$res['slug'])}}" class="btn btn-danger btn-sm">Xem tập phim</a> 
        </td>
      
      
      </tr>
      @endforeach
    </tbody>
  </table>

</div>

  @endsection