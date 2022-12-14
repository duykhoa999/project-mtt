@extends('admin.layouts.master')
@section('title', 'Add Staff')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add New Staff
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
                        <form role="form" action="{{ route('admin.user.store') }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputfirst_name">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control"
                                    placeholder="First Name" required>
                                @if ($errors->has('first_name'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputlast_name">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control"
                                    placeholder="Last Name" required>
                                @if ($errors->has('last_name'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone"
                                    class="form-control" />
                                @if ($errors->has('phone'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" value="{{ old('address') }}"
                                    placeholder="Address" class="form-control" />
                                @if ($errors->has('address'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="dob">Birthday</label>
                                <input type="date" name="dob" value="{{ old('dob') }}"
                                    placeholder="Birthday" class="form-control" />
                                @if ($errors->has('dob'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('dob') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="0" checked>&nbsp;Male
                                    </label>
                                    &emsp;&emsp;&emsp;&emsp;
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="1">&nbsp;Female
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Email" class="form-control" />
                                @if ($errors->has('email'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" value="" placeholder="Password"
                                    class="form-control" />
                                @if ($errors->has('password'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" value=""
                                    placeholder="Confirm Password" class="form-control" />
                                @if ($errors->has('password_confirmation'))
                                    <span
                                        style="color: red; font-weight: 700;">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                            <button type="submit" name="add_user" class="btn btn-info">Submit</button>
                            <button type="button" class="btn btn-default"
                                onclick="window.location.assign('{{ route('admin.user.index') }}')">Cancel</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    @endsection
