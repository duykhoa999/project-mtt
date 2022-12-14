<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends AppController
{
    const NAME_PRODUCT = '/product/';
    const NAME_CATEGORY = '/category/';

    public function __construct()
    {
		parent::__construct();
    }

    public function index()
    {
        $user = session()->get('user');
        
        $cart = Session::get('cart')[$user->email] ?? [];

        return view('user.cart.index', compact('cart'));
    }

    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        $user = Session::get('user');
        
        if ($cart !== null && !empty($cart[$user->email])) {
            $is_avaiable = 0;
            foreach ($cart[$user->email] as $key => $val) {
                if ($val['id_products'] == $data['cart_product_id']) {
                    $is_avaiable++;
                    $cart[$user->email][$key] = array(
                        'session_id' => $session_id,
                        'product_name' => $data['cart_product_name'],
                        'id_products' => $data['cart_product_id'],
                        'product_image' => $data['cart_product_image'],
                        'product_quantity' => $data['cart_product_quantity'],
                        'product_qty' => $val['product_qty'] + $data['cart_product_qty'],
                        'product_price' => $data['cart_product_price'],
                    );
                    if ($cart[$user->email][$key]['product_quantity'] >= $cart[$user->email][$key]['product_qty']) {
                        Session::put('cart', $cart);
                    } else {
                        alert('Please choose less than or equal ' + $cart[$user->email][$key]['product_quantity']);
                    }
                }
            }
            if ($is_avaiable == 0) {
                $cart[$user->email][] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'id_products' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[$user->email][] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'id_products' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
        }
        Session::put('cart', $cart);
        
        Session::save();
    }

    public function del_cart($session_id = null)
    {
        $user = Session::get('user');
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart[$user->email] as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$user->email][$key]);
                    break;
                }
            }
            Session::put('cart', $cart);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        $user = Session::get('user');
        if ($cart == true) {
            $message = '';

            foreach ($data['cart_qty'] as $key => $qty) {
                $i = 0;
                foreach ($cart[$user->email] as $session => $val) {
                    $i++;
                    $product = $this->getProduct($cart[$user->email][$session]['id_products']);
                    if ($product) {
                        if ($val['session_id'] == $key && $qty <= $product->amount) {

                            $cart[$user->email][$session]['product_qty'] = $qty;
                            $message .= '<div class="alert alert-success">Cập nhật số lượng sản phẩm: ' . $cart[$user->email][$session]['product_name'] . ' thành công!.</div>';
                        } elseif ($val['session_id'] == $key && $qty >= $product->amount) {
                            $message .= '<div class="alert alert-danger">Cập nhật số lượng sản phẩm: ' . $cart[$user->email][$session]['product_name'] . ' thất bại. Số lượng tồn không đủ.</br>Vui lòng nhập số lượng nhỏ hơn hoặc bằng ' . $product->amount . '!</div>';
                        }
                    }
                }
            }

            Session::put('cart', $cart);
            return redirect()->back()->with('message', $message);
        } else {
            return redirect()->back();
        }
    }

    private function getProduct($productId = null) {
      $product = null;
      $data = $this->call('/product/' . $productId, 'GET', []);
        if ($data !== false) {
            $product = json_decode($data)->data;
      }

      return $product;
    }
}
