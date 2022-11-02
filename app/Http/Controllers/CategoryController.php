<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $data = $this->call(self::NAME, 'GET');
        if ($data !== false) {
            $all_category = json_decode($data)->data;
        }

        $paginate = $this->paginateData($all_category);
        $category_paginate = $paginate['final'];
        $url = 'categories';

        return view('admin.category.index', compact('all_category', 'category_paginate', 'paginate', 'url'));
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

        $data = $this->call(self::NAME, 'POST', $param);
        if ($data !== false) {
            return redirect()->route('admin.category.create')->with('message', "Add category successfully!");
        }
        return redirect()->route('admin.category.create')->with('error', "Add category failed!");
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
            return redirect()->route('admin.category.index')->with('message', "Delete category successfully!");
        }
        return redirect()->route('admin.category.index')->with('error', "Delete category failed!");
    }
}
