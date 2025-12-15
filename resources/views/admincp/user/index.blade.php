@extends('layouts.app')

@section('content')
<div class="main-page">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-users"></i> Quản lý tài khoản
            </h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="userTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên người dùng</th>
                            <th scope="col">Email</th>
                            <th scope="col">Trạng thái VIP</th>
                            <th scope="col">Ngày đăng ký</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <th scope="row">{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @php
                                            $colors = [
                                                '#007bff',
                                                '#28a745',
                                                '#dc3545',
                                                '#fd7e14',
                                                '#6f42c1',
                                                '#e83e8c',
                                            ];
                                            $color = $colors[array_rand($colors)];
                                            $initial = strtoupper(substr($user->name, 0, 1));
                                        @endphp
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $color }}; color: white; 
                                              display: flex; align-items: center; justify-content: center; margin-right: 10px; font-size: 16px; font-weight: bold;">
                                            {{ $initial }}
                                        </div>
                                        <div>
                                            <strong>{{ $user->name }}</strong>
                                            @if($user->is_admin)
                                                <span class="badge bg-danger ms-1">Admin</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->is_vip)
                                        @if($user->isVipActive())
                                            <span class="badge bg-success">
                                                <i class="fa fa-crown"></i> VIP Còn hạn
                                            </span>
                                            @if($user->vip_expired_at)
                                                <br>
                                                <small class="text-muted">
                                                    Hết hạn: {{ \Carbon\Carbon::parse($user->vip_expired_at)->format('d/m/Y') }}
                                                </small>
                                            @endif
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fa fa-clock"></i> VIP Hết hạn
                                            </span>
                                            @if($user->vip_expired_at)
                                                <br>
                                                <small class="text-muted">
                                                    Đã hết: {{ \Carbon\Carbon::parse($user->vip_expired_at)->format('d/m/Y') }}
                                                </small>
                                            @endif
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fa fa-user"></i> Thường
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admincp.users.show', $user->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Xem
                                    </a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['admincp.users.destroy', $user->id],
                                        'onsubmit' => 'return confirm("Bạn có chắc muốn xóa tài khoản này?")',
                                        'style' => 'display: inline;',
                                    ]) !!}
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Xóa
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Phân trang -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <p class="text-muted">
                        Hiển thị {{ $users->firstItem() ?? 0 }} đến {{ $users->lastItem() ?? 0 }} 
                        trong tổng số {{ $users->total() }} người dùng
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        {{ $users->links('pagination::bootstrap-4') }}
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
    .table td {
        vertical-align: middle;
    }
    .pagination {
        margin-bottom: 0;
    }
    .page-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
    }
</style>

<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            paging: false, // Tắt phân trang của DataTables
            searching: true,
            info: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/vi.json'
            },
            columnDefs: [
                { orderable: false, targets: [5] } // Không sắp xếp cột Quản lý
            ]
        });
    });
</script>
@endsection