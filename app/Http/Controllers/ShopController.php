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
        $all_product = [];
        $param['keyword'] = '';

        if (isset($_GET['keyword']))
            $param['keyword'] = $_GET['keyword'];

        $data = $this->call(self::NAME_PRODUCT, 'GET', $param);
        if ($data !== false) {
            $all_product = json_decode($data)->data;
        }

        // $paginate = $this->paginateData($all_product);
        // $product_paginate = $paginate['final'];
        // $url = 'products';

        return view('user.shop.index', compact('all_product'));
    }

    public function detail($id)
    {
        $product = null;

        $data_product = $this->call(self::NAME_PRODUCT . $id, 'GET', []);
        if ($data_product !== false) {
            $product = json_decode($data_product)->data;
        }

        return view('user.shop.detail', compact('product'));
    }
}
