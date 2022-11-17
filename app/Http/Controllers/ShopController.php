<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends AppController
{
    const NAME_PRODUCT = '/product/';
    const NAME_CATEGORY = '/category/';

    public function __construct()
    {
		parent::__construct();
    }

    public function index()
    {
        return view('user.shop.index');
    }

    public function detail()
    {
        return view('user.shop.detail');
    }
}
