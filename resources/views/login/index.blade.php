<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('frontend/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/cart_detail.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/login.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="shortcut icon" href="dist/img/logodocument.png" type="image/png" />
    <style type="text/css">
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <section class="section-login">
        <!-- <div class="col-xs-2 col-sm-3 col-md-3 col-lg-4"></div> -->
        <div class="col-xs-8 col-sm-6 col-md-6 col-lg-4 form-background">
            <h3>Đăng nhập ngay!</h3>
            <div class="icon">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fab fa-google-plus-g"></i></a>
                <a href=""><i class="fab fa-linkedin-in"></i></a>
            </div>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<div class="text-alert" style="color:#006400;font-size: 1.5rem;
                        font-weight: 700;
                        text-align: center;">' . $message . '</div>';
                Session::put('message', null);
            }
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form">
                <div class="row">
                    <form action="{{route('postLogin')}}" name="login-form" id="login-form" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <label for="username">Tài Khoản :</label>
                                <input type="text" id="username" name="email" value="{{old('email')}}" placeholder="Email" class="form-control" />
                                @if ($errors->has('email'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <label for="password">Mật Khẩu :</label>
                                <input type="password" id="password" name="password" value="" placeholder="Password" class="form-control" />
                                @if ($errors->has('password'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <button type="submit" name="login" class="btn-login miss">Đăng
                                    nhập</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <a class="miss" href="">Quên Mật Khẩu ?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item center">
                                <h2>Chưa có tài khoản ?</h2>
                            </div>
                        </div>
                        <div class="form-group flex">
                            <div class="col-xs-6 col-md-6 col-lg-6 form-item center">
                                <a href="{{route('getRegister')}}" class="creat btn-login">Tạo Tài Khoản </a>
                            </div>
                            <div class="col-xs-6 col-md-6 col-lg-6 form-item center">
                                <a href="{{route('index')}}" class="creat btn-login">Trang Chủ </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('frontend/js/search.js')}}"></script>
<script src="{{asset('frontend/js/detail.js')}}"></script>

</html>