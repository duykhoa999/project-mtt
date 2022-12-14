@extends('user.layouts.master')
@section('content')
<!-- *********************** Start Banner ***************** -->
<div class="banner" style="background: white;">
    <div class="house owl-carousel owl-theme container" id="banner-slider">
        <div class="item">
            <img src="{{URL::to('frontend/img/banner_1.jpg')}}" alt="">
            <!-- <div class="item-content">
                <span>Giảm giá mùa hè!</span>
                <h2 style="color: white;">Máy Chạy Bộ Điện Đa Năng
                    <br style="color: white;"> Phong Cách Đơn Giản
                </h2>
                <p style="color: white;">Giảm Giá Lớn</p>
                <h3 style="color: white;">Sale 30% Off</h3>
                <button class="shopnow"> <a style="color: white; text-decoration: none;" href="{{URL::to('/chi-tiet-san-pham/31')}}">Mua Ngay</a></button>
            </div> -->
        </div>
        <div class="item">
            <img src="{{URL::to('frontend/img/banner_2.jpg')}}" alt="">
            <!-- <div class="item-content">
                <span style="color: white;">Đừng Bỏ Lỡ!</span>
                <h2 style="color: white;">Ghế Tập Bụng Đa Năng
                </h2>
                <p style="color: white;">Thiết Bị Tập Gym</p>
                <h3 style="color: white;">Giá chỉ 1,450,000</h3>
                <button class="shopnow"> <a style="color: white; text-decoration: none;" href="{{URL::to('/chi-tiet-san-pham/42')}}">Mua Ngay</a></button>
            </div> -->
        </div>
        <div class="item">
            <img src="{{URL::to('frontend/img/banner_3.jpg')}}" alt="">
            <!-- <div class="item-content">
                <span style="color: white;">Áo Ngắn Tay Nam</span>
                <h2 style="color: white;">Kiểu dáng thời trang
                    <br style="color: white;"> Đẳng cấp 4 mùa
                </h2>
                <p style="color: white;">Sản phẩm mới</p>
                <h3 style="color: white;">Giảm giá 15%</h3>
                <button class="shopnow"> <a style="color: white; text-decoration: none;" href="{{URL::to('/chi-tiet-san-pham/45')}}">Mua Ngay</a></button>
            </div> -->
        </div>
    </div>
</div>
<!-- *********************** End Banner ***************** -->
<section id="cart_items">
    <div class="container">

        <div class="review-payment">
            <h2>Cảm ơn bạn đã đặt hàng ở chỗ chúng tôi,chúng tôi sẽ liên hệ với bạn sớm nhất</h2>
        </div>



    </div>
</section>
<!--/#cart_items-->
@endsection
