@extends('admin.layouts.master')
@section('admin_content')
<div class="container-fluid">
    <style type="text/css">
        p.title_thongke {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
    <div class="row">
        <p class="title_thongke">Thống kê đơn hàng doanh số</p>

        <form autocomplete="off">
            @csrf

            <div class="col-md-2">
                <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả"></p>
            </div>

            <div class="col-md-2">
                <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>

            </div>

            <div class="col-md-2" style="float: right;">
                <p>
                    Thống kê:
                    <select class="dashboard-filter form-control">
                        <option>--Chọn--</option>
                        <option value="homnay">Trong hôm Nay</option>
                        <option value="7ngay">Trong 7 ngày qua</option>
                        <option value="thangtruoc">Trong 1 tháng trước</option>
                        <option value="thangnay">Trong tháng hiện tại</option>
                        <option value="quy">Trong 1 quý</option>
                        <option value="365ngayqua">Trong 1 năm</option>
                    </select>
                </p>
            </div>

        </form>
        <div class="col-md-12">
            <div id="chart" style="height: 200px; color: red;"></div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <p class="title_thongke ">Thống kê trạng thái đơn hàng</p>
            <div style="display: flex;">
                <div class="col-md-4 col-xs-12 justify-content-center">
                    <div id="donut-example"></div>
                </div>
                <div class="col-md-4 col-xs-12" style="padding-top:8rem">
                    <div><i class="fas fa-circle" style="color:#F11142;"></i> <span style="font-weight: 700;"> : Chưa Duyệt </span></div>
                    <div><i class="fas fa-circle" style="color:#4211F1;"></i> <span style="font-weight: 700;"> : Đã Duyệt</span></div>
                    <div><i class="fas fa-circle" style="color:#11DBF1;"></i> <span style="font-weight: 700;"> : Đã Phân công nhân viên</span></div>
                    <div><i class="fas fa-circle" style="color:#11F137;"></i> <span style="font-weight: 700;"> : Hoàn tất</span></div>
                    <div><i class="fas fa-circle" style="color:#F1E611;"></i> <span style="font-weight: 700;"> : Đã hủy</span></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <p class="title_thongke">Tổng sản phẩm tồn</p>
            <div id="donut-product"></div>
        </div>
    </div>
    @endsection
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

    <script src="{{asset('backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('backend/js/scripts.js')}}"></script>
    <script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('backend/js/jquery.form-validator.min.js')}}"></script>
    <script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- // thống kê trạng thái đơn hàng -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Morris.Donut({
            //     element: 'donut-example',
            //     resize: true,
            //     colors: ['#F11142', '#4211F1', '#11DBF1', '#11F137', '#F1E611'],

            //     data: [{
            //             label: "Đơn Hàng Mới ",
            //             value: <?php echo $order1 ?? '' ?>
            //         },
            //         {
            //             label: "Đã duyệt",
            //             value: <?php echo $order2 ?? '' ?>
            //         },
            //         {
            //             label: "Phân công nhân viên",
            //             value: <?php echo $order3 ?? '' ?>
            //         },
            //         {
            //             label: "Hoàn tất",
            //             value: <?php echo $order4 ?? '' ?>
            //         },
            //         {
            //             label: "Hủy Hàng",
            //             value: <?php echo $order5 ?? '' ?>
            //         }
            //     ]
            // });
            Morris.Donut({
                element: 'donut-product',
                resize: true,
                colors: ['#F11142', '#4211F1', '#11DBF1', '#11F137', '#F1E611'],
                data: [{
                    label: "Tổng Sản Phẩm ",
                    value: <?php echo $total_product ?? '' ?>
                }]
            });
        });
    </script>
