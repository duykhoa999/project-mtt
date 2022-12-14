@extends('admin.layouts.master')
@section('title', "List Vendor")
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                List Vendor
            </div>

            {{ csrf_field() }}
            <div class="row w3-res-tb">
                <a style="font-size: 18px"><i class="fa fa-plus-circle -aqua"
                        style="float:left; margin-left:5px;cursor: pointer;padding-bottom: 13px"
                        onclick="window.location.assign('{{ route('admin.vendor.create') }}')"><span style="margin-left: 10px">Vendor</span></i></a>
                <form style="float: right" action="{{ route('admin.vendor.index') }}" method="get">
                    <div class="group-input f-r">
                        <input type="text" name="keyword" value="{{ $param['keyword'] ?? '' }}" placeholder="Search">
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
                            <th>No.</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th style="width:30px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendor_paginate as $key => $row)
                            <tr>
                                <td><label class="i-checks m-b-none">{{ ($key + 1) }}</td>
                                <td>{{ $row->first_name . ' ' . $row->last_name }}</td>
                                <td>{{ $row->address }}</td>
                                <td>{{ $row->email }}</td>
                                <td>
                                    <a href="{{ route('admin.vendor.show', ['id' => $row->id]) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a class="active styling-edit"
                                        href="{{ route('admin.vendor.delete', ['id' => $row->id]) }}"
                                        onclick="event.preventDefault();
                                        window.confirm('Are you sure you want to delete this vendor?') ?
                                        document.getElementById('vendor-delete-{{ $row->id }}').submit():
                                        0;"><i
                                            class="fa fa-times text-danger text"></i></a>
                                    <form action="{{ route('admin.vendor.delete', ['id' => $row->id]) }}"
                                        method="post" id="vendor-delete-{{ $row->id }}">
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
                        {{-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {{-- {!! $all_vendor->links() !!} --}}
                            @include('admin.layouts.pagination')
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
