@extends('user.layouts.master')
@section('content')
    <section>
        <div class="customer-user">
            <div class="container">
                <div class="row">
                    <div class="user-left  col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="acount">
                            <img class="img-fluid" src="{{ URL::to('frontend/img/avata.png') }}" alt="" width="100px"
                                height="100px">
                            <div class="customer">
                                <p>Tài khoản của :</p>
                                <span>{{ $user->first_name . ' ' . $user->last_name }}</span>
                            </div>
                        </div>
                        <div class="usercart active" data-electronic="showcustomer">
                            <div class="cart-user">
                                <i class="fas fa-user-tie"></i>
                                <span>Thông tin tài khoản </span>
                            </div>
                        </div>
                        <div class="usercart" data-electronic="showcartone">
                            <div class="cart-user">
                                <i class="fas fa-shipping-fast"></i>
                                <span>Đơn hàng của tôi </span>
                            </div>
                        </div>
                        <div class="usercart" data-electronic="showpassword">
                            <div class="cart-user">
                                <i class="fas fa-key"></i>
                                <span>Đổi Mật Khẩu</span>
                            </div>
                        </div>
                    </div>
                    <div class="user-right  col-xl-9 col-lg-9 col-md-8 col-sm-6 col-12">
                        <div id="showcustomer" class="usercontent active">
                            <h1>Hồ sơ cá nhân</h1>
                            <form action="{{ route('user.update_customer') }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="customer_name">
                                    <label for="">Họ & Tên :</label>
                                    <input type="text" name="name" value="{{ $user->first_name . ' ' . $user->last_name }}" id="">
                                </div>
                                <div class="customer_name">
                                    <label for="">Email :</label>
                                    <label for="" class="email">{{ $user->email }}</label>
                                </div>
                                <div class="customer_name">
                                    <label for="">Số Điện Thoại :</label>
                                    <input type="text" name="phone" value="{{ $user->phone }}" id="">
                                </div>
                                <div class="customer_name">
                                    <label for="" style="vertical-align: top;">Địa chỉ :</label>
                                    <textarea required name="address" id="" cols="30" rows="10">{{ $user->address }}</textarea>
                                </div>
                                <div class="item-form btn">
                                    <button class="btn btn-submit-info" type="submit">
                                        <i class="fas fa-wrench"></i>
                                        Cập Nhật
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div id="showcartone" class="usercontent">

                            <div class="table-agile-info">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h1>Đơn hàng của bạn</h1>
                                    </div>
                                    <div class="row w3-res-tb">
                                    </div>
                                    <div class="table-responsive">

                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                                <tr>
                                                    <th>Mã Đơn Hàng</th>
                                                    <th>Tổng Tiền</th>
                                                    <th>Trạng Thái</th>
                                                    <!-- <th>Thanh Toán</th> -->
                                                    <th>Thời Gian</th>

                                                    <th style="width:30px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @forelse ($history_order as $key => $order)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                    <tr>
                                                        @if (isset($order['bills']))
                                                            <td>{{ $order['bills']->ma_hd }}</td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        @if (isset($order['bills']))
                                                            <td>{{ number_format($order['bills']->tong_tien,0,',',',') }} VND</td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        @if ($order->trang_thai == 0)
                                                            <td>Đơn Hàng Mới</td>
                                                        @elseif($order->trang_thai == 1)
                                                            <td> Đã xử Lý</td>
                                                        @elseif($order->trang_thai == 2)
                                                            <td>Đang giao hàng</td>
                                                        @elseif($order->trang_thai == 3)
                                                            <td>Đã Nhận Hàng</td>
                                                        @elseif($order->trang_thai == 4)
                                                            <td>Hủy Đơn Hàng</td>
                                                        @endif
                                                        <td>{{ date('d-M-Y', strtotime($order->ngay_dat)) }}</td>
                                                        <td class="flex">
                                                            <button style="width:9rem; margin-bottom: 0.5rem;"
                                                                class="btn btn-success"><a style="color: white;"
                                                                    href="{{ route('customer.view_order_user', ['orderId' => $order->id_pd]) }}">Xem
                                                                    Đơn Hàng</a></button>
                                                            @if ($order->trang_thai == 0)
                                                                <button type="button" id="{{ $order->id_pd }}"
                                                                    onclick="Huydonhang(this.id)" class="btn btn-danger">Hủy
                                                                    đơn hàng</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td style="text-align: center; font-weight: bold;" colspan="5"><h4>Bạn không có đơn hàng nào!</h4></td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="showpassword" class="usercontent">
                            <h1>Thay Đổi Mật Khẩu Mới</h1>
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo '<span class="text-alert">' . $message . '</span>';
                                Session::put('message', null);
                            }
                            ?>
                            <form action="{{ route('user.change-password') }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="password-show">
                                    <label for="">Mật Khẩu Cũ</label>
                                    <input type="password" name="password_old" id="" value=""
                                        placeholder="*********">
                                    @if ($errors->has('password_old'))
                                        <span
                                            style="color: red; font-weight: 700;">{{ $errors->first('password_old') }}</span>
                                    @endif
                                </div>
                                <div class="password-show">
                                    <label for="">Mật Khẩu Mới</label>
                                    <input type="password" name="password" id="" value=""
                                        placeholder="*********">
                                    @if ($errors->has('password'))
                                        <span style="color: red; font-weight: 700;">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="password-show">
                                    <label for="">Nhập Lại Mật Khẩu</label>
                                    <input type="password" name="password_comfirm" id="" value=""
                                        placeholder="*********">
                                    @if ($errors->has('password_comfirm'))
                                        <span
                                            style="color: red; font-weight: 700;">{{ $errors->first('password_comfirm') }}</span>
                                    @endif
                                </div>
                                <div class="password-show btn-pass">
                                    <button type="submit" class="btn-submit-pass">Đổi Mật Khẩu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
