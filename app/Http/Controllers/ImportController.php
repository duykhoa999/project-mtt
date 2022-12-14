<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ImportController extends AppController
{
    const NAME = '/import/';

    public function __construct()
    {
        View::share('controller', config('define.controller.admin.import'));
		parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_import = [];
        $param['keyword'] = '';

        if (isset($_GET['keyword']))
            $param['keyword'] = $_GET['keyword'];

        $data = $this->call(self::NAME, 'GET', $param);
        if ($data !== false) {
            $all_import = json_decode($data)->data;
        }

        $paginate = $this->paginateData($all_import);
        $import_paginate = $paginate['final'];
        $url = 'imports';

        return view('admin.import.index', compact('import_paginate', 'paginate', 'url', 'param'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_vendor_order = [];
        $param['keyword'] = '';

        $data_vendor_order = $this->call('/vendor_order/', 'GET', $param);
        if ($data_vendor_order !== false) {
            $list_vendor_order = json_decode($data_vendor_order)->data;
        }

        return view('admin.import.create', compact('list_vendor_order'));
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

        $valid = Validator::make(
            $param,
            [
                'code' => 'required',
                'vendor_order_id' => 'required',
            ],
            [
                'vendor_order_id.required' => 'Please choose one Vendor Order!'
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {

            $data = $this->call(self::NAME, 'POST', $param);
            if ($data !== false) {
                return redirect()->route('admin.import.create')->with('message', "Add import successfully!");
            }
            return redirect()->route('admin.import.create')->with('error', "Add import failed!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $import = null;

        $data = $this->call(self::NAME . $id, 'GET', []);
        if ($data !== false) {
            $import = json_decode($data)->data;
        }

        if ($import === null) {
            return redirect()->route('admin.import.index')->with('message', "Cannot find this import!");
        }

        // $query = ImportDetail::where('ma_pn',$id)->orderby('ma_pn', 'desc');

        $import_detail = null;

        $data = $this->call('/import_detail/' . $import->id, 'GET', []);
        if ($data !== false) {
            $import_detail = json_decode($data)->data;
        }

        $vendor_order_detail = null;

        $data = $this->call('/vendor_order_detail/' . $import->vendorOrder->id, 'GET', []);
        if ($data !== false) {
            $vendor_order_detail = json_decode($data)->data;
        }

        $list_product_order = [];
        if(!empty($vendor_order_detail)) {
            foreach($vendor_order_detail as $item) {
                $list_product_order[] = $item->product_id->id;
            }
        }
        $session_import = Session::get('import');

        // $company_order = CompanyOrder::where('ma_ddh',$import->ma_ddh)->first();

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

        foreach($product_paginate as $k => $item) {
            if (!in_array($item->id, $list_product_order)) {
                unset($product_paginate[$k]);
            }
        }
        $url = 'import';

        return view('admin.import.show',compact('product_paginate', 'session_import', 'import', 'param', 'import_detail'));
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
        $data = Session::get('import');
        if (empty($data)) {
            $data = [];
        }
        $data[$request->id] = [
            'amount' => $request->amount,
            'price' => $request->price
        ];

        Session::put('import', $data);
        
        return response()->json(['session successfully saved']);
    }

    public function add_detail($id = null)
    {
        $import_session = Session::get('import');
        $error = '';
        
        $import = null;

        $data = $this->call(self::NAME . $id, 'GET', []);
        if ($data !== false) {
            $import = json_decode($data)->data;
        }

        if ($import === null) {
            return redirect()->route('admin.import.index')->with('message', "Cannot find this import!");
        }
        if (!empty($import_session)) {
            foreach($import_session as $k => $item) {
                $data_detail = [
                    'import_id' => $id,
                    'product_id' => $k,
                    'amount' => $item['amount'] ?? 0,
                    'price' => $item['price'] ?? 0,
                ];
                $detail = null;

                $data = $this->call('/import_detail/' . $id . '/' . $k, 'GET', []);
                if ($data !== false) {
                    $detail = json_decode($data)->data;
                }

                $order_detail = null;

                $data = $this->call('/vendor_order_detail/' . $id . '/' . $k, 'GET', []);
                if ($data !== false) {
                    $order_detail = json_decode($data)->data;
                }

                if ($order_detail->amount >= $data_detail['amount']) {    
                    if (empty($detail)) {
                        $product = null;

                        $data = $this->call('/product/' . $data_detail['product_id'], 'GET', []);
                        if ($data !== false) {
                            $product = json_decode($data)->data;
                        }
                        $product->amount += $data_detail['amount'];
                        $product->category_id = $product->category->id;
                        $product->vendor_id = $product->vendor->id;

                        $data = $this->call('/product/' . $data_detail['product_id'], 'PUT', $product);

                        $param = $data_detail;

                        $data = $this->call('/import_detail/', 'POST', $param);
                    }
                    else {
                        $product = null;

                        $data = $this->call('/product/' . $data_detail['product_id'], 'GET', []);
                        if ($data !== false) {
                            $product = json_decode($data)->data;
                        }

                        if ($detail->amount > $data_detail['amount']) {
                            $product->amount -= ($detail->amount - $data_detail['amount']);
                        }
                        else if ($detail->amount < $data_detail['amount']) {
                            $product->amount += ($data_detail['amount'] - $detail->amount);
                        }

                        $product->category_id = $product->category->id;
                        $product->vendor_id = $product->vendor->id;

                        $data = $this->call('/product/' . $data_detail['product_id'], 'PUT', $product);

                        $param = $data_detail;

                        $data = $this->call('/import_detail/' . $id . '/' . $k, 'PUT', $param);
                    }
                    $message = 'Add Import Detail successful!';
                }
                else {
                    $product = null;

                    $data = $this->call('/product/' . $k, 'GET', []);
                    if ($data !== false) {
                        $product = json_decode($data)->data;
                    }

                    $error .= '<div class="alert alert-danger">Please enter quantity for product: ' . $product->name . ' less than or equal ' . $order_detail->amount . '!</div>';
                }
            }
        }

        Session::forget('import');

        return redirect()->route('admin.import.show', ['id' => $id])->with('message_add', $message ?? '')->with('error_add', $error ?? '');
    }
}
