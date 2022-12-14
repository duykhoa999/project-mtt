@extends('admin.layouts.master')
@section('title', "Edit Vendor")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Edit Vendor
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
                    <form role="form" action="{{route('admin.vendor.edit', ['id' => $vendor->id])}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="exampleInputFirstName">First Name</label>
                            <input type="text" name="first_name" value="{{old('first_name') ?? $vendor->first_name}}" class="form-control" placeholder="First Name" required>
                            @if ($errors->has('first_name'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('first_name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputLastName">Last Name</label>
                            <input type="text" name="last_name" value="{{old('last_name') ?? $vendor->last_name}}" class="form-control" placeholder="Last Name" required>
                            @if ($errors->has('last_name'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('last_name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAddress">Address</label>
                            <input type="text" name="address" value="{{old('address') ?? $vendor->address}}" class="form-control" required>
                            @if ($errors->has('address'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('address')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="email" value="{{old('email') ?? $vendor->email}}" class="form-control" required>
                            @if ($errors->has('email'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <button type="submit" name="add_vendor" class="btn btn-info">Submit</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.vendor.index')}}')">Cancel</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
