<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                 <li>
                    <a class="{{(isset($controller) && $controller == config('define.controller.admin.dashboard')) ? 'active' : ''}}" href="{{route('admin.index')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.category.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.category')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Category</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.customer.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.customer')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Customer</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.user.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.user')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Staff</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.import.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.import')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>Import</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.product.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.product')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Product</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.vendor.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.vendor')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Vendor</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.vendor_order.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.vendor_order')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Vendor Order</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.order.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.order')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Customer Order</span>
                    </a>

                </li>
                {{-- <li class="sub-menu">
                    <a href="{{route('admin.manufacture.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.manufacture')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Nh?? cung c???p</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.trademark.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.trademark')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Th????ng hi???u s???n ph???m</span>
                    </a>

                </li>
                
                <li class="sub-menu">
                    <a href="{{route('admin.coupon.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.coupon')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>Khuy???n m??i</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.order.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.order')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>????n ?????t h??ng c???a kh??ch h??ng</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.company_order.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.company_order')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>?????t h??ng t??? nh?? cung c???p</span>
                    </a>

                </li>
                
                @if (trim(session()->get('user')->ma_nv) == 'NV001')
                    
                    <li class="sub-menu">
                        <a href="{{route('admin.user.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.user')) ? 'active' : ''}}">
                            <i class="fa fa-book"></i>
                            <span>Qu???n l?? Nh??n vi??n</span>
                        </a>

                    </li>
                @endif --}}
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
