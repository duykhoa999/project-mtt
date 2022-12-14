<!-- *********************** Start Header ***************** -->
<header>
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-md-2 col-sm-6 col-6 header-logo">
                    <div class="logo">
                        <a href="{{route('index')}}" class="theme-logo">
                            <img src="{{URL::to('frontend/img/me_logo.png')}}" style="width:60%;height:60%" alt="Thương hiệu chất lượng">
                        </a>
                    </div>
                </div>
                <div class="col-xl-8 col-md-6 mainmenu active">
                    <div class="menu-besto-two">
                        <nav>
                            <div class="close-menu">
                                <a href=""><i class="fas fa-times"></i></a>
                            </div>
                            <!--// dùng để điểu hướng qua trang khác -->
                            <ul class="flex">
                                <li class="home"><a href="{{route('index')}}">Trang Chủ</a>
                                </li>
                                <li class="shop"><a href="">Danh mục <i class="fas fa-angle-down"></i></a>
                                    <ul class="dropdown-shop flex">
                                        @if (!empty($category))
                                            @foreach($category as $key => $cate)
                                                <li>
                                                    <span><a href="{{route('show-category', ['id' => $cate->ma_lr])}}">{{$cate->ten_lr}}</a></span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>

                                <li class="shop"><a href="">Thương Hiệu <i class="fas fa-angle-down"></i></a>
                                    <ul class="dropdown-shop flex">
                                        @if(isset($brand_pro))
                                            @foreach($brand_pro as $key => $brand)
                                                <li>
                                            <span><a href="{{route('show-brand', ['id' => $brand->ma_th])}}">{{$brand->ten_th}}</a></span>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </li>
                                <li class="home"><a href="">Blogs</a>
                                </li>
                                <li class="home"><a href="">Giới Thiệu</a>
                                </li>
                                <li class="home"><a href="">Liên hệ</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-6 header-linkicon">
                    <div class="right-blok-box d-flex">
                        <div class="search-wrap">
                            <button type="button" class="search-mobile-btn" data-toggle="modal" data-target="#myModal1"><i class="fas fa-search"></i></button>
                        </div>
                        <button type="button" class="navbar-toggler" for="shownav">
                            <i class="fas fa-bars"></i>
                        </button>
                        <?php
                        if (empty(Session::get('user'))) {
                        ?>
                            <div class="acount">
                                <a href="{{route('getLogin')}}" title="Đăng nhập"><i class="fas fa-user-circle"></i></a>
                            </div>
                        <?php
                        } else {
                            $user = Session::get('user');
                        ?>
                            <div class="acount acount-logout">
                                <a href=""><i class="fas fa-chalkboard-teacher"></i>
                                    <i style="padding-left: 0.1rem;" class="fas fa-angle-double-down"></i></a>
                                <div class="customer-ho">
                                    <div class="hoso"><a href="{{route('user.detail')}}">Thông tin</a></div>
                                    <div class="hoso"><a href="{{route('logout')}}">Đăng xuất</a></div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="shopping">
                            <a href="{{route('cart.index')}}"><i class="fab fa-shopify"></i></a>
                            <!-- <span class="change">0</span> -->
                        </div>
                        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-content">
                                <div class="container main-search-active">
                                    <div class="sidebar-search-input">
                                        <form action="" class="search-bar" method="GET" role="search">{{-- {{route('search_product')}} --}}
                                            <div class="form-search">
                                                <input type="search" name="ten_san_pham" placeholder="Tìm Kiếm Sản Phẩm" class="input-text" id="search">
                                                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                                            </div>
                                            <div class="search-close">
                                                <!-- <button type="button" class="close" data-dismiss="modal"><i
                                                            class="fas fa-times"></i></button> -->
                                                <a href=""><i class="fas fa-times"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- *********************** End Header ***************** -->
<div class="totopone"><a href="#" class="totop"><i class="fas fa-angle-double-up"></i></a></div>
