@extends('admin.layouts.master')
@section('admin_content')
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Product
            </div>
                <div class="row w3-res-tb">
                    <form style="float: right" action="{{ route('admin.import.show', ['id' => $import->id]) }}" method="get">
                        <div class="group-input f-r">
                            <input type="text" name="keyword" value="{{ $param['keyword'] ?? '' }}" placeholder="Search">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            <div class="table-responsive">
                @if (session('message_add'))
                    <div class="alert alert-success">
                        {{ session('message_add') }}
                    </div>
                @endif
                @if (session()->has('error_add'))
                    {!! session()->get('error_add') !!}
                    @php
                        session()->forget('error_add');
                    @endphp
                @endif
                <form action="{{ route('admin.import.add_detail', ['id' => $import->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <table class="table table-striped b-t b-light" id="myTable">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                </th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>In Stock</th>
                                <th>Order Price</th>
                                <th>Order Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_paginate as $key => $pro)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkBox" data-id="{{ $pro->id }}"
                                            name="data[{{ $pro->id }}][check]"
                                            {{ !empty($session_import) && array_key_exists($pro->id, $session_import) ? 'checked' : '' }}>
                                    </td>

                                    <td>{{ $pro->name }}</td>
                                    <input type="hidden" name="data[{{ $pro->id }}][name]"
                                        id="name_{{ $pro->id }}" value="{{ $pro->name }}">
                                    <td><img src="data:image/png;base64, {{$pro->image}}" height="100px" width="100px">
                                    </td>
                                    <td>{{ $pro->amount }}</td>
                                    <td><input style="vertical-align: center;" type="number" min="1" step="0.1"
                                            value="{{ !empty($session_import) && array_key_exists($pro->id, $session_import) ? $session_import[$pro->id]['price'] : '' }}"
                                            min="1" step="0.1" id="price_{{ $pro->id }}"
                                            name="data[{{ $pro->id }}][import_price]"></td>
                                    <td><input style="vertical-align: center;" type="number"
                                            value="{{ !empty($session_import) && array_key_exists($pro->id, $session_import) ? $session_import[$pro->id]['amount'] : '' }}"
                                            min="1" id="qty_{{ $pro->id }}"
                                            name="data[{{ $pro->id }}][amount]"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (!empty($product_paginate))
                        <button type="submit" class="btn btn-success">Submit</button>
                    @endif
                </form>
            </div>
            @if (!empty($all_product))
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-5 text-center">
                            {{-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                {{-- {{$all_product->links()}} --}}
                                @include('admin.layouts.pagination')
                            </ul>
                        </div>
                    </div>
                </footer>
            @endif

        </div>
    </div>
    <br>
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Import Detail
            </div>

            <div class="table-responsive">
                @if (session('message_edit'))
                    <div class="alert alert-success">
                        {{ session('message_edit') }}
                    </div>
                @endif
                @if (session('error_edit'))
                    <div class="alert alert-danger">
                        {{ session('error_edit') }}
                    </div>
                @endif

                <table class="table table-striped b-t b-light">
                    <thead>

                        <tr>
                            <th>Product Name</th>
                            <th>Import Code</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @if (!empty($import_detail))
                            @foreach ($import_detail as $details)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    @if (isset($details->product_id))
                                        <td>{{ $details->product_id->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $import->code }}</td>
                                    <td>{{ $details->amount }}</td>
                                    <td>{{ number_format($details->price, 0, ',', ',') }} VND</td>
                                    <td>{{ number_format($details->price * $details->amount, 0, ',', ',') }} VND</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tr>
                        <td colspan="2">
                            @if (isset($order_by_id['0']['order']['0']))
                                @if ($order_by_id['0']['order']['0']->trang_thai == 0)
                                    <form action="">
                                        @csrf
                                        <select name="" class="form-control order_details" id="">
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" value="0">Đơn
                                                Hàng Mới</option>
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" value="1">Duyệt
                                                đơn</option>
                                        </select>
                                    </form>
                                @elseif($order_by_id['0']['order']['0']->trang_thai == 1)
                                    <form action="">
                                        @csrf
                                        <select name="" class="form-control order_details" id="">
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" selected
                                                value="1">Đã duyệt</option>
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" value="2">Phân
                                                công nhân viên</option>
                                        </select>
                                    </form>
                                @elseif($order_by_id['0']['order']['0']->trang_thai == 2)
                                    <form action="">
                                        @csrf
                                        <select name="" class="form-control order_details" id="">
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" selected
                                                value="2">Đã phân công nhân viên</option>
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" value="3">Hoàn
                                                tất</option>
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" value="4">Hủy
                                                Đơn Hàng</option>
                                        </select>
                                    </form>
                                @elseif($order_by_id['0']['order']['0']->trang_thai == 3)
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
        <a type="button" class="btn btn-success" href="{{ route('admin.import.index') }}">Back</a>
    </div>

@endsection
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".checkBox").click(function() {
            if ($(this).is(':checked')) {
                id = $(this).data('id');
                qty = $('#qty_' + id).val();
                price = $('#price_' + id).val();
                $.ajax({
                    url: "{{ route('admin.import.saveSession') }}",
                    type: 'GET',
                    data: {
                        id: id,
                        amount: qty,
                        price: price
                    },
                    // method: 'GET',
                    // dataType: "JSON",
                    success: function(response) {

                    }
                });
            }
        });
    });
</script>
