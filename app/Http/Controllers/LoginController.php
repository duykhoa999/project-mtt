<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends AppController
{
    const NAME = '/user/';

    public function __construct()
    {
        parent::__construct();
    }

    public function getLogin(Request $req)
    {
        $user = session()->get('user');
        
        if (!empty($user)) {
            return redirect()->route('index');
        }

        $req->session()->put('url_login', url()->previous());

        return view('login.index');
    }

    public function postLogin(Request $req)
    {
        $valid = Validator::make(
            $req->all(),
            [
                'email' => 'required',
                'password' => 'required',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $credentials = array('email' => $req->email, 'password' => $req->password);

            $data_auth = [];
            
            $data = $this->call('/auth/signin', 'POST', $credentials);
            if ($data !== false) {
                $data_auth = json_decode($data)->data;

                session()->put('user', $data_auth->user);
                // Cookie::queue('accessToken', $data_auth->accessToken, 60 * 24);

                return redirect()->route('index');
            }
            
            return redirect()->route('getLogin')->with('message', "Sai tài khoản hoặc mật khẩu! Vui lòng thử lại!");
        }
    }

    public function getLogout()
    {
        session()->forget('user');
        return redirect()->route('index');
    }

    public function getRegister()
    {
        $user = session()->get('user');
        
        if (!empty($user)) {
            return redirect()->route('index');
        }

        return view('login.register');
    }

    public function postRegister(Request $request)
    {
        // $data = $request->all();

        // $data['ma_q'] = 'KH';
        // $min = 002;
        // $max = 999;
        // $data['ma_kh'] =  'kh_'.mt_rand($min,$max);
        // $data['password'] =  Hash::make($data['password']);

        // try {
        //     Customer::create($data)->save();
        // } catch(Exception $e) {
        //     Log::error($e->getMessage());

        //     return redirect()->route('getRegister')->with('error', 'Đăng kí không thành công! Vui lòng thử lại!');
        // }

        // return redirect()->route('getRegister')->with('success', 'Đăng kí thành công! Bạn có thể đăng nhập và mua hàng ngay bây giờ!');
    }
}
