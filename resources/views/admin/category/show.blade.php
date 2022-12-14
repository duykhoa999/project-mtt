@extends('admin.layouts.master')
@section('title', "Edit Category")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Edit Category
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
                    <form role="form" action="{{route('admin.category.edit', $category->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="exampleInputCode">Code</label>
                            <input type="text" name="code" value="{{old('code') ?? $category->code}}" class="form-control" readonly="true" placeholder="code" required>
                            @if ($errors->has('code'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('code')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Name</label>
                            <input type="text" name="name" value="{{old('name') ?? $category->name}}" class="form-control" placeholder="Name" required onkeyup="ChangeToSlug();" id="slug">
                            @if ($errors->has('name'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSlug">Slug</label>
                            <input type="text" name="slug" value="{{old('slug') ?? $category->slug}}" class="form-control" id="convert_slug">
                            @if ($errors->has('slug'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('slug')}}</span>
                            @endif
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Submit</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.category.index')}}')">Cancel</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
