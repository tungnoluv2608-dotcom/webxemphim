@extends('layouts.app')

@section('content')
<div class="table-responsive">
 
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Trình duyệt</th>
        <th scope="col">Loại trình duyệt</th>
        <th scope="col">Loại thiết bị</th>
        <th scope="col">Hệ điều hành/Version</th>
        <th scope="col">IP Address</th>
        <th scope="col">Bằng Điện thoại</th>
        
        <th scope="col">Preference</th>
        <th scope="col">Log</th>
        <th scope="col">Truy cập gần nhất</th>
        <th scope="col">Tổng truy cập trang</th>
        
      </tr>
    </thead>
    <tbody class="order_position">
      @foreach($users as $key => $session)
      <tr>
        <td>{{$key}}</td>
        <td>{{$session->agent->browser}}</td>
        <td>{{$session->agent->name}}</td>
        <td>{{$session->device->kind}}</td>
        <td>{{$session->device->platform}}/{{$session->device->platform_version}}</td>
        <td>{{$session->client_ip }}</td>
        <td>{{$session->device->is_mobile}}</td>
       
        <td>{{$session->language->preference}}</td>
        <td>
          @foreach ($session->log as $log)
            {{$log->path->path}}<br/>
          @endforeach
        </td>
       
        <td>{{$session->created_at->diffForHumans()}}</td>
        <td>{{$session->pageViews}}</td>
      </tr>
      @endforeach
    </tbody>
</table>

</div>

  @endsection
