<!------ File: register.blade.php ------>
@extends('layouts.layout_login')

@section('content_login')
<div id="logreg-forms">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Đăng ký tài khoản</h1>
        
        <div class="social-login">
            <button class="btn facebook-btn social-btn" type="button" onclick="window.location.href='{{ route('login-by-facebook') }}'">
                <span><i class="fab fa-facebook-f"></i> Đăng ký với Facebook</span>
            </button>
            <button class="btn google-btn social-btn" type="button" onclick="window.location.href='{{ route('login-by-google') }}'">
                <span><i class="fab fa-google-plus-g"></i> Đăng ký với Google</span>
            </button>
        </div>
        
        <p style="text-align:center"> HOẶC </p>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Họ tên') }}</label>
            <div class="col-md-8">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nhập họ tên của bạn">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
            <div class="col-md-8">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Nhập email của bạn">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mật khẩu') }}</label>
            <div class="col-md-8">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Nhập mật khẩu">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Xác nhận mật khẩu') }}</label>
            <div class="col-md-8">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Nhập lại mật khẩu">
            </div>
        </div>

        <button class="btn btn-register btn-block" type="submit">
            <i class="fas fa-user-plus"></i> {{ __('ĐĂNG KÝ') }}
        </button>
        
        <a href="{{ route('login') }}" id="back_login" style="display: block; text-align: center; margin-top: 15px;">
            <i class="fas fa-arrow-left"></i> Quay lại đăng nhập
        </a>
        
        <hr>
    </form>
</div>

<style>
    /* CSS cho trang đăng ký */
    body{
        background:url('https://wallpaper.dog/large/20493433.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    #logreg-forms{
        width:450px;
        margin:10vh auto;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        border-radius: 15px;
        overflow: hidden;
        border: 2px solid #44e2ff;
        backdrop-filter: blur(10px);
    }
    
    #logreg-forms form {
        width: 100%;
        max-width: 410px;
        padding: 30px;
        margin: auto;
    }
    
    #logreg-forms h1 {
        color: #234556;
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 25px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
    }
    
    #logreg-forms h1:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, #44e2ff, #234556);
        border-radius: 2px;
    }
    
    #logreg-forms .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 12px 15px;
        font-size: 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 15px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }
    
    #logreg-forms .form-control:focus { 
        z-index: 2; 
        border-color: #44e2ff;
        box-shadow: 0 0 0 3px rgba(68, 226, 255, 0.1);
        background: white;
    }
    
    /* Social login */
    #logreg-forms .social-login{
        width: 100%;
        margin: 0 auto 20px auto;
    }
    
    #logreg-forms .social-btn{
        font-weight: 600;
        color: white;
        width: 100%;
        font-size: 14px;
        border: none;
        border-radius: 25px;
        padding: 12px 20px;
        margin: 8px 0;
        transition: all 0.3s ease;
    }
    
    #logreg-forms .social-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    #logreg-forms .facebook-btn{ 
        background: linear-gradient(135deg, #3C589C, #4a6cbe);
    }
    
    #logreg-forms .google-btn{ 
        background: linear-gradient(135deg, #DF4B3B, #e57368);
    }
    
    /* Separator */
    #logreg-forms p {
        text-align: center;
        margin: 20px 0;
        color: #666;
        font-weight: 500;
        position: relative;
    }
    
    #logreg-forms p:before,
    #logreg-forms p:after {
        content: '';
        position: absolute;
        top: 50%;
        width: 35%;
        height: 1px;
        background: #ddd;
    }
    
    #logreg-forms p:before {
        left: 0;
    }
    
    #logreg-forms p:after {
        right: 0;
    }
    
    /* Form styling */
    .row.mb-3 {
        margin-bottom: 20px !important;
    }
    
    .col-form-label {
        color: #234556;
        font-weight: 600;
        font-size: 14px;
        padding-top: 12px;
    }
    
    /* Nút đăng ký */
    .btn-register {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 16px;
        margin: 20px 0 15px;
        width: 100%;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
    }
    
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
        background: linear-gradient(135deg, #20c997 0%, #28a745 100%);
        color: white;
    }
    
    .btn-register:active {
        transform: scale(0.98);
    }
    
    .btn-register i {
        margin-right: 8px;
    }
    
    /* Link quay lại */
    #back_login {
        color: #666;
        text-decoration: none;
        transition: color 0.3s ease;
        font-size: 14px;
    }
    
    #back_login:hover {
        color: #44e2ff;
        text-decoration: underline;
    }
    
    #back_login i {
        margin-right: 5px;
    }
    
    /* Error messages */
    .invalid-feedback {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: #dc3545;
        font-weight: 500;
    }
    
    .is-invalid {
        border-color: #dc3545 !important;
    }
    
    hr {
        border: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #44e2ff, transparent);
        margin: 20px 0;
    }
    
    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    #logreg-forms {
        animation: fadeIn 0.6s ease-out;
    }

    /* Mobile Responsive */
    @media screen and (max-width:500px){
        #logreg-forms{
            width: 90%;
            margin: 5vh auto;
        }
        
        #logreg-forms form {
            padding: 20px;
        }
        
        .col-form-label {
            text-align: left !important;
            margin-bottom: 5px;
        }
        
        .col-md-4, .col-md-8 {
            padding: 0 5px;
        }
    }
</style>
@endsection