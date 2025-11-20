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
                    <div class="row">
                        <!-- Avatar Section -->
                        <div class="col-md-4">
                            <div class="profile-sidebar text-center">
                                <div class="avatar-section">
                                    <form action="{{ route('user.profile.update') }}" method="POST"
                                        enctype="multipart/form-data" id="avatarForm">
                                        @csrf
                                        <input type="hidden" name="selected_avatar" id="selectedAvatar">

                                        <div class="avatar-wrapper" id="avatarWrapper">
                                            <div class="avatar-placeholder" id="avatarPlaceholder">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <!-- SỬA PHẦN HIỂN THỊ ẢNH -->
                                            @if ($user->avatar)
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
                                            <small id="fileName" class="text-muted">Chưa chọn ảnh</small>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block mt-3" id="updateAvatarBtn"
                                            style="display: none;">
                                            <i class="fas fa-upload"></i> Cập nhật ảnh đại diện
                                        </button>
                                    </form>

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
                            <div class="profile-content">
                                <div class="card profile-card">
                                    <div class="card-header">
                                        <h3><i class="fas fa-user-circle"></i> Thông Tin Tài Khoản</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('user.profile.update') }}" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"><strong>Họ và tên:</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name" value="{{ $user->name }}"
                                                        class="form-control @error('name') is-invalid @enderror">
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"><strong>Email:</strong></label>
                                                <div class="col-sm-9">
                                                    <p class="form-control-plaintext">{{ $user->email }}</p>
                                                    <small class="text-muted">Email không thể thay đổi</small>
                                                </div>
                                            </div>

                                            <!-- Package Information -->
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"><strong>Gói dịch
                                                        vụ:</strong></label>
                                                <div class="col-sm-9">
                                                    @if ($currentPackage)
                                                        <div class="package-info">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <span
                                                                    class="package-badge badge 
                                                                @if ($currentPackage->package->type == 'free') badge-info
                                                                @elseif($currentPackage->package->price > 100000) badge-premium
                                                                @else badge-success @endif">
                                                                    {{ $currentPackage->package->name }}
                                                                </span>
                                                                @if ($currentPackage->package->type != 'free')
                                                                    <span class="expiry-date ml-2">
                                                                        <i class="far fa-clock"></i>
                                                                        Hết hạn:
                                                                        {{ $currentPackage->end_date->format('d/m/Y') }}
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            {{-- Usage info for free package --}}
                                                            @if ($currentPackage->package->type == 'free' && $todayUsage)
                                                                <div class="usage-info mt-3">
                                                                    <div class="d-flex justify-content-between">
                                                                        <span class="usage-text">Lượt xem hôm nay</span>
                                                                        <span class="usage-count">
                                                                            {{ $todayUsage['used'] }}/{{ $todayUsage['limit'] }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="progress usage-progress">
                                                                        <div class="progress-bar 
                                                                        @if ($todayUsage['remaining'] == 0) bg-danger
                                                                        @elseif($todayUsage['remaining'] <= 1) bg-warning
                                                                        @else bg-success @endif"
                                                                            style="width: {{ min(($todayUsage['used'] / $todayUsage['limit']) * 100, 100) }}%">
                                                                        </div>
                                                                    </div>
                                                                    @if ($todayUsage['remaining'] == 0)
                                                                        <small class="text-danger">
                                                                            <i class="fas fa-exclamation-circle"></i>
                                                                            Bạn đã hết lượt xem hôm nay
                                                                        </small>
                                                                    @else
                                                                        <small class="text-muted">
                                                                            Còn lại {{ $todayUsage['remaining'] }} lượt xem
                                                                            hôm nay
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="no-package">
                                                            <span class="badge badge-secondary">Chưa đăng ký gói</span>
                                                            <p class="text-muted mt-1">Bạn chưa đăng ký gói dịch vụ nào</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="action-buttons mt-4 pt-3 border-top">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-save"></i> Cập nhật thông tin
                                                </button>
                                                <a href="{{ route('packages.index') }}" class="btn btn-primary">
                                                    <i class="fas fa-crown"></i> Nâng cấp gói dịch vụ
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Package Features -->
                                @if ($currentPackage)
                                    <div class="card features-card mt-4">
                                        <div class="card-header">
                                            <h3><i class="fas fa-star"></i> Quyền Lợi Của Bạn</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach (json_decode($currentPackage->package->features, true) as $feature)
                                                    <div class="col-md-6">
                                                        <div class="feature-item">
                                                            <i class="fas fa-check text-success"></i>
                                                            <span>{{ $feature }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="col-md-6">
                                                    <div class="feature-item">
                                                        <i class="fas fa-check text-success"></i>
                                                        <span>Chất lượng:
                                                            {{ $currentPackage->package->quality_text }}</span>
                                                    </div>
                                                </div>

                                                @if ($currentPackage->package->download_enabled)
                                                    <div class="col-md-6">
                                                        <div class="feature-item">
                                                            <i class="fas fa-check text-success"></i>
                                                            <span>Cho phép tải xuống</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
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

    .avatar-option::after {
        content: attr(title);
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.7rem;
        white-space: nowrap;
        opacity: 0;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .avatar-option:hover::after {
        opacity: 1;
        bottom: -30px;
    }

    /* Button Styles */
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

    /* Text Styles */
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
        color: rgba(255, 255, 255, 0.7) !important;
    }

    /* Rest of your existing styles */
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

    .profile-content {
        padding: 20px;
        color: white;
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
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarWrapper = document.getElementById('avatarWrapper');
        const avatarPlaceholder = document.getElementById('avatarPlaceholder');
        const avatarImage = document.getElementById('avatarImage');
        const avatarInput = document.getElementById('avatarInput');
        const selectedAvatarInput = document.getElementById('selectedAvatar');
        const avatarOptions = document.querySelectorAll('.avatar-option');
        const avatarForm = document.getElementById('avatarForm');
        const fileName = document.getElementById('fileName');
        const updateAvatarBtn = document.getElementById('updateAvatarBtn');

        // Handle click on avatar wrapper
        avatarWrapper.addEventListener('click', function(e) {
            if (e.target !== avatarInput) {
                avatarInput.click();
            }
        });

        // Handle file selection
        avatarInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const file = e.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    avatarImage.src = e.target.result;
                    avatarImage.style.display = 'block';
                    avatarPlaceholder.style.display = 'none';
                    selectedAvatarInput.value = ''; // Clear selected avatar

                    // Show file name and update button
                    fileName.textContent = file.name;
                    updateAvatarBtn.style.display = 'block';

                    // Remove active class from all avatar options
                    avatarOptions.forEach(opt => opt.classList.remove('active'));
                }
                reader.readAsDataURL(file);
            }
        });

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

                // Clear file input and show update button
                avatarInput.value = '';
                fileName.textContent = 'Avatar: ' + avatarName;
                updateAvatarBtn.style.display = 'block';
            });
        });

        // Auto-submit form when avatar is selected (optional)
        avatarForm.addEventListener('submit', function(e) {
            // Form will submit normally
        });

        document.addEventListener('DOMContentLoaded', function() {
            const avatarForm = document.getElementById('avatarForm');

            avatarForm.addEventListener('submit', function(e) {
                console.log('=== FORM SUBMIT DEBUG ===');
                console.log('Form submitted!');

                const formData = new FormData(avatarForm);
                console.log('FormData entries:');
                for (let [key, value] of formData.entries()) {
                    console.log(key + ': ' + value);
                }
                

                // Let form submit normally
            });

            // Debug file input change
            const avatarInput = document.getElementById('avatarInput');
            avatarInput.addEventListener('change', function(e) {
                console.log('File selected:', e.target.files[0]);
            });
        });
        // Check if user already has an avatar on page load
        @if ($user->avatar)
            avatarImage.style.display = 'block';
            avatarPlaceholder.style.display = 'none';
            fileName.textContent = 'Ảnh hiện tại';
        @endif
    });
</script>
