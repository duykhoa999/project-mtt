@extends('admin.layouts.master')
@section('title', "Add Import")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add New Import
            </header>
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
            <div class="panel-body">

                <div class="position-center">
                    <form role="form" action="{{route('admin.import.store')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputCode">Code</label>
                            <input type="text" name="code" value="{{old('code')}}" class="form-control" placeholder="code" required>
                            @if ($errors->has('code'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('code')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Date</label>
                            <input type="date" name="date" value="{{old('date')}}" class="form-control" placeholder="date">
                            @if ($errors->has('date'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('date')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Vendor Order</label>
                            <select name="vendor_order_id" class="form-control input-sm m-bot15">
                                <option value="">Choose Vendor Order</option>
                                @if (!empty($list_vendor_order))
                                    @foreach ($list_vendor_order as $key => $vo)
                                        <option value="{{ $vo->id }}"
                                            {{ old('id') == $vo->id ? 'selected' : '' }}>{{ $vo->code }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('vendor_order_id'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('vendor_order_id')}}</span>
                            @endif
                        </div>
                        <button type="submit" name="add_import" class="btn btn-info">Submit</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.import.index')}}')">Cancel</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
