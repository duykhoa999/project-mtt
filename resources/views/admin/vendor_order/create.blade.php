@extends('admin.layouts.master')
@section('title', "Add Vendor Order")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add New Vendor Order
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
                    <form role="form" action="{{route('admin.vendor_order.store')}}" method="post" enctype="multipart/form-data">
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
                            <label for="exampleInputPassword1">Vendor</label>
                            <select name="vendor_id" class="form-control input-sm m-bot15">
                                <option value="">Choose Vendor</option>
                                @if (!empty($list_vendor))
                                    @foreach ($list_vendor as $key => $vd)
                                        <option value="{{ $vd->id }}"
                                            {{ old('id') == $vd->id ? 'selected' : '' }}>{{ $vd->first_name . ' ' . $vd->last_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="add_vendor_order" class="btn btn-info">Submit</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.vendor_order.index')}}')">Cancel</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
