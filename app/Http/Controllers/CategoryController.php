<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CategoryController extends AppController
{
    const NAME = '/category/';

    public function __construct()
    {
        View::share('controller', config('define.controller.admin.category'));
		parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_category = [];
        $param['keyword'] = '';

        if (isset($_GET['keyword']))
            $param['keyword'] = $_GET['keyword'];

        $data = $this->call(self::NAME, 'GET', $param);
        if ($data !== false) {
            $all_category = json_decode($data)->data;
        }

        $paginate = $this->paginateData($all_category);
        $category_paginate = $paginate['final'];
        $url = 'categories';

        return view('admin.category.index', compact('all_category', 'category_paginate', 'paginate', 'url', 'param'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $data = $this->call(self::NAME, 'POST', $param);
            if ($data !== false) {
                return redirect()->route('admin.category.create')->with('message', "Add category successfully!");
            }
            return redirect()->route('admin.category.create')->with('error', "Add category failed!");
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
        $category = null;

        $data = $this->call(self::NAME . $id, 'GET', []);
        if ($data !== false) {
            $category = json_decode($data)->data;
        }

        if(empty($category)) {
            return redirect()->route('admin.category.index')->with('error', "Cannot find this category! Please, try again!");
        }

        return view('admin.category.show', compact('category'));
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

        $category = null;

        $data_category = $this->call(self::NAME . $id, 'GET', []);
        if ($data_category !== false) {
            $category = json_decode($data_category)->data;
        }

        if(empty($category)) {
            return redirect()->route('admin.category.index')->with('error', "Cannot find this category! Please, try again!");
        }

        $valid = Validator::make(
            $param,
            [
                'code' => 'required',
                'name' => 'required',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $call_edit = $this->call(self::NAME . $id, 'PUT', $param);
            if ($call_edit !== false) {
                return redirect()->route('admin.category.edit', ['id' => $id])->with('message', "Edit category successfully!");
            }
            return redirect()->route('admin.category.edit', ['id' => $id])->with('error', "Edit category failed!");
        }
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
            return redirect()->route('admin.category.index')->with('message', "Delete category successfully!");
        }
        return redirect()->route('admin.category.index')->with('error', "Delete category failed!");
    }
}
