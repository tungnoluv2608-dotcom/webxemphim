@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <a href="{{route('ads.index')}}" class="btn btn-primary">Liệt Kê quảng cáo</a>
                <div class="card-header">Quản lý quảng cáo</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                     @endif
                    @if(!isset($ads))
                        {!! Form::open(['route'=>'ads.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route'=>['ads.update',$ads->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif
                        <div class="form-group">
                            {!! Form::label('ads_name', 'Tên quảng cáo', []) !!}
                            {!! Form::text('ads_name', isset($ads) ? $ads->ads_name : '', ['class'=>'form-control','placeholder'=>'...']) !!}
                        </div>
                     
                        <div class="form-group">
                            {!! Form::label('ads_status', 'Trạng thái', []) !!}
                            {!! Form::select('ads_status', ['1'=>'Hiển thị','0'=>'Không hiển thị'], isset($ads) ? $ads->status : '', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('ads_link', 'Link Ads', []) !!}
                            {!! Form::text('ads_link', isset($ads) ? $ads->ads_link : '', ['class'=>'form-control','placeholder'=>'...']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('ads_position', 'Vị trí Ads', []) !!}
                            {!! Form::select('ads_position', $ads_position, isset($ads) ? $ads->ads_position : '', ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('ads_gif', 'Hình ảnh', []) !!}
                            {!! Form::file('ads_gif', ['class'=>'form-control-file']) !!}
                            @if(isset($ads))
                              <img width="150" src="{{asset('uploads/ads/'.$ads->ads_gif)}}">
                            @endif
                        </div>
                        @if(!isset($ads))
                            {!! Form::submit('Thêm Quảng cáo', ['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Cập Nhật Quảng cáo', ['class'=>'btn btn-success']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
