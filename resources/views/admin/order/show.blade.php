@extends('admin.layouts.master')
@section('admin_content')
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin Khách Hàng
            </div>

            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>

                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>

                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>


                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order_by_id->user->first_name . ' ' . $order_by_id->user->last_name}}</td>
                            <td>{{ $order_by_id->user->phone }}</td>
                            <td>{{ $order_by_id->user->email }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <br>
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển hàng
            </div>


            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>

                            <th>Tên người Nhận</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Ghi chú</th>
                            <th>Hình thức thanh toán</th>
                            {{-- <th>Nhân viên phân công</th> --}}

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if (isset($order_by_id))
                                <td>{{ $order_by_id->receiver_name }}</td>
                                <td>{{ $order_by_id->receiver_address }}</td>
                                <td>{{ $order_by_id->receiver_phone }}</td>
                                <td>{{ $order_by_id->user->email }}</td>
                                <td>{{ $order_by_id->note }}</td>
                                <td>
                                    @if ($order_by_id->payments == 1)
                                        VNPAY
                                    @else
                                        Tiền Mặt
                                    @endif
                                </td>
                                {{-- <td>{{ $ho_ten_nv }}</td> --}}
                            @endif
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <br><br>
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
            </div>

            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>

                <table class="table table-striped b-t b-light">
                    <thead>

                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Mã Đơn Hàng</th>
                            <!-- <th>Phí ship hàng</th> -->
                            <th>Số lượng</th>
                            <th>Giá bán</th>
                            <!-- <th>Giá gốc</th> -->
                            <th>Tổng tiền</th>

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @if (!empty($order_detail))
                            @foreach ($order_detail as $details)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    @if (isset($details->product_id))
                                        <td>{{ $details->product_id->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if (isset($details->order_id))
                                        <td>{{ $details->order_id->bill->code }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $details->amount }}</td>
                                    <td>{{ number_format($details->price, 0, ',', ',') }} VND</td>
                                    @if (isset($details->order_id->bill))
                                        <td>{{ number_format($details->order_id->bill->total, 0, ',', ',') }} VND</td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tr>
                        <td colspan="2">
                            @if (isset($order_by_id))
                                @if ($order_by_id->status == 0)
                                    <form action="">
                                        @csrf
                                        <select name="" class="form-control order_details" id="">
                                            <option id="{{ $order_by_id->id }}" value="0">Đơn
                                                Hàng Mới</option>
                                            <option id="{{ $order_by_id->id }}" value="1">Duyệt
                                                đơn</option>
                                        </select>
                                    </form>
                                @elseif($order_by_id->status == 1)
                                    <form action="">
                                        @csrf
                                        <select name="" class="form-control order_details" id="">
                                            <option id="{{ $order_by_id->id }}" selected
                                                value="1">Đã duyệt</option>
                                            <option id="{{ $order_by_id->id }}" value="2">Hoàn
                                                tất</option>
                                            <option id="{{ $order_by_id->id }}" value="3">Hủy
                                                Đơn Hàng</option>
                                        </select>
                                    </form>
                                @elseif($order_by_id->status == 2)
                                    <p style="color: #9c3328">Hoàn tất</p>
                                @else
                                    <p style="color: #9c3328">Đã Hủy Đơn hàng</p>
                                @endif
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <a type="button" class="btn btn-success" href="{{route('admin.order.index')}}">Trở về</a>
    </div>

@endsection
