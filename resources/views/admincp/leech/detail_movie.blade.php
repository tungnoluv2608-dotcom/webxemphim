@extends('layouts.app')

@section('content')

<div class="table-responsive">
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">_id</th>
        <th scope="col">name</th>
        <th scope="col">origin_name</th>
        <th scope="col">slug</th>
        <th scope="col">content</th>
        <th scope="col">type</th>
        <th scope="col">status</th>
        <th scope="col">thumb_url</th>
        <th scope="col">poster_url</th>
        <th scope="col">is_copyright</th>
        <th scope="col">sub_docquyen</th>
        <th scope="col">chieurap</th>
        <th scope="col">trailer_url</th>
        <th scope="col">time</th>
        <th scope="col">episode_current</th>
        <th scope="col">episode_total</th>
        <th scope="col">quality</th>
        <th scope="col">lang</th>
        <th scope="col">notify</th>
        <th scope="col">showtimes</th>
        <th scope="col">year</th>
        <th scope="col">view</th>
        <th scope="col">actor</th>
        <th scope="col">director</th>
        <th scope="col">category</th>
        <th scope="col">country</th>
        

      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($resp_array as $key => $res)
      <tr id="">
        <td scope="row">{{$key}}</td>
        <td>{{$res['_id']}}</td>
        <td>{{$res['name']}}</td>
        <td>{{$res['origin_name']}}</td>
        <td>{{$res['slug']}}</td>
        <td>{!! substr($res['content'],0,50)!!}.....</td>
        <td>{{$res['type']}}</td>
        <td>{{$res['status']}}</td>
        <td><img width="100" src="{{$res['thumb_url']}}"></td>
        <td><img width="100" src="{{$res['poster_url']}}"></td>
        
        <td>
    
       @if($res['is_copyright']==true)
            <span class="text text-success">True</span>
       @else
            <span class="text text-danger">False</span>
       @endif
        </td>
        <td> 
            @if($res['sub_docquyen']==true)
            <span class="text text-success">True</span>
       @else
            <span class="text text-danger">False</span>
       @endif
    </td>
    <td> 
        @if($res['chieurap']==true)
        <span class="text text-success">True</span>
   @else
        <span class="text text-danger">False</span>
   @endif
</td>
        <td>{{$res['trailer_url']}}</td>
        <td>{{$res['time']}}</td>
        <td>{{$res['episode_current']}}</td>
        <td>{{$res['episode_total']}}</td>
        <td>{{$res['quality']}}</td>
        <td>{{$res['lang']}}</td>
        <td>{{$res['notify']}}</td>
        <td>{{$res['showtimes']}}</td>
        <td>{{$res['year']}}</td>
        <td>{{$res['view']}}</td>
        <td>
            @foreach($res['actor'] as $act)
            <span class="badge badge-pill badge-info">{{$act}}</span>
            @endforeach
        </td>
        <td>
            @foreach($res['director'] as $dir)
            <span class="badge badge-pill badge-info">{{$dir}}</span>
            @endforeach
        </td>
        <td>
            @foreach($res['category'] as $cate)
            <span class="badge badge-pill badge-info">{{$cate['name']}}</span>
            @endforeach
        </td>
        <td>
            @foreach($res['country'] as $country)
            <span class="badge badge-pill badge-info">{{$country['name']}}</span>
            @endforeach
        </td>
        
       
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection