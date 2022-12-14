@extends('user.layouts.master')
@section('content')
    <!-- *********************** Start Banner ***************** -->
    <div class="banner" style="background: white;">
        <div class="house owl-carousel owl-theme container" id="banner-slider">
            <div class="item">
                <img src="{{ URL::to('frontend/img/banner1.jpg') }}" alt="">
                <!-- <div class="item-content">
                    <span>Giảm giá mùa hè!</span>
                    <h2 style="color: white;">Máy Chạy Bộ Điện Đa Năng
                        <br style="color: white;"> Phong Cách Đơn Giản
                    </h2>
                    <p style="color: white;">Giảm Giá Lớn</p>
                    <h3 style="color: white;">Sale 30% Off</h3>
                    <button class="shopnow"> <a style="color: white; text-decoration: none;" href="{{ URL::to('/chi-tiet-san-pham/31') }}">Mua Ngay</a></button>
                </div> -->
            </div>
            <div class="item">
                <img src="{{ URL::to('frontend/img/banner_2.jpg') }}" alt="">
                <!-- <div class="item-content">
                    <span style="color: white;">Đừng Bỏ Lỡ!</span>
                    <h2 style="color: white;">Ghế Tập Bụng Đa Năng
                    </h2>
                    <p style="color: white;">Thiết Bị Tập Gym</p>
                    <h3 style="color: white;">Giá chỉ 1,450,000</h3>
                    <button class="shopnow"> <a style="color: white; text-decoration: none;" href="{{ URL::to('/chi-tiet-san-pham/42') }}">Mua Ngay</a></button>
                </div> -->
            </div>
            <div class="item">
                <img src="{{ URL::to('frontend/img/banner2.jpg') }}" alt="">
                <!-- <div class="item-content">
                    <span style="color: white;">Áo Ngắn Tay Nam</span>
                    <h2 style="color: white;">Kiểu dáng thời trang
                        <br style="color: white;"> Đẳng cấp 4 mùa
                    </h2>
                    <p style="color: white;">Sản phẩm mới</p>
                    <h3 style="color: white;">Giảm giá 15%</h3>
                    <button class="shopnow"> <a style="color: white; text-decoration: none;" href="{{ URL::to('/chi-tiet-san-pham/45') }}">Mua Ngay</a></button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- *********************** End Banner ***************** -->
    <section>
        <div class="cart-shopping">
            <div class="container">
                <h2>Giỏ Hàng Của Bạn</h2>
                <div class="row">
                    <div class="cart-left col-xl-8 col-lg-8 col-md-7 col-12">
                        <form action="{{ route('update_cart') }}" method="POST">
                            @csrf
                            <div class="cart-left-form">
                                <table class="shop-table">
                                    <thead>
                                        <tr class="cart_items">
                                            <th class="product-name" colspan="3">Sản Phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity" style="width: 9rem;">Số Lượng</th>
                                            <th class="product-subtotal">Tạm Tính</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @if (!empty($cart))
                                            @foreach ($cart as $key => $cart)
                                                @php
                                                    $subtotal = $cart['product_price'] * $cart['product_qty'];
                                                    $total += $subtotal;
                                                @endphp
                                                @if (Session::get('coupon_code'))
                                                    @foreach (Session::get('coupon_code') as $key => $cou)
                                                        <input type="hidden" name="order_coupon" class="order_coupon"
                                                            value="{{ $cou['coupon_code'] }}">
                                                    @endforeach
                                                @else
                                                    <input type="hidden" name="order_coupon" class="order_coupon"
                                                        value="Không Khuyến Mãi">
                                                @endif
                                                <tr>
                                                    @if (session()->has('message'))
                                                        {!! session()->get('message') !!}
                                                        @php
                                                            session()->forget('message');
                                                        @endphp
                                                    @endif
                                                    <td class="product-remove"><a
                                                            href="{{ route('del_cart', ['session_id' => $cart['session_id']]) }}">X</a>
                                                    </td>
                                                    <td class="product-thumbnail"> <a href=""><img
                                                                style="width: 100px; height:130px;"
                                                                src="data:image/png;base64, {{$cart['product_image']}}"
                                                                alt=""></a></td>
                                                    <td class="product-thumbnail"> <a
                                                            href="">{{ $cart['product_name'] }}</a></td>
                                                    <td class="product-price">
                                                        <span
                                                            class="price">{{ number_format($cart['product_price'], 0, ',', ',') }}VNĐ</span>
                                                    </td>
                                                    <td class="amount">
                                                        <input type="number" value="{{ $cart['product_qty'] }}"
                                                            min="1"
                                                            class="cart_quantity"
                                                            name="cart_qty[{{ $cart['session_id'] }}]" id="">
                                                        <input type="hidden" name="rowId_cart" class="form-control"
                                                            value="">
                                                    </td>
                                                    <td class="product-subtotal" data-title="tạm tính">
                                                        <span class="total-price">
                                                            {{ number_format($subtotal, 0, ',', ',') }}VNĐ
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        @endif

                                    </tbody>
                                </table>
                            </div>

                            <div class="home-menu flex" style="align-items: center; justify-content: space-between;">
                                <div class="left">
                                    <a href="{{ route('index') }}"><i class="fas fa-angle-double-left"></i> Tiếp Tục
                                        Mua Hàng</a>
                                </div>
                                @if (!empty($cart))
                                    <div class="right">
                                        <!-- <a href=""><i class="fab fa-angellist"></i> Cập Nhập Giỏ Hàng</a> -->
                                        <input type="submit" name="update_qty" value="Cập Nhập Giỏ Hàng">
                                    </div>
                                @endif
                            </div>
                        </form>

                    </div>
                    <div class="cart-right col-xl-4 col-lg-4 col-md-5 col-12">
                        <div class="cart-total">
                            <table cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="product-name" colspan="2" style="border-width:3px;">Thông Tin Đơn
                                            Hàng
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- <h2>Thông Tin Đơn Hàng</h2> -->
                            <table cellspacing="0" class="shop_table" style="width:100%">
                                @if (!empty($cart))
                                    <tbody>
                                        @if (Session::get('coupon_code'))
                                            @foreach (Session::get('coupon_code') as $key => $cou)
                                                @if ($cou['coupon_condition'] == 1)
                                                    <tr class="cart-subtotal">
                                                        <th>Tạm tính :</th>
                                                        <td data-title="Tạm tính">
                                                            <span class="amount">
                                                                {{ number_format($total, 0, ',', '.') }}VNĐ</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="shipping ">
                                                        <th>Phí Giao Hàng :</th>
                                                        <td data-title="Tạm tính">
                                                            <span class="amount">Free</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="shipping ">
                                                        <th>Giảm Giá :
                                                            @if (Session::get('coupon_code'))
                                                                @csrf
                                                                <a class="btn btn-default check_out"
                                                                    href="{{ URL::to('/unset-coupon') }}"><i
                                                                        style="color: red;"
                                                                        class="fas fa-trash-alt"></i></a>
                                                            @endif
                                                        </th>
                                                        <td data-title="Tạm tính">
                                                            <span class="amount"> @php
                                                                $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                                echo '
                                                ' .
                                                                    number_format($total_coupon, 0, ',', '.') .
                                                                    'VNĐ';
                                                            @endphp</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="cart-subtotal">
                                                        <th>Tổng :</th>
                                                        <td data-title="Tạm tính">
                                                            <span class="amount">
                                                                {{ number_format($total - $total_coupon, 0, ',', '.') }}VNĐ
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @elseif($cou['coupon_condition'] == 2)
                                                    <tr class="cart-subtotal">
                                                        <th>Tạm tính :</th>
                                                        <td data-title="Tạm tính">
                                                            <span class="amount">
                                                                {{ number_format($total, 0, ',', '.') }}VNĐ</span>
                                                        </td>
                                                    </tr>
                                                    {{-- <tr class="shipping ">
                                                        <th>Phí Giao Hàng :</th>
                                                        <td data-title="Tạm tính">
                                                            <span class="amount">Free</span>
                                                        </td>
                                                    </tr> --}}
                                                    <tr class="shipping ">
                                                        <th>Giảm Giá :
                                                            @if (Session::get('coupon_code'))
                                                                <a class="btn btn-default check_out"
                                                                    href="{{ URL::to('/unset-coupon') }}"><i
                                                                        style="color: red;"
                                                                        class="fas fa-trash-alt"></i></a>
                                                            @endif
                                                        </th>
                                                        <td data-title="Tạm tính">
                                                            <span class="amount"> @php
                                                                $total_coupon = $cou['coupon_number'];
                                                                echo '
                                                ' .
                                                                    number_format($total_coupon, 0, ',', '.') .
                                                                    'VNĐ';
                                                            @endphp</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="cart-subtotal">
                                                        <th>Tổng :</th>
                                                        <td data-title="Tạm tính">
                                                            <span class="amount">
                                                                {{ number_format($total - $total_coupon, 0, ',', '.') }}VNĐ
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr class="cart-subtotal">
                                                <th>Tạm tính :</th>
                                                <td data-title="Tạm tính">
                                                    <span class="amount"> {{ number_format($total, 0, ',', '.') }}VNĐ</span>
                                                </td>
                                            </tr>
                                            <tr class="shipping ">
                                                <th>Phí Giao Hàng :</th>
                                                <td data-title="Tạm tính">
                                                    <span class="amount">Free</span>
                                                </td>
                                            </tr>
                                            <tr class="shipping ">
                                                <th>Giảm Giá :

                                                </th>
                                                <td data-title="Tạm tính">
                                                    <span class="amount">0 VNĐ
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                <th>Tổng :</th>
                                                <td data-title="Tạm tính">
                                                    <span class="amount">
                                                        {{ number_format($total, 0, ',', '.') }}VNĐ
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                @else
                                    <tbody>
                                        <h1>Giỏ Hàng Trống</h1>
                                    </tbody>
                                @endif
                            </table>
                            <div class="payment">
                                @if (!empty($cart))
                                    <a class="checkout-button button" href="{{ route('checkout.index') }}">Tiến Hành
                                        Thanh Toán</a>
                                @endif
                            </div>
                        </div>
                        <!-- <form class="checkout_coupon mb-0" method="GET" action="{{ URL::to('/check-coupon') }}">
                            @csrf
                            <div class="coupon">
                                <p class="widget-title"><i class="fas fa-tags"></i> Mã Giảm Giá</p>
                            </div>
                            <input type="text" name="coupon_code" id="coupon_code" class="input-text" placeholder="Mã ưu đãi">
                            <input type="submit" value="ÁP DỤNG" name="check_coupon" class="is-form expand check_coupon">
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
