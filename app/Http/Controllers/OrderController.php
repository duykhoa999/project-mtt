<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class OrderController extends AppController
{
    const NAME = '/order/';
    public function __construct()
	{
        View::share('controller', config('define.controller.admin.order'));
		parent::__construct();
	}

    public function index() {
        $all_order = [];
        $param['keyword'] = '';

        if (isset($_GET['keyword']))
            $param['keyword'] = $_GET['keyword'];

        $data = $this->call(self::NAME, 'GET', $param);
        if ($data !== false) {
            $all_order = json_decode($data)->data;
        }

        $paginate = $this->paginateData($all_order);
        $order_paginate = $paginate['final'];
        $url = 'orders';

        return view('admin.order.index', compact('all_order', 'order_paginate', 'paginate', 'url', 'param'));
    }

    public function show($orderId = null)
    {
        $order_by_id = [];

        $data = $this->call(self::NAME . $orderId, 'GET', []);
        if ($data !== false) {
            $order_by_id = json_decode($data)->data;
        }

        $order_detail = [];

        $data = $this->call('/order_detail/' . $orderId, 'GET', []);
        if ($data !== false) {
            $order_detail = json_decode($data)->data;
        }

        return view('admin.order.show', compact('order_by_id', 'order_detail'));//->with('order_by_id', $order_by_id)->with('all_user', $all_user)->with('ho_ten_nv', $ho_ten_nv)
    }

    public function update_order_status(Request $request)
    {
        $param = $request->all();
        $order = [];

        $data = $this->call('/order/' . $param['id_pd'], 'GET', []);
        if ($data !== false) {
            $order = json_decode($data)->data;
        }
        if($order->status == 4)
        {
            Session::put('message', 'Đơn hàng đã được khách hàng hủy, không thể xác nhận đơn');
            return redirect()->route('admin.order.index');
        }

        $data = $this->call('/order/updatestatus/' . $param['id_pd'], 'PUT', ['status' => $param['order_status']]);
    }
}
