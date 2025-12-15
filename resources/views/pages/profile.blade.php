@extends('layout')

@section('content')
    <div class="row container" id="wrapper">
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section>
                <div class="section-bar clearfix">
                    <h1 class="section-title"><span>Thông Tin Cá Nhân</span></h1>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> Vui lòng kiểm tra lại thông tin nhập
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="profile-container">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data"
                        id="profileForm">
                        @csrf
                        <div class="row">
                            <!-- Avatar Section -->
                            <div class="col-md-4">
                                <div class="profile-sidebar text-center">
                                    <div class="avatar-section">
                                        <input type="hidden" name="selected_avatar" id="selectedAvatar">

                                        <div class="avatar-wrapper" id="avatarWrapper">
                                            <div class="avatar-placeholder" id="avatarPlaceholder">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            @if ($user->avatar && $user->avatar !== 'NULL')
                                                <img src="{{ asset('images/avatars/' . $user->avatar) }}" alt="Avatar"
                                                    class="avatar-img" id="avatarImage"
                                                    onerror="this.style.display='none'; document.getElementById('avatarPlaceholder').style.display='flex';">
                                            @else
                                                <img src="" alt="Avatar" class="avatar-img" id="avatarImage"
                                                    style="display: none;">
                                            @endif

                                            <div class="avatar-overlay">
                                                <i class="fas fa-camera"></i>
                                                <span>Nhấp để đổi ảnh</span>
                                            </div>
                                            <input type="file" name="avatar" id="avatarInput" accept="image/*"
                                                class="avatar-file-input">
                                        </div>

                                        <div class="avatar-preview mt-2">
                                            <small id="fileName" class="text-muted">
                                                @if ($user->avatar && $user->avatar !== 'NULL')
                                                    Ảnh hiện tại
                                                @else
                                                    Chưa có ảnh đại diện
                                                @endif
                                            </small>
                                        </div>

                                        <div class="avatar-options mt-3">
                                            <p class="text-muted mb-2">Hoặc chọn avatar mặc định:</p>
                                            <div class="default-avatars">
                                                <div class="avatar-option" data-avatar="casau.png">
                                                    <img src="{{ asset('images/avatars/casau.png') }}" alt="Cá Sấu"
                                                        title="Cá Sấu">
                                                </div>
                                                <div class="avatar-option" data-avatar="gautruc.png">
                                                    <img src="{{ asset('images/avatars/gautruc.png') }}" alt="Gấu Trúc"
                                                        title="Gấu Trúc">
                                                </div>
                                                <div class="avatar-option" data-avatar="cabypara.png">
                                                    <img src="{{ asset('images/avatars/cabypara.png') }}" alt="Capybara"
                                                        title="Capypara">
                                                </div>
                                                <div class="avatar-option" data-avatar="dragon.png">
                                                    <img src="{{ asset('images/avatars/dragon.png') }}" alt="Rồng Con"
                                                        title="Rồng Con">
                                                </div>
                                                <div class="avatar-option" data-avatar="snake.png">
                                                    <img src="{{ asset('images/avatars/snake.png') }}" alt="Rắn Con"
                                                        title="Rắn Con">
                                                </div>
                                                <div class="avatar-option" data-avatar="cho.png">
                                                    <img src="{{ asset('images/avatars/cho.png') }}" alt="Chó Con"
                                                        title="Chó Con">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="user-name">{{ $user->name }}</h3>
                                    <p class="user-email">{{ $user->email }}</p>
                                    <div class="member-since">
                                        <small class="text-muted">
                                            <i class="far fa-calendar-alt"></i> Thành viên từ
                                            {{ $user->created_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Section -->
                            <div class="col-md-8">
                                <div class="profile-content" style="color: #333; background: white;">
                                    <!-- THÔNG TIN CÁ NHÂN (HIỂN THỊ BAN ĐẦU) -->
                                    <div class="card profile-card mb-4" id="profileInfoSection">
                                        <div class="card-header" style="background: #f8f9fa; color: #333;">
                                            <h3><i class="fas fa-id-card"></i> Thông Tin Tài Khoản</h3>
                                        </div>
                                        <div class="card-body" style="color: #333;">
                                            <!-- Thông tin cơ bản -->
                                            <div class="user-info-basic mb-4">
                                                <div class="info-row">
                                                    <label style="color: #495057;"><strong><i class="fas fa-user"></i> Họ
                                                            và tên:</strong></label>
                                                    <span style="color: #333;">{{ $user->name }}</span>
                                                </div>
                                                <div class="info-row">
                                                    <label style="color: #495057;"><strong><i class="fas fa-envelope"></i>
                                                            Email:</strong></label>
                                                    <span style="color: #333;">{{ $user->email }}</span>
                                                    <small class="text-muted d-block"
                                                        style="color: #6c757d !important;">Email không thể thay đổi</small>
                                                </div>
                                                <div class="info-row">
                                                    <label style="color: #495057;"><strong><i class="fas fa-crown"></i>
                                                            Trạng thái:</strong></label>
                                                    @if ($user->is_vip && $user->vip_expired_at && \Carbon\Carbon::parse($user->vip_expired_at) > now())
                                                        @php
                                                            $expiryDate = \Carbon\Carbon::parse($user->vip_expired_at);
                                                            $now = \Carbon\Carbon::now();
                                                            $remainingDays = $now->diffInDays($expiryDate, false);
                                                        @endphp
                                                        <span class="badge badge-vip">
                                                            <i class="fas fa-crown"></i> VIP
                                                            <small class="ml-1">(Hết hạn:
                                                                {{ $expiryDate->format('d/m/Y') }})</small>
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">
                                                            <i class="fas fa-user"></i> Thường
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Form cập nhật thông tin -->
                                            <div class="form-group">
                                                <label for="name" style="color: #333;"><strong>Thay đổi tên hiển
                                                        thị:</strong></label>
                                                <input type="text" name="name"
                                                    value="{{ old('name', $user->name) }}"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    style="color: #333;">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="action-buttons mt-4">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-save"></i> Cập nhật thông tin
                                                </button>

                                                <button type="button" class="btn btn-primary" id="btnShowUpgrade">
                                                    <i class="fas fa-crown"></i> Nâng cấp VIP
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    
                                                                        </form>
                                                                        <!-- PHẦN NÂNG CẤP VIP (ẨN BAN ĐẦU) -->
                                    <div class="vip-upgrade-section d-none" id="vipUpgradeSection">
                                        <div class="card mb-4">
                                            <div class="card-header bg-primary text-white">
                                                <h3 class="mb-0"><i class="fas fa-gem"></i> Nâng Cấp VIP</h3>
                                            </div>
                                            <div class="card-body" style="color: #333;">
                                                <!-- Quay lại -->
                                                <div class="mb-4">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm"
                                                        id="btnBackToProfile">
                                                        <i class="fas fa-arrow-left"></i> Quay lại thông tin cá nhân
                                                    </button>
                                                </div>

                                                <!-- Lợi ích VIP -->
                                                <div class="benefits-section mb-4 p-4 bg-light rounded">
                                                    <h4 class="text-center mb-3" style="color: #333;">Quyền lợi VIP</h4>
                                                    <div class="row">
                                                        <div class="col-md-3 text-center mb-3">
                                                            <div class="benefit-icon">
                                                                <i class="fas fa-ban fa-2x text-danger"></i>
                                                            </div>
                                                            <h5 class="mt-2" style="color: #333;">Không quảng cáo</h5>
                                                            <p class="text-muted small">Xem phim không gián đoạn</p>
                                                        </div>
                                                        <div class="col-md-3 text-center mb-3">
                                                            <div class="benefit-icon">
                                                                <i class="fas fa-hd fa-2x text-primary"></i>
                                                            </div>
                                                            <h5 class="mt-2" style="color: #333;">Chất lượng cao</h5>
                                                            <p class="text-muted small">Full HD, 4K</p>
                                                        </div>
                                                        <div class="col-md-3 text-center mb-3">
                                                            <div class="benefit-icon">
                                                                <i class="fas fa-bolt fa-2x text-warning"></i>
                                                            </div>
                                                            <h5 class="mt-2" style="color: #333;">Tốc độ nhanh</h5>
                                                            <p class="text-muted small">Tải và xem không giật lag</p>
                                                        </div>
                                                        <div class="col-md-3 text-center mb-3">
                                                            <div class="benefit-icon">
                                                                <i class="fas fa-headset fa-2x text-success"></i>
                                                            </div>
                                                            <h5 class="mt-2" style="color: #333;">Hỗ trợ ưu tiên</h5>
                                                            <p class="text-muted small">Được hỗ trợ nhanh nhất</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Danh sách gói VIP -->
                                                <div class="packages-section">
                                                    <h4 class="text-center mb-4" style="color: #333;">Chọn gói VIP phù hợp
                                                    </h4>

                                                    <div class="row mb-4">
                                                        <!-- Gói 1 tuần -->
                                                        <div class="col-md-6 mb-4">
                                                            <div class="package-card h-100">
                                                                <div class="package-header">
                                                                    <h5 style="color: #333;">Gói 1 Tuần</h5>
                                                                    <div class="package-price">
                                                                        <span class="price"
                                                                            style="color: #007bff !important;">20.000₫</span>
                                                                    </div>
                                                                </div>
                                                                <div class="package-body d-flex flex-column">
                                                                    <div class="package-duration">
                                                                        <i class="far fa-calendar"></i> 7 ngày
                                                                    </div>
                                                                    <ul class="package-features mb-3">
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i>
                                                                            Không quảng cáo</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Chất
                                                                            lượng HD</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Xem
                                                                            mọi nội dung</li>
                                                                    </ul>
                                                                    <div class="mt-auto">
                                                                        <form action="/vnpay_payment" method="POST">                                                                            
                                                                            @csrf
                                                                            <input type="hidden" name="amount"
                                                                                value="20000">
                                                                            <button type="submit"
                                                                                class="btn btn-outline-primary btn-block"
                                                                                >
                                                                                <i class="fas fa-shopping-cart"></i> Chọn
                                                                                gói
                                                                            </button>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Gói 1 tháng -->
                                                        <div class="col-md-6 mb-4">
                                                            <div class="package-card popular h-100">
                                                                <div class="popular-badge">Phổ biến</div>
                                                                <div class="package-header">
                                                                    <h5 style="color: #333;">Gói 1 Tháng</h5>
                                                                    <div class="package-price">
                                                                        <span class="price"
                                                                            style="color: #007bff !important;">70.000₫</span>
                                                                        <div class="saving-info">
                                                                            <small class="text-success">
                                                                                <i class="fas fa-piggy-bank"></i> Tiết kiệm
                                                                                10.000₫
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="package-body d-flex flex-column">
                                                                    <div class="package-duration">
                                                                        <i class="far fa-calendar"></i> 30 ngày
                                                                    </div>
                                                                    <ul class="package-features mb-3">
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i>
                                                                            Không quảng cáo</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Chất
                                                                            lượng Full HD</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Ưu
                                                                            tiên tốc độ</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Xem
                                                                            không giới hạn</li>
                                                                    </ul>
                                                                    <div class="mt-auto">
                                                                        <form action="/vnpay_payment" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="amount"
                                                                                value="70000">
                                                                            <button type="submit"
                                                                                class="btn btn-primary btn-block"
                                                                                style="border:#007bff 1px solid !important;margin-top: 40px !important; color: #007bff !important;">
                                                                                <i class="fas fa-crown"></i> Chọn gói
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <!-- Gói 3 tháng -->
                                                        <div class="col-md-6 mb-4">
                                                            <div class="package-card h-100">
                                                                <div class="package-header">
                                                                    <h5 style="color: #333;">Gói 3 Tháng</h5>
                                                                    <div class="package-price">
                                                                        <span class="price"
                                                                            style="color: #007bff !important;">150.000₫</span>
                                                                        <div class="saving-info">
                                                                            <small class="text-success">
                                                                                <i class="fas fa-piggy-bank"></i> Tiết kiệm
                                                                                60.000₫
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="package-body d-flex flex-column">
                                                                    <div class="package-duration">
                                                                        <i class="far fa-calendar"></i> 90 ngày
                                                                    </div>
                                                                    <ul class="package-features mb-3">
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i>
                                                                            Không quảng cáo</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Chất
                                                                            lượng Full HD</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Ưu
                                                                            tiên tốc độ</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Tải
                                                                            xuống được</li>
                                                                    </ul>
                                                                    <div class="mt-auto">
                                                                        <form action="/vnpay_payment" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="amount"
                                                                                value="150000">
                                                                            <button type="submit"
                                                                                class="btn btn-outline-primary btn-block">
                                                                                <i class="fas fa-star"></i> Chọn gói
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Gói 6 tháng -->
                                                        <div class="col-md-6 mb-4">
                                                            <div class="package-card h-100">
                                                                <div class="package-header">
                                                                    <h5 style="color: #333;">Gói 6 Tháng</h5>
                                                                    <div class="package-price">
                                                                        <span class="price"
                                                                            style="color: #007bff !important;">400.000₫</span>
                                                                        <div class="saving-info">
                                                                            <small class="text-success">
                                                                                <i class="fas fa-piggy-bank"></i> Tiết kiệm
                                                                                80.000₫
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="package-body d-flex flex-column">
                                                                    <div class="package-duration">
                                                                        <i class="far fa-calendar"></i> 180 ngày
                                                                    </div>
                                                                    <ul class="package-features mb-3">
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i>
                                                                            Không quảng cáo</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Chất
                                                                            lượng 4K</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Ưu
                                                                            tiên tốc độ</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Tải
                                                                            xuống không giới hạn</li>
                                                                        <li style="color: #333;"><i
                                                                                class="fas fa-check text-success"></i> Hỗ
                                                                            trợ VIP 24/7</li>
                                                                    </ul>
                                                                    <div class="mt-auto">
                                                                        <form action="/vnpay_payment" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="amount"
                                                                                value="400000">
                                                                            <button type="submit"
                                                                                class="btn btn-outline-primary btn-block">
                                                                                <i class="fas fa-gem"></i> Chọn gói
                                                                            </button>
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
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        @include('pages.include.sidebar')
    </div>
@endsection

<style>
    /* Avatar Section Styles */
    .avatar-section {
        margin-bottom: 20px;
    }

    .avatar-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto 10px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.3);
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.1);
    }

    .avatar-wrapper:hover {
        border-color: rgba(255, 255, 255, 0.6);
        transform: scale(1.05);
    }

    .avatar-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .avatar-placeholder i {
        font-size: 3rem;
        opacity: 0.8;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        display: none;
    }

    .avatar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 50%;
        color: white;
        text-align: center;
        padding: 10px;
    }

    .avatar-wrapper:hover .avatar-overlay {
        opacity: 1;
    }

    .avatar-overlay i {
        font-size: 1.5rem;
        margin-bottom: 5px;
        color: #ffa500;
    }

    .avatar-overlay span {
        font-size: 0.8rem;
        font-weight: 500;
    }

    .avatar-file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .avatar-preview {
        min-height: 20px;
    }

    /* Default Avatars */
    .avatar-options {
        text-align: center;
    }

    .default-avatars {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        justify-content: center;
        max-width: 200px;
        margin: 0 auto;
    }

    .avatar-option {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .avatar-option:hover {
        border-color: #ffa500;
        transform: scale(1.1);
    }

    .avatar-option.active {
        border-color: #ffa500;
        box-shadow: 0 0 12px rgba(255, 165, 0, 0.6);
    }

    .avatar-option img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .avatar-option:hover img {
        transform: scale(1.1);
    }

    /* Profile basic info */
    .user-info-basic {
        padding: 15px;
        background: #f8f9fa !important;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .info-row {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #dee2e6;
    }

    .info-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .info-row label {
        min-width: 120px;
        margin-bottom: 0;
        color: #495057 !important;
    }

    .info-row label i {
        width: 20px;
        margin-right: 8px;
    }

    .badge-vip {
        background: linear-gradient(135deg, #ffd700, #ff9900) !important;
        color: #000 !important;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
    }

    .badge-vip i {
        margin-right: 5px;
    }

    .badge-secondary {
        background: #6c757d !important;
        color: white !important;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
    }

    /* Action buttons */
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #dee2e6;
    }

    .action-buttons .btn {
        flex: 1;
        padding: 10px 20px;
        font-weight: 500;
    }

    .action-buttons .btn-warning {
        background: linear-gradient(135deg, #ffc107, #e0a800) !important;
        border: none !important;
        color: #212529 !important;
    }

    .action-buttons .btn-warning:hover {
        background: linear-gradient(135deg, #e0a800, #d39e00) !important;
        color: #212529 !important;
    }

    .action-buttons .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
        border: none !important;
        color: white !important;
    }

    .action-buttons .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #004085) !important;
        color: white !important;
    }

    /* VIP Upgrade Section */
    .vip-upgrade-section .card-header {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
    }

    .benefits-section {
        background: #f8f9fa !important;
    }

    .benefit-icon {
        width: 60px;
        height: 60px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Package Cards for 2x2 layout */
    .package-card {
        background: white !important;
        border: 2px solid #dee2e6 !important;
        border-radius: 12px;
        padding: 25px;
        height: 450px;
        position: relative;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .package-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        border-color: #007bff !important;
    }

    .package-card.popular {
        border-color: #007bff !important;
        background: linear-gradient(135deg, #f8f9ff, #e9ecef) !important;
        position: relative;
        overflow: hidden;
    }

    .package-card.popular::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #007bff, #0056b3);
    }

    .popular-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #007bff !important;
        color: white !important;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        z-index: 1;
        box-shadow: 0 3px 8px rgba(0, 123, 255, 0.3);
    }

    .package-header {
        text-align: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .package-header h5 {
        color: #333 !important;
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 1.25rem;
    }

    .package-price {
        margin-top: 10px;
    }

    .package-price .price {
        font-size: 28px;
        font-weight: 800;
        color: #007bff !important;
        display: block;
        margin-bottom: 5px;
    }

    .saving-info {
        margin-top: 5px;
    }

    .saving-info small {
        font-size: 0.85rem;
        font-weight: 500;
    }

    .package-duration {
        text-align: center;
        background: rgba(0, 123, 255, 0.1) !important;
        padding: 8px 15px;
        border-radius: 20px;
        color: #007bff !important;
        font-weight: 600;
        margin-bottom: 20px;
        display: inline-block;
        align-self: center;
    }

    .package-features {
        list-style: none;
        padding: 0;
        margin: 0 0 20px 0;
        flex-grow: 1;
    }

    .package-features li {
        margin-bottom: 10px;
        padding-left: 28px;
        position: relative;
        color: #333 !important;
        font-size: 0.95rem;
        line-height: 1.4;
    }

    .package-features li i {
        position: absolute;
        left: 0;
        top: 3px;
        font-size: 0.9rem;
    }

    .package-body {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .package-body form .btn {
        padding: 12px;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-outline-primary {
        color: #007bff !important;
        border: 2px solid #007bff !important;
        background: transparent !important;
    }

    .btn-outline-primary:hover {
        color: white !important;
        background: #007bff !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
        color: white !important;
        border: none !important;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #004085) !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }

    /* Đảm bảo VIP section ẩn ban đầu */
    .vip-upgrade-section.d-none {
        display: none !important;
    }

    /* Đảm bảo profile info hiển thị ban đầu */
    #profileInfoSection {
        display: block !important;
    }

    /* Responsive cho layout 2x2 */
    @media (max-width: 992px) {
        .package-card {
            padding: 20px;
        }

        .package-header h5 {
            font-size: 1.1rem;
        }

        .package-price .price {
            font-size: 24px;
        }
    }

    @media (max-width: 768px) {
        .packages-section .row {
            margin: 0 -10px;
        }

        .packages-section .col-md-6 {
            padding: 0 10px;
        }

        .package-card {
            padding: 18px;
            margin-bottom: 20px;
        }

        .popular-badge {
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            font-size: 11px;
        }
    }

    /* Payment info */
    .payment-info {
        border: 1px solid #dee2e6 !important;
        background: #f8f9fa !important;
    }

    /* Existing styles */
    .btn-primary {
        background: linear-gradient(135deg, #ffa500, #ff8c00);
        border: none;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #ff8c00, #ff7f00);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(255, 165, 0, 0.3);
    }

    .user-name {
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 1.4rem;
        color: white;
        margin-top: 20px;
    }

    .user-email {
        opacity: 0.9;
        margin-bottom: 10px;
        color: white;
    }

    .member-since {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .member-since small {
        color: rgba(255, 255, 255, 0.8) !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .profile-container {
        background: rgba(32, 68, 108, 0.5);
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .profile-sidebar {
        background: linear-gradient(135deg, #525c88 0%, #213391 100%);
        color: white;
        padding: 30px 20px;
        border-radius: 12px 0 0 12px;
        height: 100%;
    }

    /* FIX COLOR ISSUES */
    .profile-content {
        padding: 20px;
        color: #333 !important;
        background: white !important;
        border-radius: 0 12px 12px 0;
    }

    .profile-content .card {
        color: #333 !important;
        background: white !important;
    }

    .profile-content .card-header {
        background: #f8f9fa !important;
        color: #333 !important;
        border-bottom: 1px solid #dee2e6;
    }

    .profile-content .card-body {
        color: #333 !important;
        background: white !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .default-avatars {
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            max-width: 180px;
        }

        .avatar-option {
            width: 50px;
            height: 50px;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .info-row label {
            margin-bottom: 5px;
            min-width: auto;
        }

        .action-buttons {
            flex-direction: column;
        }

        .benefits-section .row {
            margin: 0 -5px;
        }

        .benefits-section .col-md-3 {
            padding: 0 5px;
            margin-bottom: 15px;
        }

        .profile-content {
            border-radius: 0 0 12px 12px;
        }

        .profile-sidebar {
            border-radius: 12px 12px 0 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Đảm bảo VIP section ẩn khi trang load
        const vipUpgradeSection = document.getElementById('vipUpgradeSection');
        const profileInfoSection = document.getElementById('profileInfoSection');

        if (vipUpgradeSection) {
            vipUpgradeSection.classList.add('d-none');
            vipUpgradeSection.style.display = 'none';
        }

        if (profileInfoSection) {
            profileInfoSection.style.display = 'block';
        }

        // Avatar handling
        const avatarWrapper = document.getElementById('avatarWrapper');
        const avatarPlaceholder = document.getElementById('avatarPlaceholder');
        const avatarImage = document.getElementById('avatarImage');
        const avatarInput = document.getElementById('avatarInput');
        const selectedAvatarInput = document.getElementById('selectedAvatar');
        const avatarOptions = document.querySelectorAll('.avatar-option');
        const fileName = document.getElementById('fileName');

        // Handle click on avatar wrapper
        if (avatarWrapper) {
            avatarWrapper.addEventListener('click', function(e) {
                if (e.target !== avatarInput) {
                    avatarInput.click();
                }
            });
        }

        // Handle file selection
        if (avatarInput) {
            avatarInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const file = e.target.files[0];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        avatarImage.src = e.target.result;
                        avatarImage.style.display = 'block';
                        avatarPlaceholder.style.display = 'none';
                        selectedAvatarInput.value = ''; // Clear selected avatar

                        // Show file name
                        fileName.textContent = 'Đã chọn: ' + file.name;

                        // Remove active class from all avatar options
                        avatarOptions.forEach(opt => opt.classList.remove('active'));
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        // Handle default avatar selection
        avatarOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remove active class from all options
                avatarOptions.forEach(opt => opt.classList.remove('active'));

                // Add active class to clicked option
                this.classList.add('active');

                // Set the selected avatar
                const avatarSrc = this.getAttribute('data-avatar');
                const avatarName = this.querySelector('img').alt;
                selectedAvatarInput.value = avatarSrc;

                // Update preview
                avatarImage.src = "{{ asset('images/avatars/') }}/" + avatarSrc;
                avatarImage.style.display = 'block';
                avatarPlaceholder.style.display = 'none';

                // Clear file input
                avatarInput.value = '';
                fileName.textContent = 'Đã chọn: ' + avatarName;
            });
        });

        // Check if user already has an avatar on page load
        @if ($user->avatar && $user->avatar !== 'NULL')
            avatarImage.src = "{{ asset('images/avatars/' . $user->avatar) }}";
            avatarImage.style.display = 'block';
            avatarPlaceholder.style.display = 'none';
            fileName.textContent = 'Ảnh hiện tại';

            // Active the current avatar option if it's a default one
            const currentAvatar = "{{ $user->avatar }}";
            avatarOptions.forEach(option => {
                if (option.getAttribute('data-avatar') === currentAvatar) {
                    option.classList.add('active');
                    selectedAvatarInput.value = currentAvatar;
                }
            });
        @endif

        // VIP Upgrade handling
        const btnShowUpgrade = document.getElementById('btnShowUpgrade');
        const btnBackToProfile = document.getElementById('btnBackToProfile');

        // Hiển thị phần nâng cấp VIP
        if (btnShowUpgrade) {
            btnShowUpgrade.addEventListener('click', function() {
                console.log('Nút nâng cấp được bấm');
                // Ẩn thông tin cá nhân
                profileInfoSection.style.display = 'none';

                // Hiển thị phần nâng cấp VIP
                vipUpgradeSection.classList.remove('d-none');
                vipUpgradeSection.style.display = 'block';

                // Scroll lên đầu
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Quay lại thông tin cá nhân
        if (btnBackToProfile) {
            btnBackToProfile.addEventListener('click', function() {
                console.log('Nút quay lại được bấm');
                // Hiển thị thông tin cá nhân
                profileInfoSection.style.display = 'block';

                // Ẩn phần nâng cấp VIP
                vipUpgradeSection.classList.add('d-none');
                vipUpgradeSection.style.display = 'none';

                // Scroll lên đầu
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // DEBUG: Kiểm tra tất cả form
        console.log('=== DEBUG FORM COUNT ===');

        // Đếm tất cả form trong toàn bộ page
        const allFormsInPage = document.querySelectorAll('form');
        console.log('Tất cả form trong page:', allFormsInPage.length);

        // Đếm form thanh toán
        const paymentForms = document.querySelectorAll('form[action="/vnpay_payment"]');
        console.log('Form thanh toán:', paymentForms.length);

        // Liệt kê từng form
        paymentForms.forEach((form, index) => {
            const amount = form.querySelector('input[name="amount"]');
            console.log(`Form ${index + 1}: amount = ${amount ? amount.value : 'không tìm thấy'}`);
        });

        console.log('=== END DEBUG ===');
        // Kiểm tra tất cả các form
        const allForms = document.querySelectorAll('form[action="/vnpay_payment"]');
        console.log('Tổng số form thanh toán:', allForms.length);

        allForms.forEach((form, index) => {
            form.addEventListener('submit', function() {
                console.log('Form ' + (index + 1) + ' submitted');
            });
        });
        
    });
</script>
