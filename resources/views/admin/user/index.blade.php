@extends('admin.layouts.master')
@section('title', "List Staff")
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Staffs
            </div>

            {{ csrf_field() }}
            <div class="row w3-res-tb">
                <a style="font-size: 18px"><i class="fa fa-plus-circle -aqua"
                    style="float:left; margin-left:5px;cursor: pointer;padding-bottom: 13px"
                    onclick="window.location.assign('{{ route('admin.user.create') }}')"><span style="margin-left: 10px">Staff</span></i></a>
                <form style="float: right" action="{{ route('admin.user.index') }}" method="get">
                    <div class="group-input f-r">
                        <input type="text" name="keyword" value="{{ $param['keyword'] ?? '' }}">
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
                            <th>No. </th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Birthday</th>
                            <th>Phone</th>
                            {{-- <th style="width:30px;">Hành động</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user_paginate as $key => $row)
                            @if ($row->role->id == 2)
                                @continue;
                            @endif
                            <tr>
                                <td><label class="i-checks m-b-none">{{ ($key+1) }}</td>
                                <td>{{ $row->first_name . ' ' . $row->last_name }}</td>
                                <td>{{ $row->address }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ date('d-M-Y', strtotime($row->dob)) }}</td>
                                <td>{{ $row->phone }}</td>
                                {{-- <td>
                                    <a href="{{ route('admin.customer.show', ['id' => $row->ma_kh]) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a class="active styling-edit"
                                        href="{{ route('admin.customer.delete', ['id' => $row->ma_kh]) }}"
                                        onclick="event.preventDefault();
                                        window.confirm('Bạn có chắc là muốn xóa loại rượu này không?') ?
                                        document.getElementById('customer-delete-{{ $row->ma_kh }}').submit():
                                        0;"><i
                                            class="fa fa-times text-danger text"></i></a>
                                    <form action="{{ route('admin.customer.delete', ['id' => $row->ma_kh]) }}"
                                        method="post" id="customer-delete-{{ $row->ma_kh }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        {{-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            @include('admin.layouts.pagination')
                            {{-- {!! $all_customer->links() !!} --}}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
