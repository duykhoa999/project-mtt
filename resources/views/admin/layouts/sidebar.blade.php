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
                    <a href="{{route('admin.import.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.import')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>Import</span>
                    </a>

                </li>
                {{-- <li class="sub-menu">
                    <a href="{{route('admin.manufacture.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.manufacture')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Nhà cung cấp</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.trademark.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.trademark')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.product.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.product')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.coupon.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.coupon')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>Khuyến mãi</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.order.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.order')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>Đơn đặt hàng của khách hàng</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.company_order.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.company_order')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>Đặt hàng từ nhà cung cấp</span>
                    </a>

                </li>
                
                @if (trim(session()->get('user')->ma_nv) == 'NV001')
                    
                    <li class="sub-menu">
                        <a href="{{route('admin.user.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.user')) ? 'active' : ''}}">
                            <i class="fa fa-book"></i>
                            <span>Quản lý Nhân viên</span>
                        </a>

                    </li>
                @endif --}}
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
