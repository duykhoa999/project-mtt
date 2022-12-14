@extends('user.layouts.master')
@section('content')
    <section>
        <div class="payment-cart">
            <div class="container">
                <div class="row">
                    <h4>Thông Tin Giao Hàng</h4>
                    <form action="{{ route('checkout.save_checkout') }}" method="post" class="flex payment-two">
                        {{ csrf_field() }}
                        <div class="col-md-6 payment-left">
                            <input class="payment-home" type="text" value="{{old('receiver_name')}}" name="receiver_name" id=""
                                placeholder="Họ và tên người nhận">
                            @if ($errors->has('receiver_name'))
                                <span style="color: red; font-weight: 700;">{{ $errors->first('receiver_name') }}</span>
                            @endif
                            <input class="payment-home" type="text" value="{{old('receiver_phone')}}" name="receiver_phone" id=""
                                placeholder="Số điện thoại người nhận">
                            @if ($errors->has('receiver_phone'))
                                <span
                                    style="color: red; font-weight: 700;">{{ $errors->first('receiver_phone') }}</span>
                            @endif
                            <input class="payment-home" type="text" value="{{old('receiver_address')}}" name="receiver_address" id=""
                                placeholder="Địa chỉ nhận hàng">
                            @if ($errors->has('receiver_address'))
                                <span
                                    style="color: red; font-weight: 700;">{{ $errors->first('receiver_address') }}</span>
                            @endif
                            <textarea class="payment-home" name="note" id="" rows="5"
                                placeholder="Ghi chú cho đơn hàng của bạn">{{old('note')}}</textarea>
                        </div>
                        <div class="col-md-6 payment-right">
                            
                            <table cellspacing="0" class="shop_table-one" style="line-height: 3rem;">
                                @php
                                    $total = 0;
                                @endphp
                                @if (!empty($cart))
                                    @foreach ($cart as $key => $cart)
                                        @php
                                            $subtotal = $cart['product_price'] * $cart['product_qty'];
                                            $total += $subtotal;
                                        @endphp
                                    @endforeach
                                @else
                                @endif
                                <tbody>
                                    <tr class="cart-subtotal-one">
                                        <th>Tạm tính :</th>
                                        <td data-title="Tạm tính">
                                            <span class="amount"> {{ number_format($total, 0, ',', ',') }}VNĐ</span>
                                        </td>
                                    </tr>
                                    <tr class="cart-subtotal-one ">
                                        <th>Phí Giao Hàng :</th>
                                        <td data-title="Tạm tính">
                                            <span class="amount">Free</span>
                                        </td>
                                    </tr>
                                    <tr class="cart-subtotal-one ">
                                        <th>Giảm Giá :

                                        </th>
                                        <td data-title="Tạm tính">
                                            <span class="amount">0 VNĐ
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="cart-subtotal-one">
                                        <th>Tổng :</th>
                                        <td data-title="Tạm tính">
                                            <span class="amount">
                                                {{ number_format($total, 0, ',', ',') }}VNĐ
                                            </span>
                                        </td>
                                        <input type="hidden" name="total" value="{{ $total }}">
                                    </tr>
                                </tbody>
                            </table>
                            <!-- //test -->
                            <div class="submit-agileits">
                                <input type="submit" name="send_order" value="Tiếp Tục Thanh Toán">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
