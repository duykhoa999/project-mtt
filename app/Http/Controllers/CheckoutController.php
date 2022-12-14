<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends AppController
{
    public function index()
    {
        $user = Session::get('user');
        $cart = Session::get('cart')[$user->email ?? []];

        return view('user.checkout.index')->with('user', $user)->with('cart', $cart);
    }

    public function save_checkout_customer(Request $request)
    {
        $param = $request->all();
        $valid = Validator::make(
            $param,
            [
                'receiver_address' => 'required',
                'receiver_name' => 'required',
                'receiver_phone' => 'required|min:10|max:10'
            ],
            [
                'receiver_address.required' => 'Vui lòng nhập địa chỉ',
                'receiver_name.required' => 'Vui lòng nhập tên người nhận',
                'receiver_phone.required' => 'Vui lòng nhập số điện thoại',
                'receiver_phone.max' => 'Số điện thoại gồm 10 số',
                'receiver_phone.min' => 'Số điện thoại gồm 10 số',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
            $user = Session::get('user');
            
            $param['status'] = 0;
            $param['date'] = Carbon::now();

            $param['user_id'] = $user->id;
            $param['created_by'] = $user->id;

            Session::put('total', $request->total);

            $data = $this->call('/order/', 'POST', $param);
            if ($data !== false) {
                $shipping_id = json_decode($data)->data->id;
            }
            Session::put('id_shipping', $shipping_id);

            return redirect()->route('checkout.payment');
    }

    public function payment()
    {
        $data['id_shipping'] = Session::get('id_shipping');
        $user = Session::get('user');
        $cart = Session::get('cart')[$user->email] ?? [];

        $data = $this->call('/order/' . $data['id_shipping'], 'GET', []);
        if ($data !== false) {
            $id_shipping = json_decode($data)->data;
        }
        
        return view('user.checkout.payment')->with('shipping', $id_shipping)->with('cart', $cart);
    }

    public function place_order(Request $request)
    {
        //        insert payment

        //insert order
        $id_pd = Session::get('id_shipping');
        $data = $request->all();
        $total = Session::get('total') ?? 0;
        $user = Session::get('user');
        $cart = Session::get('cart')[$user->email] ?? [];

        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);

        $data = $this->call('/order/' . $id_pd, 'GET', []);
        if ($data !== false) {
            $order = json_decode($data)->data;
        }
        $order->payments = (isset($request->payment_option) && $request->payment_option == 1) ? 0 : 1;
        $order->user_id = $user->id;
        
        $data = $this->call('/order/' . $order->id, 'PUT', $order);

        $param_bill = [
            'code' => $checkout_code,
            'date' => Carbon::now(),
            'total' => $total ?? 0,
            'order_id' => $order->id,
            'user_id' => $user->id
        ];
        $save_bill = $this->call('/bill/', 'POST', $param_bill);

        //insert order_details
        if ($cart == true) {
            foreach ($cart as $key => $cart) {

                $data_product = $this->call('/product/' . $cart['id_products'], 'GET', []);
                if ($data_product !== false) {
                    $product = json_decode($data_product)->data;
                }
                if($product->amount < $cart['product_qty'])
                {
                    Session::put('message', 'Vui lòng chọn số lượng ít hơn'.$product->amount);
                    return redirect()->route('checkout.payment');
                }

                $param_order_detail = [
                    'order_id' => $id_pd,
                    'product_id' => $cart['id_products'],
                    'amount' => $cart['product_qty'],
                    'price' => $cart['product_price'],
                ];
                $save_order_detail = $this->call('/order_detail/', 'POST', $param_order_detail);

                if($save_order_detail)
                {
                    $product->amount = $product->amount - $cart['product_qty'];
                    $product->category_id = $product->category->id;
                    $product->vendor_id = $product->vendor->id;
                    
                    $save_product = $this->call('/product/' . $product->id, 'PUT', $product);
                }
            }
        }
        if(isset($data['data']['orderID']))
        {
            $status = true;
            Session::forget(['cart','id_shipping','total']);
            Session::put('success', 'Đặt hàng thành công, cám ơn quý khách đã tin tưởng!');
            return response()->json(['status'=>$status]);
        }
        else
        {
            if ($request->payment_option == 0) {
                Session::put('message', 'Vui Lòng chọn phương thức thanh toán');
                return redirect()->route('checkout.payment');
            } else {
                Session::forget(['cart','id_shipping','total']);
                return view('user.checkout.handcash');
            }
        }
    }
}
