<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $data = $this->call(self::NAME, 'GET');
        if ($data !== false) {
            $all_product = json_decode($data)->data;
        }

        $paginate = $this->paginateData($all_product);
        $product_paginate = $paginate['final'];
        $url = 'products';

        return view('admin.product.index', compact('product_paginate', 'paginate', 'url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_category = [];
        $list_vendor = [
            0 => (object)[
                'id' => 1,
                'name' => 'Bùi Duy Khoa'
            ],
            1 => (object)[
                'id' => 2,
                'name' => 'Duy Khoa'
            ]
        ];
        $data_category = $this->call('/category/', 'GET');
        if ($data_category !== false) {
            $list_category = json_decode($data_category)->data;
        }
        $data_vendor = $this->call('/vendor/', 'GET');
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
        $param['image'] = base64_encode(file_get_contents($request->file('image')));

        $data = $this->call(self::NAME, 'POST', $param);
        if ($data !== false) {
            return redirect()->route('admin.product.create')->with('message', "Add product successfully!");
        }
        return redirect()->route('admin.product.create')->with('error', "Add product failed!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $data = $this->call(self::NAME . $id, 'DELETE');

        if ($data !== false) {
            return redirect()->route('admin.product.index')->with('message', "Delete product successfully!");
        }
        return redirect()->route('admin.product.index')->with('error', "Delete product failed!");
    }
}
