@extends('user.layouts.master')
@section('content')
<section>
    <div class="cart-shopping">
        <div class="container">
        @if(!empty($cart))
            <h2>Thanh Toán Đặt Mua</h2>
            @endif
            <?php
            $mess = Session::get('mess');
            if ($mess) {
                echo '<span class="text-alert" style="font-size: 1rem; display:flex; color: red; font-weight: 700; text-align: center;">' . $mess . '</span>';
                Session::put('mess', null);
            }
            $success = Session::get('success');
            if ($success) {
                echo '<span class="text-alert" style="font-size: 1rem; display:flex; color: blue; font-weight: 700; text-align: center;">' . $success . '</span>';
                Session::put('success', null);
            }
            ?>
            <div class="row">

                <div class="cart-left col-xl-8 col-lg-8 col-md-7 col-12">
                    <form action="{{route('update_cart')}}" method="post">
                        {{csrf_field()}}
                        <div class="cart-left-form">
                            <table class="shop-table">
                            @if(!empty($cart))
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

                                    @foreach($cart as $key => $cart)
                                    @php
                                    $subtotal = $cart['product_price']*$cart['product_qty'];
                                    $total+=$subtotal;
                                    @endphp
                                    <tr>
                                        <td class="product-remove"><i style="color: #ff6801;" class="far fa-arrow-alt-circle-right"></i></td>
                                        <td class="product-thumbnail"> <a href=""><img style="width: 100px; height:130px;" src="data:image/png;base64, {{$cart['product_image']}}" alt=""></a></td>
                                        <td class="product-thumbnail"> <a href="">{{$cart['product_name']}}</a></td>
                                        <td class="product-price">
                                            <span class="price">{{number_format($cart['product_price'],0,',',',')}}VNĐ</span>
                                        </td>
                                        <td class="amount">
                                            <input type="number" value="{{$cart['product_qty']}}" min="1" max="{{$cart['product_quantity']}}" class="cart_quantity" name="cart_qty[{{$cart['session_id']}}]" id="" disabled>
                                            <input type="hidden" name="rowId_cart" class="form-control" value="">
                                        </td>
                                        <td class="product-subtotal" data-title="tạm tính">
                                            <span class="total-price">
                                                {{number_format($subtotal,0,',',',')}}VNĐ
                                            </span>
                                        </td>
                                    </tr>

                                    @endforeach
                                    @else
                                </tbody>

                                @endif
                            </table>

                        </div>
                    </form>

                </div>
                @if(isset($shipping))
                <div class="cart-right col-xl-4 col-lg-4 col-md-5 col-12">
                    <div class="cart-total">

                        <table cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="product-name" colspan="2" style="border-width:3px;">Địa chỉ giao hàng
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <form action="{{route('checkout.place_order')}}" method="post">
                        <!-- <h2>Thông Tin Đơn Hàng</h2> -->
                        <table cellspacing="0" class="shop_table" style="width:100%">
                            <tbody style="line-height: 1.5rem;">
                                <tr class="cart-subtotal">
                                    <th>Họ Tên :</th>
                                </tr>
                                <tr class="shipping ">
                                    <th style="font-weight: 300; text-transform:uppercase;">{{$shipping->receiver_name}}</th>
                                    <td data-title="Tạm tính">
                                        <span class="amount">
                                            <!-- A8 khu cảnh vệ đường man thiện phường tăng nhơn phú a quận 9 -->
                                        </span>
                                    </td>
                                </tr>
                                <tr class="shipping ">
                                    <th>Địa Chỉ :</th>

                                </tr>
                                <tr class="cart-subtotal">
                                    <th style="font-weight: 300;">{{$shipping->receiver_address}}</th>

                                </tr>
                                <tr class="shipping ">
                                    <th>Số Điện Thoại :</th>

                                </tr>
                                <tr class="cart-subtotal">
                                    <th style="font-weight: 300;">{{$shipping->receiver_phone}}</th>

                                </tr>
                                <tr class="shipping ">
                                    <th>Tổng Tiền</th>

                                </tr>
                                <tr class="cart-subtotal">
                                    <th style="font-weight: 300;">{{number_format($total,0,',',',')}} VNĐ</th>
                                    @php
                                    $total_usd= $total/23000;
                                    @endphp
                                    <input type="hidden" id="cart_total" value="{{round($total_usd)}}">
                                </tr>

                            </tbody>
                        </table>
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="">Phương Thức Thanh Toán</label>
                                <?php
                                $message = Session::get('message');
                                if ($message) {
                                    echo '<span class="text-alert" style="font-size: 1rem; display:flex; color: red; font-weight: 700; text-align: center;">' . $message . '</span>';
                                    Session::put('message', null);
                                }
                                ?>
                                <input type="hidden" name="id_cart" value="{{$shipping->id}}">
                                <input type="hidden" name="total_money" value="{{$total}}">
                                <select name="payment_option" id="paypal-one" class="form-control input-sm m-bot15 choose city">
                                    <option value="0">--Chọn Phương Thức Thanh Toán-- </option>
                                    <option value="1">Tiền Mặt</option>
                                    <option value="2">VNPAY</option>
                                </select>
                            </div>
                            <!-- //paypal -->
                            <div id="paypal-button-container" class="total-paypal"></div>

                            <div class="payment">
                                <input type="submit" value="Đặt Hàng" class="checkout-button button" name="send_order_place">
                            </div>
                            <input type="hidden" name="order_total" value="{{number_format($total,0,',',',')}}">
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
