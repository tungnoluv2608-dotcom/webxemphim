@extends('admincp.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chỉnh Sửa Người Dùng: {{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.package.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label>Tên người dùng</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Gói dịch vụ hiện tại</label>
                            @if($user->currentPackage)
                                <input type="text" class="form-control" 
                                    value="{{ $user->currentPackage->package->name }} (Hết hạn: {{ $user->currentPackage->end_date->format('d/m/Y') }})" 
                                    readonly>
                            @else
                                <input type="text" class="form-control" value="Chưa có gói dịch vụ" readonly>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Chọn gói dịch vụ mới</label>
                            <select name="package_id" class="form-control" required>
                                <option value="">-- Chọn gói dịch vụ --</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}">
                                        {{ $package->name }} - {{ number_format($package->price) }} VNĐ
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ngày bắt đầu</label>
                            <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Ngày kết thúc</label>
                            <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d', strtotime('+30 days')) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật gói dịch vụ</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection