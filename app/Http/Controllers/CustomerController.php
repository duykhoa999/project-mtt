<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CustomerController extends AppController
{
    const NAME = '/customer/';

    public function __construct()
    {
        View::share('controller', config('define.controller.admin.customer'));
		parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_customer = [];

        $data = $this->call(self::NAME, 'GET');
        if ($data !== false) {
            $all_customer = json_decode($data)->data;
        }
        $paginate = $this->paginateData($all_customer);
        $customer_paginate = $paginate['final'];
        $url = 'customers';

        return view('admin.customer.index', compact('customer_paginate', 'paginate', 'url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create');
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

        $data = $this->call(self::NAME, 'POST', $param);
        if ($data !== false) {
            return redirect()->route('admin.customer.create')->with('message', "Add customer successfully!");
        }
        return redirect()->route('admin.customer.create')->with('error', "Add customer failed!");
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
        //
    }
}
