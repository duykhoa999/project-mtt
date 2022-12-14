<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdminController extends AppController
{
    public function __construct()
	{
        View::share('controller', config('define.controller.admin.dashboard'));
		parent::__construct();
	}

    public function index() 
    {
        $total_product = 0;

        $data_product = $this->call('/product/', 'GET', ['keyword' => '']);
        if ($data_product !== false) {
            $all_product = json_decode($data_product)->data;
            foreach($all_product as $item) {
                $total_product += $item->amount;
            }
        }

        return view('admin.index', compact('total_product'));
    }
}
