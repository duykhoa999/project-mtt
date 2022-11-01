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

    public function index() {

        return view('admin.index');
    }
}