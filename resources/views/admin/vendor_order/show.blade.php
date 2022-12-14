@extends('admin.layouts.master')
@section('admin_content')
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Product
            </div>
            <div class="row w3-res-tb">
                <form style="float: right" action="{{ route('admin.vendor_order.show', ['id' => $vendor_order->id]) }}" method="get">
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
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error_add') }}
                    </div>
                @endif
                <form action="{{route('admin.vendor_order.add_detail', ['id' => $vendor_order->id])}}" method="POST">
                    {{csrf_field()}}
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
                                        <input type="checkbox" class="checkBox" data-id="{{$pro->id}}" name="data[{{$pro->id}}][check]" {{(!empty($session_order) && array_key_exists($pro->id ,$session_order)) ? 'checked' : '' }}>
                                    </td>

                                    <td>{{ $pro->name }}</td>
                                    <input type="hidden" name="data[{{$pro->id}}][name]" id="name_{{$pro->id}}" value="{{$pro->name}}">
                                    <td><img src="data:image/png;base64, {{$pro->image}}" height="100px" width="100px"></td>
                                    <td>{{ $pro->amount }}</td>
                                    <td><input style="vertical-align: center;" type="number" value="{{(!empty($session_order) && array_key_exists($pro->id ,$session_order)) ? $session_order[$pro->id]['price'] : '' }}" id="price_{{$pro->id}}" name="data[{{$pro->id}}][order_price]"></td>
                                    <td><input style="vertical-align: center;" type="number" value="{{(!empty($session_order) && array_key_exists($pro->id ,$session_order)) ? $session_order[$pro->id]['amount'] : '' }}" min="1" id="qty_{{$pro->id}}" name="data[{{$pro->id}}][amount]"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        {{-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {{-- {!! $all_product->links() !!} --}}
                            @include('admin.layouts.pagination')
                        </ul>
                    </div>
                </div>
            </footer>

        </div>
    </div>
    <br>
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Vendor Order Detail
            </div>

            <div class="table-responsive">
                @if (session('message_edit'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error_edit'))
                    <div class="alert alert-danger">
                        {{ session('error_add') }}
                    </div>
                @endif

                <table class="table table-striped b-t b-light">
                    <thead>

                        <tr>
                            <th>Product Name</th>
                            <th>Order Code</th>
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
                        @if (!empty($vendor_order_detail))
                            @foreach ($vendor_order_detail as $details)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    @if (isset($details->product_id))
                                        <td>{{ $details->product_id->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $vendor_order->code }}</td>
                                    <td>{{ $details->amount }}</td>
                                    <td>{{ number_format($details->price, 0, ',', ',') }} VND</td>
                                    <td>{{ number_format($details->price * $details->amount, 0, ',', ',') }} VND</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
        <a type="button" class="btn btn-success" href="{{ route('admin.vendor_order.index') }}">Trở về</a>
    </div>

@endsection
<script src="{{asset('backend/js/jquery.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".checkBox").click(function () {
            if($(this).is(':checked')) {
                id = $(this).data('id');
                qty = $('#qty_' + id).val();
                price = $('#price_' + id).val();
                $.ajax({ 
                    url: "{{ route('admin.vendor_order.saveSession') }}",
                    type: 'GET',
                    data: {
                        id: id,
                        amount: qty,
                        price: price
                    },
                    // method: 'GET',
                    // dataType: "JSON",
                    success: function(response){
                        
                    }
                });
            }
        });
    });
</script> 
