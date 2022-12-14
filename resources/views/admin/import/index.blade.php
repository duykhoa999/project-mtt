@extends('admin.layouts.master')
@section('title', "List Import")
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                List Import
            </div>
            {{-- <div class="row w3-res-tb">
            <form style="float: right" method="get" action="{{route('admin.order.index')}}" id="filterOrder">
                <div class="group-input f-r">
                    <select name="trang_thai_dh" id="trang-thai-dong-hang">
                        <option value="">Chọn trạng thái đơn hàng</option>
                        <option value="0" <?php //if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 0) echo 'selected';
                        ?>>Chưa duyệt
                        </option>
                        <option value="1" <?php //if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 1) echo 'selected';
                        ?>>Đã duyệt
                        </option>
                        <option value="2" <?php //if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 2) echo 'selected';
                        ?>>Đã phân công nhân viên
                        </option>
                        <option value="3" <?php //if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 3) echo 'selected';
                        ?>>Hoàn tất
                        </option>
                        <option value="4" <?php //if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 4) echo 'selected';
                        ?>>Đã hủy
                        </option>
                    </select>
                </div>

            </form>
        </div> --}}
            <div class="row w3-res-tb">
                <a style="font-size: 18px"><i class="fa fa-plus-circle -aqua"
                        style="float:left; margin-left:5px;cursor: pointer;padding-bottom: 13px"
                        onclick="window.location.assign('{{ route('admin.import.create') }}')"><span
                            style="margin-left: 10px">Create Import</span></i></a>
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

                            <th>No. </th>
                            <th>Code </th>
                            <th>Staff's Name</th>
                            <th>Date Create</th>
                            <th>Order</th>

                            <th style="width:90px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($import_paginate as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>
                                    <a href="{{ route('admin.import.show', ['id' => $item->id]) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        {{ $item->code }}</a>   
                                </td>
                                <td>{{ $item->user->first_name . ' ' . $item->user->last_name }}</td>
                                <td>{{ date('d-M-Y', strtotime($item->date)) }}</td>
                                <td>{{$item->vendorOrder->code}}</td>
                                <td>
                                    <a href="{{ route('admin.import.show', ['id' => $item->id]) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-eye text-success text-active"></i></a>
                                    <a class="active styling-edit"
                                        href="{{ route('admin.import.delete', ['id' => $item->id]) }}"
                                        onclick="event.preventDefault();
                                        window.confirm('Are you sure?') ?
                                        document.getElementById('import-delete-{{ $item->id }}').submit():
                                        0;"><i
                                            class="fa fa-times text-danger text"></i></a>
                                    <form action="{{ route('admin.import.delete', ['id' => $item->id]) }}"
                                        method="post" id="import-delete-{{ $item->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    {{-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {{-- {!! $all_imports->links() !!} --}}
                    </ul>
                </div>
            </div>
        </footer>

    </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        
    </script>
@endsection
