@extends('admin.layouts.master')
@section('title', 'Edit Product')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit Product
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
                        <form role="form" action="{{ route('admin.product.edit', ['id' => $product->id]) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-group">
                                <label for="exampleInputCode">Code</label>
                                <input type="text" data-validation="length" value="{{ old('code') ?? $product->code }}"
                                    data-validation-length="min10"
                                    readonly="true"
                                    data-validation-error-msg="Please enter at least 10 characters!" name="code"
                                    class="form-control"
                                    onkeyup="ChangeToSlug();">
                                @if ($errors->has('code'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" data-validation="length" value="{{ old('name') ?? $product->name }}"
                                    data-validation-length="min10"
                                    data-validation-error-msg="Please enter at least 10 characters!" name="name"
                                    class="form-control " id="slug"
                                    onkeyup="ChangeToSlug();">
                                @if ($errors->has('name'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Amount</label>
                                <input type="number" data-validation="number" value="{{ old('amount') ?? $product->amount }}"
                                    data-validation-error-msg="Please enter Amount!" name="amount" class="form-control"
                                    id="exampleInputEmail1" placeholder="Điền số lượng">
                                @if ($errors->has('amount'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('amount') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug') ?? $product->slug }}"
                                    id="convert_slug" placeholder="">
                                @if ($errors->has('slug'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" data-validation="length" value="{{ old('price') ?? $product->price }}"
                                    data-validation-length="min5" data-validation-error-msg="Please enter Price!"
                                    name="price" class="form-control price_format" id="price"
                                    placeholder="Điền giá sản phẩm">
                                @if ($errors->has('price'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" name="image" class="form-control" id="exampleInputEmail1">
                                <img src="data:image/png;base64, {{$product->image}}" height="100" width="100">
                                @if ($errors->has('image'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="description" id="ckeditor1"
                                    placeholder="Mô tả sản phẩm">{{ old('description') ?? $product->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category</label>
                                <select name="category_id" class="form-control input-sm m-bot15">
                                    <option value="">Choose Category</option>
                                    @if (!empty($list_category))
                                        @foreach ($list_category as $key_cate => $cate)
                                            <option value="{{ $cate->id }}"
                                                {{  $product->category->id == $cate->id ? 'selected' : '' }}>{{ $cate->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Vendor</label>
                                <select name="vendor_id" class="form-control input-sm m-bot15">
                                    <option value="">Choose Vendor</option>
                                    @if (!empty($list_vendor))
                                        @foreach ($list_vendor as $key_vendor => $vendor)
                                            <option value="{{ $vendor->id }}"
                                                {{ $product->vendor->id == $vendor->id ? 'selected' : '' }}>{{ $vendor->first_name . ' ' . $vendor->last_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <button type="submit" name="add_product" class="btn btn-info">Submit</button>
                            <button type="button" class="btn btn-default"
                                onclick="window.location.assign('{{ route('admin.product.index') }}')">Cancel</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    @endsection
