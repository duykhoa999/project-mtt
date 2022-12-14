<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class VendorOrderController extends AppController
{
    const NAME = '/vendor_order/';

    public function __construct()
    {
        View::share('controller', config('define.controller.admin.vendor_order'));
		parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_vendor_order = [];
        $param['keyword'] = '';

        if (isset($_GET['keyword']))
            $param['keyword'] = $_GET['keyword'];

        $data = $this->call(self::NAME, 'GET', $param);
        if ($data !== false) {
            $all_vendor_order = json_decode($data)->data;
        }

        $paginate = $this->paginateData($all_vendor_order);
        $vendor_order_paginate = $paginate['final'];
        $url = 'vendor_order';

        return view('admin.vendor_order.index', compact('vendor_order_paginate', 'paginate', 'url', 'param'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_vendor = [];
        $param['keyword'] = '';

        $data_vendor = $this->call('/vendor/', 'GET', $param);
        if ($data_vendor !== false) {
            $list_vendor = json_decode($data_vendor)->data;
        }

        return view('admin.vendor_order.create', compact('list_vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = session()->get('user');
        $param = $request->all();

        if(empty($param['date'])) {
            $param['date'] = date('Y-m-d');
        }

        $param['user_id'] = $user->id;

        $data = $this->call(self::NAME, 'POST', $param);
        if ($data !== false) {
            return redirect()->route('admin.vendor_order.create')->with('message', "Add Vendor Order successfully!");
        }
        return redirect()->route('admin.vendor_order.create')->with('error', "Add Vendor Order failed!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor_order = null;

        $data = $this->call(self::NAME . $id, 'GET', []);
        if ($data !== false) {
            $vendor_order = json_decode($data)->data;
        }

        $vendor_order_detail = null;

        $data = $this->call('/vendor_order_detail/' . $id, 'GET', []);
        if ($data !== false) {
            $vendor_order_detail = json_decode($data)->data;
        }

        $session_order = Session::get('company_order');
        // $key_search='';

        // $key_search = $request->input('key_search');
        $all_product = [];
        $param['keyword'] = '';

        if (isset($_GET['keyword']))
            $param['keyword'] = $_GET['keyword'];

        $data = $this->call('/product/', 'GET', $param);
        if ($data !== false) {
            $all_product = json_decode($data)->data;
        }

        $paginate = $this->paginateData($all_product);
        $product_paginate = $paginate['final'];
        $url = 'vendor_order';

        return view('admin.vendor_order.show',compact('product_paginate', 'session_order', 'vendor_order', 'vendor_order_detail', 'paginate', 'url', 'param')); //'company_order_detail', 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveSession(Request $request)
    {
        $data = Session::get('company_order');
        if (empty($data)) {
            $data = [];
        }
        $data[$request->id] = [
            'amount' => $request->amount,
            'price' => $request->price
        ];

        Session::put('company_order', $data);
        
        return response()->json(['session successfully saved']);
    }

    public function add_detail($id = null)
    {
        $vendor_order = Session::get('company_order');

        if (!empty($vendor_order)) {
            foreach($vendor_order as $k => $item) {
                $data_detail = [
                    'vendor_order_id' => $id,
                    'product_id' => $k,
                    'amount' => $item['amount'] ?? 0,
                    'price' => $item['price'] ?? 0,
                ];

                $vendor_order_detail = null;

                $data = $this->call('/vendor_order_detail/' . $id . '/' . $k, 'GET', []);
                if ($data !== false) {
                    $vendor_order_detail = json_decode($data)->data;
                }
                if (empty($vendor_order_detail)) {
                    $param = $data_detail;

                    $data = $this->call('/vendor_order_detail/', 'POST', $param);
                }
                else {
                    $param = $data_detail;

                    $call_edit = $this->call('/vendor_order_detail/' . $id . '/' . $k, 'PUT', $param);
                }
            }
        }

        Session::forget('company_order');

        return redirect()->route('admin.vendor_order.show', ['id' => $id])->with('message_add', 'Add detail successful!');
    }
}
