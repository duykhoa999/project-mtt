<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends AppController
{
    const NAME_PRODUCT = '/product/';
    const NAME_CATEGORY = '/category/';

    public function __construct()
    {
		parent::__construct();
    }

    public function index()
    {
      $products_new = [];

      $data_product = $this->call('/product/', 'GET', ['keyword' => '']);
      if ($data_product !== false) {
          $products_new = json_decode($data_product)->data;
      }

      return view('user.index', compact('products_new'));
    }
}
