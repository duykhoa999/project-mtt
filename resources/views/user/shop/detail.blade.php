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
        <div class="products-brand" style="padding-top: 3rem;">
            <input type="hidden" value="{{ $product->id }}" class="cart_product_id_{{ $product->id }}">

            <input type="hidden" id="wishlist_productname{{ $product->id }}" value="{{ $product->name }}"
                class="cart_product_name_{{ $product->id }}">

            <input type="hidden" value="{{ $product->amount }}" class="cart_product_quantity_{{ $product->id }}">

            <input type="hidden" value="{{ $product->image }}" class="cart_product_image_{{ $product->id }}">

            <input type="hidden" id="wishlist_productprice{{ $product->id }}"
                value="{{ number_format($product->price) }}VNĐ">
            @if (isset($product->coupon_details) &&
                $product->coupon_details->phantram_km > 0 &&
                $product->coupon_details->so_luong > 0)
                <input type="hidden"
                    value="{{ $product->price - ($product->price * $product->coupon_details->phantram_km) / 100 }}"
                    class="cart_product_price_{{ $product->id }}">
            @else
                <input type="hidden" value="{{ $product->price }}" class="cart_product_price_{{ $product->id }}">
            @endif
            {{-- <input type="hidden" value="1" class="cart_product_qty_{{ $product->id }}"> --}}
            <div class="container">
                <div class="detail-products">
                    <div class="row">
                        <div class="col-sm-12 col-lg-4 padding-left">
                            <div class="cart-img-detail">
                                <div class="col-md-12 col-lg-12">
                                    <img class="img-fluid" src="data:image/png;base64, {{$product->image}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 padding-right">
                            <form action="{{ URL::to('/gio-hang') }}" method="GET">
                                {{ csrf_field() }}
                                <div class="col-inner text-left">
                                    <h1 class="product-title product_title entry-title">{{ $product->name }}</h1>
                                    <div class="product-price-container is-xlarge">
                                        <span class="woocommerce-Price-amount amount">
                                            <b>Giá: </b>
                                            @if (isset($product->coupon_details) && $product->coupon_details->phantram_km > 0  && $product->coupon_details->so_luong > 0)
                                                <span
                                                    style="text-decoration-line:line-through;text-decoration-color:black">{{ number_format($product->price) . ' VNĐ' }}</span>
                                                <span
                                                    class="price">{{ number_format($product->price - ($product->price * $product->coupon_details->phantram_km) / 100) . ' VNĐ' }}</span>
                                                
                                            @else
                                                <span class="price">{{ number_format($product->price) . ' VNĐ' }}</span>
                                            @endif

                                        </span>
                                    </div>
                                    <div class="quantity">
                                        <label for="">Số Lượng:</label>
                                        <input type="number" name="qty" id=""
                                            class="cart_detail cart_product_qty_{{ $product->id }}" value="1"
                                            min="1" max="{{ $product->amount }}">
                                        <input type="hidden" name="productid_hiden" value="{{ $product->id }}">
                                    </div>
                                    @if ($product->amount == 0)
                                        <span class="text-alert" style="color: red;font-weight: 700;font-size: 3rem;">Hết
                                            Hàng</span>
                                    @else
                                        <?php
                                        $user = Session::get('user');
                                        $check = 1;
                                        if ($user === null) {
                                            $check = 0;
                                        }
                                        ?>
                                        <button style="cursor: pointer;" data-check="{{ $check }}" type="button"
                                            data-product="{{ json_encode($product)}}" name="add-to-cart"
                                            class="btn btn-primary btn-sm add-to-cart">Thêm Giỏ Hàng</button>
                                    @endif
                                    <!-- <button style="cursor: pointer;" type="submit" data-id_product="{{ $product->id }}" name="add-to-cart" class="btn btn-primary btn-sm add-to-cart">Thêm Giỏ Hàng</button> -->
                                    <div class="note">
                                        <p style="font-size: 24px;"><b>Tình
                                                Trạng:</b>{{ $product->amount == 0 ? 'Hết hàng' : 'Còn hàng' }}</p>
                                        <p style="font-size: 24px;"><b>Điều kiện:</b> Mới 100%</p>
                                        <p style="font-size: 24px;"><b>Số lượng kho còn: </b>
                                            @if ($product->amount == 0)
                                                <span class="text-alert" style="color: red;font-weight: 700;">Hết
                                                    Hàng</span>
                                            @else
                                                {{ $product->amount }}
                                            @endif
                                        </p>
                                        {{-- <p style="font-size: 24px;"><b>Thương hiệu:</b>
                                            {{ $product->thuong_hieu->ten_th }}</p>
                                        <p style="font-size: 24px;"><b>Danh mục:</b> {{ $product->loai_ruou->ten_lr }}</p> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="category-tab shop-details-tab">
                    <div class="col-sm-12 ">
                        <ul class="nav nav-tabs">

                            <a class="chitiet active" data-electronic="details" style="cursor:pointer">Mô Tả</a>
                            <a class="chitiet" data-electronic="companyprofile" style="cursor:pointer">Chi Tiết Sản
                                Phẩm</a>
                            <a class="chitiet" data-electronic="reviews" style="cursor:pointer">Bình Luận</a>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="details" class="tab-pane active">
                            <p><i class="far fa-arrow-alt-circle-right"></i>
                                <b>{!! $product->description !!}</b>
                            </p>
                        </div>
                        <div id="companyprofile" class="tab-pane">

                            {{-- <p><i class="far fa-arrow-alt-circle-right"></i>
                                <b>{!! $product->noi_dung_dr !!}</b>
                            </p> --}}
                        </div>
                        <div id="reviews" class="tab-pane tab-pane-reviews">
                            <p>
                                Viết đánh giá của bạn
                            </p>
                            <div id="comment_show">
                                <form action="" method="post">
                                    @csrf
                                    <input type="hidden" name="comment_product_id" class="comment_product_id"
                                        value="{{ $product->id }}">
                                    <div id="comment_show1"></div>

                                </form>
                            </div>
                            <form action="">
                                @csrf
                                <span>
                                    <input type="hidden" name="comment_product_id" class="comment_product_id"
                                        value="{{ $product->id }}">
                                    <input type="text" name="comment_name" id="" value=""
                                        class="comment_name" placeholder="Tên Bình Luận">
                                </span>
                                <textarea name="comment" class="comment_content" placeholder="Nội dung bình luận" id="" cols="30"
                                    rows="10"></textarea>
                                <div id="notify_comment"></div>
                                <button class="btn btn-default pull-right send-comment" type="button"><i
                                        class="far fa-arrow-alt-circle-right"></i>Gửi Bình
                                    Luận</button>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
