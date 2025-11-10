@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sắp xếp phim</div>
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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <style>
                    .tieude_phim{
                        font-weight: bold;
                        color: blue;
                        font-size: 16px;
                        text-transform: uppercase;
                    }
                    ul#sortable_navbar li {
                        margin: 0 10px;
                    }
                    .box_phim {
                        height: 200px;
                        border: 1px solid #d1d1d1;
                        margin: 3px;
                        font-size: 12px;
                        padding: 5px;
                        text-align: center;
                        background-color: blanchedalmond;
                    }
                    </style>
                    <nav class="navbar navbar-inverse">
                        <div class="container-fluid">
                         
                          <ul class="nav navbar-nav category_position" id="sortable_navbar">
                            {{-- <li class="active"><a target="_blank" href="{{url('/')}}">Trang chủ</a></li> --}}
                            @foreach($category as $key => $cate)
                            <li id="{{$cate->id}}" class="ui-state-default"><a title="{{$cate->title}}" href="{{route('category',$cate->slug)}}">{{$cate->title}}</a></li>
                            @endforeach
                         
                          </ul>
                        </div>
                      </nav>
                    @foreach($category_home as $key => $cate_home)
                        <p class="tieude_phim">{{$cate_home->title}}</p>
                        <div class="row movie_position sortable_movie">
                            @foreach($cate_home->movie->sortBy('position')->take(16) as $key => $mov)
                            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12 box_phim" id="{{$mov->id}}">
                                <figure><img class="img-responsive" width="100%" src="{{asset('uploads/movie/'.$mov->image)}}" alt="error" title="{{$mov->title}}"></figure>
                                <p class="entry-title">{{$mov->title}}</p>
                               
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                    
                </div>
            </div>
          
        </div>
    </div>
</div>
@endsection
