@extends('admin.layouts.master')
@section('title', 'List Product')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Product
            </div>
            {{ csrf_field() }}
            <div class="row w3-res-tb">
                <a style="font-size: 18px"><i class="fa fa-plus-circle -aqua"
                        style="float:left; margin-left:5px;cursor: pointer;padding-bottom: 13px"
                        onclick="window.location.assign('{{ route('admin.product.create') }}')"><span
                            style="margin-left: 10px">Product</span></i></a>
                <form style="float: right" action="{{ route('admin.product.index') }}" method="get">
                    <div class="group-input f-r">
                        <input type="text" name="key_search" value="{{ $key_search ?? '' }}" placeholder="Search">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                No. 
                            </th>
                            <th>Name</th>
                            <!-- <th>Thư viện ảnh</th> -->
                            <th>Image</th>
                            <!-- <th>Tài liệu</th> -->
                            <th>Amount</th>
                            <th>Slug</th>
                            <th>Price</th>
                            <!-- <th>Giá gốc</th> -->
                            <th>Category</th>
                            <th>Vendor</th>

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_product as $key => $pro)
                            <tr>
                                <td><label class="i-checks m-b-none">{{ ($key + 1) }}</td>

                                <td>{{ $pro->name }}</td>
                                <td><img src="/uploads/product/{{ $pro->image }}" height="100px" width="100px"></td>
                                <td>{{ $pro->amount }}</td>
                                <td>{{ $pro->slug }}</td>
                                <td>{{ number_format($pro->price, 0, ',', ',') }}đ</td>
                                <td>{{ $pro->category_id }}</td>
                                <td>{{ $pro->vendor_id }}</td>

                                <td>
                                    <a href="{{ route('admin.product.show', ['id' => $pro->id]) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a class="active styling-edit"
                                        href="{{ route('admin.product.delete', ['id' => $pro->id]) }}"
                                        onclick="event.preventDefault();
                                        window.confirm('Are you sure?') ?
                                        document.getElementById('product-delete-{{ $pro->id }}').submit():
                                        0;"><i
                                            class="fa fa-times text-danger text"></i></a>
                                    <form action="{{ route('admin.product.delete', ['id' => $pro->id]) }}"
                                        method="post" id="product-delete-{{ $pro->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {{-- {!! $all_product->links() !!} --}}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
