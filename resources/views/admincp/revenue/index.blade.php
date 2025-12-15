@extends('layouts.app')

@section('content')
<div class="main-page">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-chart-line"></i> Thống kê doanh thu VIP
            </h3>
        </div>
        <div class="panel-body">
            <!-- FILTER THỜI GIAN -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fa fa-filter"></i> Lọc thời gian
                    </h5>
                </div>
                <div class="card-body">
                    <form method="GET" class="form-inline">
                        <div class="filter-buttons mb-3">
                            @php
                                $filters = [
                                    'today' => ['label' => 'Hôm nay', 'icon' => 'fa-calendar-day'],
                                    'week' => ['label' => 'Tuần này', 'icon' => 'fa-calendar-week'],
                                    'month' => ['label' => 'Tháng này', 'icon' => 'fa-calendar-alt'],
                                    'year' => ['label' => 'Năm nay', 'icon' => 'fa-calendar'],
                                    'custom' => ['label' => 'Tùy chọn', 'icon' => 'fa-cog'],
                                ];
                            @endphp
                            
                            @foreach($filters as $key => $filterData)
                            <button type="submit" name="filter" value="{{ $key }}" 
                                    class="btn btn-sm mb-2 mr-2 {{ $filter == $key ? 'btn-primary' : 'btn-outline-secondary' }}">
                                <i class="fa {{ $filterData['icon'] }} mr-1"></i>
                                {{ $filterData['label'] }}
                            </button>
                            @endforeach
                        </div>
                        
                        @if($filter == 'custom')
                        <div class="custom-filter mt-3 p-3 bg-light rounded">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fa fa-calendar-start mr-1"></i> Từ ngày
                                        </label>
                                        <input type="date" name="start_date" 
                                               value="{{ $startDate->format('Y-m-d') }}" 
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fa fa-calendar-end mr-1"></i> Đến ngày
                                        </label>
                                        <input type="date" name="end_date" 
                                               value="{{ $endDate->format('Y-m-d') }}" 
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fa fa-search mr-1"></i> Lọc
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>
                    
                    <div class="mt-3">
                        <span class="badge bg-info">
                            <i class="fa fa-clock mr-1"></i> 
                            {{ $startDate->format('d/m/Y') }} → {{ $endDate->format('d/m/Y') }}
                        </span>
                        <small class="text-muted ml-2">
                            ({{ $startDate->diffInDays($endDate) + 1 }} ngày)
                        </small>
                    </div>
                </div>
            </div>

            <!-- THỐNG KÊ TỔNG QUAN -->
            <div class="row mb-4">
                @php
                    $statCards = [
                        [
                            'title' => 'Tổng doanh thu',
                            'value' => number_format($stats['total_revenue']) . ' đ',
                            'subtitle' => '+' . number_format($stats['period_revenue']) . ' đ kỳ này',
                            'bg_class' => 'bg-primary',
                            'icon' => 'fa-money-bill-wave'
                        ],
                        [
                            'title' => 'Tổng đơn hàng',
                            'value' => number_format($stats['total_orders']),
                            'subtitle' => '+' . $stats['period_orders'] . ' đơn kỳ này',
                            'bg_class' => 'bg-success',
                            'icon' => 'fa-shopping-cart'
                        ],
                        [
                            'title' => 'Tổng người dùng',
                            'value' => number_format($stats['total_users']),
                            'subtitle' => '+' . $stats['period_new_users'] . ' user mới',
                            'bg_class' => 'bg-info',
                            'icon' => 'fa-users'
                        ],
                        [
                            'title' => 'VIP Active',
                            'value' => number_format($stats['active_vip_users']),
                            'subtitle' => 'Tổng: ' . $stats['total_vip_users'] . ' VIP',
                            'bg_class' => 'bg-warning',
                            'icon' => 'fa-crown'
                        ],
                    ];
                @endphp
                
                @foreach($statCards as $card)
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fa {{ $card['icon'] }} fa-2x {{ $card['bg_class'] }} text-white p-3 rounded-circle"></i>
                            </div>
                            <h6 class="card-title text-muted mb-2">
                                {{ $card['title'] }}
                            </h6>
                            <h4 class="mb-3">
                                {{ $card['value'] }}
                            </h4>
                            <small class="text-muted">
                                {{ $card['subtitle'] }}
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- DANH SÁCH ĐƠN HÀNG VIP -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fa fa-list-alt mr-2"></i> 
                        Danh sách đơn hàng VIP
                        <span class="badge bg-primary ml-2">
                            {{ $vipOrders->total() }} đơn
                        </span>
                    </h5>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Người dùng</th>
                                    <th>Gói VIP</th>
                                    <th>Số tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vipOrders as $order)
                                @php
                                    $packageName = match($order->amount) {
                                        20000 => 'VIP 1 Tuần',
                                        70000 => 'VIP 1 Tháng',
                                        150000 => 'VIP 3 Tháng',
                                        400000 => 'VIP 6 Tháng',
                                        default => 'VIP ' . number_format($order->amount) . ' đ',
                                    };
                                    
                                    // Màu sắc cho từng gói VIP
                                    $packageColor = match($order->amount) {
                                        20000 => 'badge-vip-week',    // Xanh lá cây
                                        70000 => 'badge-vip-month',   // Xanh dương
                                        150000 => 'badge-vip-3month', // Cam
                                        400000 => 'badge-vip-6month', // Đỏ
                                        default => 'badge-secondary', // Xám
                                    };
                                    
                                    // Màu số tiền
                                    $amountColor = match($order->amount) {
                                        20000 => 'text-success',
                                        70000 => 'text-primary',
                                        150000 => 'text-warning',
                                        400000 => 'text-danger',
                                        default => 'text-dark',
                                    };
                                @endphp
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $order->order_code ?: 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($order->user)
                                        <div class="d-flex align-items-center">
                                            <div class="mr-2">
                                                @php
                                                    $colors = ['#007bff', '#28a745', '#dc3545', '#fd7e14'];
                                                    $color = $colors[array_rand($colors)];
                                                    $initial = strtoupper(substr($order->user->name, 0, 1));
                                                @endphp
                                                <div style="width: 35px; height: 35px; border-radius: 50%; background: {{ $color }}; color: white; 
                                                      display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                                    {{ $initial }}
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    {{ $order->user->name }}
                                                </div>
                                                <small class="text-muted">
                                                    {{ $order->user->email }}
                                                </small>
                                            </div>
                                        </div>
                                        @else
                                        <span class="text-muted font-italic">
                                            <i class="fa fa-user-slash mr-1"></i> User đã xóa
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $packageColor }}">
                                            <i class="fa fa-crown mr-1"></i> {{ $packageName }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong class="{{ $amountColor }}">{{ number_format($order->amount) }} đ</strong>
                                    </td>
                                    <td>
                                        @if($order->status == 'completed')
                                            <span class="badge bg-success">
                                                <i class="fa fa-check-circle mr-1"></i> Hoàn thành
                                            </span>
                                        @elseif($order->status == 'pending')
                                            <span class="badge bg-warning">
                                                <i class="fa fa-clock mr-1"></i> Chờ xử lý
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fa fa-times-circle mr-1"></i> {{ $order->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>{{ $order->created_at->format('d/m/Y') }}</div>
                                        <small class="text-muted">
                                            {{ $order->created_at->format('H:i') }}
                                        </small>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fa fa-inbox fa-2x text-muted mb-2"></i>
                                        <div>Không có đơn hàng nào</div>
                                        <small class="text-muted">
                                            Hãy thử chọn khoảng thời gian khác
                                        </small>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- PHÂN TRANG - NẰM BÊN PHẢI -->
                @if($vipOrders->hasPages())
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-muted mt-2">
                                Hiển thị {{ $vipOrders->firstItem() }} đến {{ $vipOrders->lastItem() }} 
                                của {{ $vipOrders->total() }} đơn hàng
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination mb-0">
                                        <!-- Nút Trang trước -->
                                        @if($vipOrders->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fa fa-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $vipOrders->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}">
                                                    <i class="fa fa-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        <!-- Các số trang -->
                                        @php
                                            $currentPage = $vipOrders->currentPage();
                                            $lastPage = $vipOrders->lastPage();
                                            $startPage = max(1, $currentPage - 2);
                                            $endPage = min($lastPage, $currentPage + 2);
                                        @endphp
                                        
                                        @if($startPage > 1)
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $vipOrders->url(1) . '&' . http_build_query(request()->except('page')) }}">
                                                    1
                                                </a>
                                            </li>
                                            @if($startPage > 2)
                                                <li class="page-item disabled">
                                                    <span class="page-link">...</span>
                                                </li>
                                            @endif
                                        @endif
                                        
                                        @for ($page = $startPage; $page <= $endPage; $page++)
                                            @if($page == $vipOrders->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link">
                                                        {{ $page }}
                                                    </span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $vipOrders->url($page) . '&' . http_build_query(request()->except('page')) }}">
                                                        {{ $page }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endfor
                                        
                                        @if($endPage < $lastPage)
                                            @if($endPage < $lastPage - 1)
                                                <li class="page-item disabled">
                                                    <span class="page-link">...</span>
                                                </li>
                                            @endif
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $vipOrders->url($lastPage) . '&' . http_build_query(request()->except('page')) }}">
                                                    {{ $lastPage }}
                                                </a>
                                            </li>
                                        @endif

                                        <!-- Nút Trang sau -->
                                        @if($vipOrders->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $vipOrders->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fa fa-chevron-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    .table td, .table th {
        vertical-align: middle;
    }
    .badge {
        font-size: 12px;
        padding: 4px 8px;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0,0,0,.02);
    }
    
    /* Màu sắc cho các gói VIP */
    .badge-vip-week {
        background-color: #28a745 !important;
        color: white !important;
    }
    .badge-vip-month {
        background-color: #007bff !important;
        color: white !important;
    }
    .badge-vip-3month {
        background-color: #fd7e14 !important;
        color: white !important;
    }
    .badge-vip-6month {
        background-color: #dc3545 !important;
        color: white !important;
    }
    
    /* Màu số tiền */
    .text-success {
        color: #28a745 !important;
    }
    .text-primary {
        color: #007bff !important;
    }
    .text-warning {
        color: #fd7e14 !important;
    }
    .text-danger {
        color: #dc3545 !important;
    }
    
    /* Phân trang nằm bên phải */
    .pagination {
        margin-bottom: 0;
    }
    .page-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
    }
</style>
@endsection