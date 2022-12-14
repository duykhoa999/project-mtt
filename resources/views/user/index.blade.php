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
        <div class="shop-section" style="background: White;">
            <div class="container">
                <div class="row">
                    <div class="services" style="flex-wrap: wrap;">
                        <div class="services-item boder-right col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <a href=""><i class="fas fa-truck"></i></a>
                            <div class="services-text">
                                <h5>Giao Hàng Miễn Phí</h5>
                                <p>Tất Cả Đơn Hàng</p>
                            </div>
                        </div>
                        <div class="services-item boder-right col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <a href=""><i class="far fa-credit-card"></i></a>
                            <div class="services-text">
                                <h5>Thanh Toán An Toàn</h5>
                                <p>An toàn 100%</p>
                            </div>
                        </div>
                        <div class="services-item boder-right col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <a href=""><i class="far fa-comment-alt"></i></a>
                            <div class="services-text">
                                <h5>Hỗ Trợ 24/7</h5>
                                <p>Hỗ trợ trực tuyến</p>
                            </div>
                        </div>
                        <div class="services-item col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <a href=""><i class="fas fa-wallet"></i></a>
                            <div class="services-text">
                                <h5>Bảo Hành 24 Ngày</h5>
                                <p>Lỗi từ nhà sản xuất</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop-section-banner">
            <div class="container">
                <div class="row">
                    <div class="banner-section flex" style="flex-wrap: wrap;">
                        @if (!empty($brand_pro))
                            @foreach ($brand_pro as $key => $brand)
                                <div class="col-md-1"></div>
                                <div class="banner-section col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                    <div class="banner-img">
                                        <img src="{{ URL::to('uploads/type/' . $brand->hinh_anh) }}" alt=""
                                            style="height: 300px;">
                                    </div>
                                    <div class="banner-content">
                                        <h3 style="text-transform: uppercase;">{{ $brand->ten_th }}</h3>
                                        <p>Giảm Giá Lên Tới 50%</p>
                                        <a href="{{ URL::to('/thuong-hieu/' . $brand->ma_th) }}" class="btn btn-3">Mua
                                            Ngay</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="category-list">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="category">
                            {{-- <div class="category-title">
                                <h2>SẢN PHẨM NỔI BẬT</h2>
                            </div> --}}
                            <div class="category-section">
                                <form method="POST">
                                    @csrf
                                    <div class="row">
                                        @if (!empty($all_product_highlights))
                                            @foreach ($all_product_highlights as $key => $product)
                                                <input type="hidden" value="{{ $product->id }}"
                                                    class="cart_product_id_{{ $product->id }}">

                                                <input type="hidden" id="wishlist_productname{{ $product->id }}"
                                                    value="{{ $product->name }}"
                                                    class="cart_product_name_{{ $product->id }}">

                                                <input type="hidden" value="{{ $product->amount }}"
                                                    class="cart_product_quantity_{{ $product->id }}">

                                                <input type="hidden" value="{{ $product->hinh_anh }}"
                                                    class="cart_product_image_{{ $product->id }}">

                                                <input type="hidden" id="wishlist_productprice{{ $product->id }}"
                                                    value="{{ number_format($product->gia, 0, ',', ',') }}VNĐ">

                                                <input type="hidden" value="{{ $product->gia }}"
                                                    class="cart_product_price_{{ $product->id }}">

                                                <input type="hidden" value="1"
                                                    class="cart_product_qty_{{ $product->id }}">
                                                <div class="item-category col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
                                                    @if ($product->amount == 0)
                                                        <div class="error">
                                                            <p class="error-one">HẾT HÀNG</p>
                                                        </div>
                                                    @endif
                                                    <div class="images-products">
                                                        <a href="{{ route('show-detail-product', ['id' => $product->id]) }}">
                                                            <img class="image-one"
                                                                src="{{ URL::to('uploads/product/' . $product->hinh_anh) }}"
                                                                alt="">
                                                            <img class="image-two"
                                                                src="{{ URL::to('uploads/product/' . $product->hinh_anh) }}"
                                                                alt="">
                                                        </a>
                                                        <div class="love">
                                                            <div class="love-one">
                                                                <i class="far fa-heart"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-products">
                                                        <h3><a href="{{route('show-detail-product', ['id' => $product->id])}}">{{ $product->name }}</a></h3>
                                                        <!-- <p> Mã số: 0020234</p> -->
                                                        <div class="price-item">
                                                            <span
                                                                class="price">{{ number_format($product->price) . ' VNĐ' }}</span>
                                                            <span class="price-discount"></span>
                                                        </div>

                                                        <div class="addtocart">
                                                            <div class="shopping">
                                                                <button type="button"
                                                                    data-product="{{ json_encode($product) }}"
                                                                    name="add-to-cart" class="btn add-to-cart"> <i
                                                                        class="fas fa-shopping-cart"></i> ADD TO
                                                                    CART</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="category-list">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="category">
                            <div class="category-title">
                                <h2>SẢN PHẨM MỚI</h2>
                            </div>
                            <div class="category-section">
                                <form method="POST">
                                    @csrf
                                    <div class="row">
                                        @if (!empty($products_new))
                                            @foreach ($products_new as $key => $product)
                                                <input type="hidden" value="{{ $product->id }}"
                                                    class="cart_product_id_{{ $product->id }}">

                                                <input type="hidden" id="wishlist_productname{{ $product->id }}"
                                                    value="{{ $product->name }}"
                                                    class="cart_product_name_{{ $product->id }}">

                                                <input type="hidden" value="{{ $product->amount }}"
                                                    class="cart_product_quantity_{{ $product->id }}">

                                                <input type="hidden" value="{{ $product->image }}"
                                                    class="cart_product_image_{{ $product->id }}">

                                                <input type="hidden" id="wishlist_productprice{{ $product->id }}"
                                                    value="{{ number_format($product->price, 0, ',', ',') }}VNĐ">
                                                @if (isset($product->coupon_details) && $product->coupon_details->phantram_km > 0  && $product->coupon_details->so_luong > 0)
                                                    <input type="hidden"
                                                        value="{{ $product->gia - ($product->gia * $product->coupon_details->phantram_km) / 100 }}"
                                                        class="cart_product_price_{{ $product->id }}">
                                                @else
                                                    <input type="hidden" value="{{ $product->price }}"
                                                        class="cart_product_price_{{ $product->id }}">
                                                @endif
                                                <input type="hidden" value="1"
                                                    class="cart_product_qty_{{ $product->id }}">
                                                <div class="item-category col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
                                                    @if ($product->amount == 0)
                                                        <div class="error">
                                                            <p class="error-one">HẾT HÀNG</p>
                                                        </div>
                                                    @endif
                                                    <div class="images-products">
                                                        <a href="{{ route('shop.show-detail-product', ['id' => $product->id]) }}">
                                                            <img class="image-one" height="800px"
                                                                src="data:image/png;base64, {{$product->image}}"
                                                                alt="">
                                                            <img class="image-two"
                                                                src="data:image/png;base64, {{$product->image}}"
                                                                alt="">
                                                        </a>
                                                        <div class="love">
                                                            <div class="love-one">
                                                                <i class="far fa-heart"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-products">
                                                        <h3><a href="{{route('shop.show-detail-product', ['id' => $product->id])}}">{{ $product->name }}</a></h3>
                                                        <!-- <p> Mã số: 0020234</p> -->
                                                        <div class="price-item">
                                                            @if (isset($product->coupon_details) && $product->coupon_details->phantram_km > 0 && $product->coupon_details->so_luong > 0)
                                                                <span
                                                                    class="price-discount">{{ number_format($product->gia) }}
                                                                    VNĐ</span>
                                                                <span
                                                                    class="price">{{ number_format($product->gia - ($product->gia * $product->coupon_details->phantram_km) / 100) }}
                                                                    VNĐ</span>
                                                            @else
                                                                <span
                                                                    class="price">{{ number_format($product->price) . ' VNĐ' }}</span>
                                                            @endif
                                                        </div>
                                                        <?php 
                                                            $user = Session::get('user');
                                                            $check = 1;
                                                            if ($user === null) {
                                                                $check = 0;
                                                            }
                                                        ?>
                                                        <div class="addtocart">
                                                            <div class="shopping">
                                                                <button type="button"
                                                                    data-product="{{ json_encode($product) }}"
                                                                    data-check="{{ $check }}"
                                                                    name="add-to-cart" class="btn add-to-cart"> <i
                                                                        class="fas fa-shopping-cart"></i> ADD TO
                                                                    CART</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
