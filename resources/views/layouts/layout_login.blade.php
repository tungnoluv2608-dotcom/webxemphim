<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
    <title>Đăng nhập webphim</title>
    <style>
    body{
        background:url('https://wallpaper.dog/large/20493433.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* sign in FORM */
    #logreg-forms{
        width:412px;
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
        width: 60px;
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
    
    /* Social login styles */
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
        position: relative;
        overflow: hidden;
    }
    
    #logreg-forms .social-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    #logreg-forms .social-btn:active {
        transform: translateY(0);
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
    
    /* Form rows and labels */
    .row.mb-3 {
        margin-bottom: 20px !important;
    }
    
    .col-form-label {
        color: #234556;
        font-weight: 600;
        font-size: 14px;
    }
    
    /* Remember me checkbox */
    .form-check-input {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        border: 2px solid #ccc;
    }
    
    .form-check-input:checked {
        background-color: #44e2ff;
        border-color: #44e2ff;
    }
    
    .form-check-label {
        color: #555;
        font-weight: 500;
        font-size: 14px;
    }
    
    /* Login button */
    .btn-success {
        background: linear-gradient(135deg, #234556 0%, #44e2ff 100%);
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
    }
    
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(35, 69, 86, 0.3);
        background: linear-gradient(135deg, #44e2ff 0%, #234556 100%);
    }
    
    .btn-success:active {
        transform: scale(0.98);
    }
    
    /* Forgot password link */
    #forgot_pswd {
        display: block;
        text-align: center;
        color: #666;
        text-decoration: none;
        margin: 15px 0;
        transition: color 0.3s ease;
        font-size: 14px;
    }
    
    #forgot_pswd:hover {
        color: #44e2ff;
        text-decoration: underline;
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
        
        #logreg-forms .social-login{
            width: 100%;
        }
        
        #logreg-forms .social-btn{
            font-size: 14px;
            padding: 10px 15px;
        }
        
        .row.mb-3 {
            margin-bottom: 15px !important;
        }
        
        .col-md-4, .col-md-8 {
            padding: 0 5px;
        }
    }
    /* Nút đăng ký */
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 16px;
        margin: 10px 0;
        width: 100%;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        color: white;
    }
    
    .btn-primary:active {
        transform: scale(0.98);
    }
    
    .btn-primary i {
        margin-right: 8px;
    }
    
    /* Hoặc nếu muốn nút đăng ký cùng màu với theme */
    .btn-register {
        background: linear-gradient(135deg, #234556 0%, #44e2ff 100%);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 16px;
        margin: 10px 0;
        width: 100%;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
    }
    
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(35, 69, 86, 0.3);
        background: linear-gradient(135deg, #44e2ff 0%, #234556 100%);
        color: white;
    }
</style>
</head>
<body>
    @yield('content_login')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/script.js"></script>
</body>
</html>