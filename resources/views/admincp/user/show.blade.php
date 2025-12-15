@extends('layouts.app')

@section('content')
<div class="main-page">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-user"></i> Chi tiết tài khoản: {{ $user->name }}
                <a href="{{ route('admincp.users.index') }}" class="btn btn-default btn-sm pull-right">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <div style="width: 150px; height: 150px; border-radius: 50%; background: #007bff; color: white; 
                              display: flex; align-items: center; justify-content: center; font-size: 48px; margin: 0 auto; border: 3px solid #007bff; font-weight: bold;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h3 class="mt-3">{{ $user->name }}</h3>
                        <p class="text-muted">{{ $user->email }}</p>
                        
                        <!-- VIP BADGE -->
                        <div class="mt-2">
                            @if($user->is_vip)
                                @if($user->isVipActive())
                                    <span class="badge bg-success" style="font-size: 16px; padding: 8px 16px;">
                                        <i class="fa fa-crown"></i> VIP CÒN HẠN
                                    </span>
                                @else
                                    <span class="badge bg-warning" style="font-size: 16px; padding: 8px 16px;">
                                        <i class="fa fa-clock"></i> VIP HẾT HẠN
                                    </span>
                                @endif
                            @else
                                <span class="badge bg-secondary" style="font-size: 16px; padding: 8px 16px;">
                                    <i class="fa fa-user"></i> THƯỜNG
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4>Thông tin tài khoản</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">ID:</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái VIP:</th>
                            <td>
                                @if($user->is_vip)
                                    @if($user->isVipActive())
                                        <span class="badge bg-success">
                                            <i class="fa fa-crown"></i> VIP Còn hạn
                                        </span>
                                        @if($user->vip_expired_at)
                                            (Hết hạn: {{ \Carbon\Carbon::parse($user->vip_expired_at)->format('d/m/Y H:i') }})
                                        @endif
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="fa fa-clock"></i> VIP Hết hạn
                                        </span>
                                        @if($user->vip_expired_at)
                                            (Đã hết hạn: {{ \Carbon\Carbon::parse($user->vip_expired_at)->format('d/m/Y H:i') }})
                                        @endif
                                    @endif
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fa fa-user"></i> Người dùng thường
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Phương thức đăng ký:</th>
                            <td>
                                @if($user->google_id)
                                    <i class="fa fa-google text-danger"></i> Google
                                @elseif($user->facebook_id)
                                    <i class="fa fa-facebook text-primary"></i> Facebook
                                @else
                                    <i class="fa fa-envelope text-secondary"></i> Email
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ngày đăng ký:</th>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Ngày cập nhật:</th>
                            <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Quyền Admin:</th>
                            <td>
                                @if($user->is_admin)
                                    <span class="badge bg-danger">
                                        <i class="fa fa-shield"></i> Quản trị viên
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fa fa-user"></i> Người dùng
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <!-- THÔNG TIN VIP CHI TIẾT -->
                    @if($user->is_vip)
                    <div class="card mt-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fa fa-crown"></i> Thông tin VIP
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Trạng thái:</strong> 
                                        @if($user->isVipActive())
                                            <span class="text-success">Đang hoạt động</span>
                                        @else
                                            <span class="text-warning">Đã hết hạn</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    @if($user->vip_expired_at)
                                        <p><strong>Thời hạn:</strong> 
                                            @if($user->isVipActive())
                                                @php
                                                    $daysLeft = \Carbon\Carbon::parse($user->vip_expired_at)->diffInDays(now());
                                                    $hoursLeft = \Carbon\Carbon::parse($user->vip_expired_at)->diffInHours(now()) % 24;
                                                @endphp
                                                Còn {{ $daysLeft }} ngày {{ $hoursLeft }} giờ
                                            @else
                                                Đã hết hạn {{ \Carbon\Carbon::parse($user->vip_expired_at)->diffForHumans() }}
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>
                            @if($user->vip_expired_at)
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Ngày hết hạn:</strong> 
                                        {{ \Carbon\Carbon::parse($user->vip_expired_at)->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    @if($user->isVipActive())
                                        <p><strong>Quyền lợi VIP:</strong> Không xem quảng cáo</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    <h4 class="mt-4">Quyền lợi VIP</h4>
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> 
                        @if($user->is_vip && $user->isVipActive())
                            <strong>Người dùng này đang có quyền lợi VIP:</strong>
                            <ul class="mt-2">
                                <li>Không hiển thị quảng cáo trên website</li>
                                <li>Trải nghiệm xem phim tốt hơn</li>
                            </ul>
                        @else
                            Người dùng này chưa đăng ký hoặc VIP đã hết hạn.
                        @endif
                    </div>

                    <!-- THỐNG KÊ ĐƠN GIẢN -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Tình trạng tài khoản</h5>
                                    @if($user->is_vip && $user->isVipActive())
                                        <div class="text-success">
                                            <i class="fa fa-check-circle fa-3x"></i>
                                            <p class="mt-2">Tài khoản VIP đang hoạt động</p>
                                        </div>
                                    @elseif($user->is_vip && !$user->isVipActive())
                                        <div class="text-warning">
                                            <i class="fa fa-clock fa-3x"></i>
                                            <p class="mt-2">VIP đã hết hạn</p>
                                        </div>
                                    @else
                                        <div class="text-secondary">
                                            <i class="fa fa-user fa-3x"></i>
                                            <p class="mt-2">Tài khoản thường</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Quyền hạn</h5>
                                    <div class="mt-3">
                                        @if($user->is_admin)
                                            <span class="badge bg-danger p-2">Admin</span>
                                        @endif
                                        @if($user->is_vip && $user->isVipActive())
                                            <span class="badge bg-success p-2 mt-2 d-block">No Ads</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .badge {
        font-size: 12px;
        padding: 4px 8px;
    }
    .card {
        border: 1px solid #007bff;
        margin-bottom: 15px;
    }
    .card-header {
        font-weight: bold;
    }
    .alert ul {
        margin-bottom: 0;
        padding-left: 20px;
    }
</style>
@endsection