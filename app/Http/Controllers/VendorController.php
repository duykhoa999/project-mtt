<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class VendorController extends AppController
{
    const NAME = '/vendor/';

    public function __construct()
    {
        View::share('controller', config('define.controller.admin.vendor'));
		parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_vendor = [];
        $param['keyword'] = '';

        if (isset($_GET['keyword']))
            $param['keyword'] = $_GET['keyword'];

        $data = $this->call(self::NAME, 'GET', $param);
        if ($data !== false) {
            $all_vendor = json_decode($data)->data;
        }

        $paginate = $this->paginateData($all_vendor);
        $vendor_paginate = $paginate['final'];
        $url = 'vendors';

        return view('admin.vendor.index', compact('vendor_paginate', 'paginate', 'url', 'param'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.create');
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
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'email' => 'required',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {

            $data = $this->call(self::NAME, 'POST', $param);
            if ($data !== false) {
                return redirect()->route('admin.vendor.create')->with('message', "Add vendor successfully!");
            }
            return redirect()->route('admin.vendor.create')->with('error', "Add vendor failed!");
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
        $vendor = null;

        $data = $this->call(self::NAME . $id, 'GET', []);
        if ($data !== false) {
            $vendor = json_decode($data)->data;
        }

        if(empty($vendor)) {
            return redirect()->route('admin.vendor.index')->with('error', "Cannot find this vendor! Please, try again!");
        }

        return view('admin.vendor.show', compact('vendor'));
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

        $vendor = null;

        $data_vendor = $this->call(self::NAME . $id, 'GET', []);
        if ($data_vendor !== false) {
            $vendor = json_decode($data_vendor)->data;
        }

        if(empty($vendor)) {
            return redirect()->route('admin.vendor.index')->with('error', "Cannot find this vendor! Please, try again!");
        }

        $valid = Validator::make(
            $param,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'email' => 'required',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {

            $call_edit = $this->call(self::NAME . $id, 'PUT', $param);
            if ($call_edit !== false) {
                return redirect()->route('admin.vendor.edit', ['id' => $id])->with('message', "Edit vendor successfully!");
            }
            return redirect()->route('admin.vendor.edit', ['id' => $id])->with('error', "Edit vendor failed!");
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
            return redirect()->route('admin.vendor.index')->with('message', "Delete vendor successfully!");
        }
        return redirect()->route('admin.vendor.index')->with('error', "Delete vendor failed!");
    }
}
