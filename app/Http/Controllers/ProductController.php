<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ProductController extends AppController
{
    const NAME = '/product/';

    public function __construct()
    {
        View::share('controller', config('define.controller.admin.product'));
		parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_product = [];
        $param['keyword'] = '';

        if (isset($_GET['keyword']))
            $param['keyword'] = $_GET['keyword'];

        $data = $this->call(self::NAME, 'GET', $param);
        if ($data !== false) {
            $all_product = json_decode($data)->data;
        }

        $paginate = $this->paginateData($all_product);
        $product_paginate = $paginate['final'];
        $url = 'products';

        return view('admin.product.index', compact('product_paginate', 'paginate', 'url', 'param'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_category = [];
        $list_vendor = [];
        $param['keyword'] = '';

        $data_category = $this->call('/category/', 'GET', $param);
        if ($data_category !== false) {
            $list_category = json_decode($data_category)->data;
        }
        $data_vendor = $this->call('/vendor/', 'GET', $param);
        if ($data_vendor !== false) {
            $list_vendor = json_decode($data_vendor)->data;
        }

        return view('admin.product.create', compact('list_category', 'list_vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->all();
        $valid = Validator::make(
            $param,
            [
                'code' => 'required',
                'name' => 'required',
                'amount' => 'required',
                'price' => 'required',
                'image' => 'required',
                'category_id' => 'required',
                'vendor_id' => 'required',
            ],
            [
                'vendor_id.required' => 'Please choose one Vendor!',
                'category_id.required' => 'Please choose one Category!',
                'image.required' => 'Please choose one image!',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $param['image'] = base64_encode(file_get_contents($request->file('image')));

            $data = $this->call(self::NAME, 'POST', $param);
            if ($data !== false) {
                return redirect()->route('admin.product.create')->with('message', "Add product successfully!");
            }
            return redirect()->route('admin.product.create')->with('error', "Add product failed!");
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
        $product = null;

        $list_category = [];
        $list_vendor = [];
        $param['keyword'] = '';

        $data_category = $this->call('/category/', 'GET', $param);
        if ($data_category !== false) {
            $list_category = json_decode($data_category)->data;
        }
        $data_vendor = $this->call('/vendor/', 'GET', $param);
        if ($data_vendor !== false) {
            $list_vendor = json_decode($data_vendor)->data;
        }
        

        $data = $this->call(self::NAME . $id, 'GET', []);
        if ($data !== false) {
            $product = json_decode($data)->data;
        }

        if(empty($product)) {
            return redirect()->route('admin.product.index')->with('error', "Cannot find this product! Please, try again!");
        }

        return view('admin.product.show', compact('product', 'list_vendor', 'list_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $param = $request->all();

        $product = null;

        $data_product = $this->call(self::NAME . $id, 'GET', []);
        if ($data_product !== false) {
            $product = json_decode($data_product)->data;
        }

        if(empty($product)) {
            return redirect()->route('admin.product.index')->with('error', "Cannot find this product! Please, try again!");
        }

        $valid = Validator::make(
            $param,
            [
                'code' => 'required',
                'name' => 'required',
                'amount' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'vendor_id' => 'required',
            ],
            [
                'vendor_id.required' => 'Please choose one Vendor!',
                'category_id.required' => 'Please choose one Category!',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            if (!empty($request->file('image'))) {
                $param['image'] = base64_encode(file_get_contents($request->file('image')));
            }
            else {
                $param['image'] = $product->image;
            }
            $call_edit = $this->call(self::NAME . $id, 'PUT', $param);
            if ($call_edit !== false) {
                return redirect()->route('admin.product.edit', ['id' => $id])->with('message', "Edit product successfully!");
            }
            return redirect()->route('admin.product.edit', ['id' => $id])->with('error', "Edit product failed!");
        }
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
        $data = $this->call(self::NAME . $id, 'DELETE');

        if ($data !== false) {
            return redirect()->route('admin.product.index')->with('message', "Delete product successfully!");
        }
        return redirect()->route('admin.product.index')->with('error', "Delete product failed!");
    }
}
