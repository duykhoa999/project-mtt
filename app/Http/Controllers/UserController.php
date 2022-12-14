<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class UserController extends AppController
{
    const NAME = '/user/';

    public function __construct()
    {
        View::share('controller', config('define.controller.admin.user'));
		parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_user = [];
        $param['keyword'] = '';

        if (isset($_GET['keyword']))
            $param['keyword'] = $_GET['keyword'];

        $data = $this->call(self::NAME, 'GET', $param);
        if ($data !== false) {
            $all_user = json_decode($data)->data;
        }
        $paginate = $this->paginateData($all_user);
        $user_paginate = $paginate['final'];
        $url = 'users';

        return view('admin.user.index', compact('user_paginate', 'paginate', 'url', 'param'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
                'dob' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $param['password'] = Hash::make($param['password']);
            $param['role_id'] = 1;
            $data = $this->call(self::NAME, 'POST', $param);
            if ($data !== false) {
                return redirect()->route('admin.user.create')->with('message', "Add user successfully!");
            }
            return redirect()->route('admin.user.create')->with('error', "Add user failed!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Session::get('user');

        // $history_order = Order::where('ma_kh', '=', $user->ma_kh)->with(['order_details','bills'])->orderby('id_pd', 'desc')->paginate(5);
        $history_order = [];
        // $user = Customer::find($user->ma_kh);

        return view('user.user_detail', compact('user', 'history_order')); //->with('history_order', $history_order)
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

    public function change_password($id)
    {
        //
    }

    
}
