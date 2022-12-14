<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'admin'], function() {
    // Admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/filter-by-date', [AdminController::class, 'filter_by_date'])->name('filter-by-date');
        Route::get('/dashboard-filter', [AdminController::class, 'dashboard_filter'])->name('dashboard-filter');
        Route::get('/days-order', [AdminController::class, 'days_order'])->name('days-order');

        Route::post('/update-order-status', [OrderController::class, 'update_order_status'])->name('order.update-order-status');

        //Category
        Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::put('/categories/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

        //Customer
        Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/customers/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('/customers', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customer.show');
        Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');

        //Import
        Route::get('/imports', [ImportController::class, 'index'])->name('import.index');
        Route::get('/imports/create', [ImportController::class, 'create'])->name('import.create');
        Route::post('/imports', [ImportController::class, 'store'])->name('import.store');
        Route::get('/imports/{id}', [ImportController::class, 'show'])->name('import.show');
        Route::put('/imports/{id}', [ImportController::class, 'edit'])->name('import.edit');
        Route::delete('/imports/{id}', [ImportController::class, 'destroy'])->name('import.delete');
        Route::post('/imports/add_detail/{id}', [ImportController::class, 'add_detail'])->name('import.add_detail');
        Route::get('/saveSession/imports', [ImportController::class, 'saveSession'])->name('import.saveSession');

        //Product
        Route::get('/products', [ProductController::class, 'index'])->name('product.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/products', [ProductController::class, 'store'])->name('product.store');
        Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
        Route::put('/products/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.delete');

        //Vendor
        Route::get('/vendors', [VendorController::class, 'index'])->name('vendor.index');
        Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendor.create');
        Route::post('/vendors', [VendorController::class, 'store'])->name('vendor.store');
        Route::get('/vendors/{id}', [VendorController::class, 'show'])->name('vendor.show');
        Route::put('/vendors/{id}', [VendorController::class, 'edit'])->name('vendor.edit');
        Route::delete('/vendors/{id}', [VendorController::class, 'destroy'])->name('vendor.delete');

        //Vendor Order
        Route::get('/vendor_order', [VendorOrderController::class, 'index'])->name('vendor_order.index');
        Route::get('/vendor_order/create', [VendorOrderController::class, 'create'])->name('vendor_order.create');
        Route::post('/vendor_order', [VendorOrderController::class, 'store'])->name('vendor_order.store');
        Route::get('/vendor_order/{id}', [VendorOrderController::class, 'show'])->name('vendor_order.show');
        Route::put('/vendor_order/{id}', [VendorOrderController::class, 'edit'])->name('vendor_order.edit');
        Route::delete('/vendor_order/{id}', [VendorOrderController::class, 'destroy'])->name('vendor_order.delete');
        Route::get('/saveSession/vendor_order', [VendorOrderController::class, 'saveSession'])->name('vendor_order.saveSession');
        Route::post('/vendor_order/add_detail/{id}', [VendorOrderController::class, 'add_detail'])->name('vendor_order.add_detail');

        //User
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users', [UserController::class, 'store'])->name('user.store');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');
        Route::put('/users/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.delete');

        //Order
        Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('order.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
        Route::get('/orders/{orderId}', [OrderController::class, 'show'])->name('order.show');
        Route::put('/orders/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::delete('/orders/{id}', [OrderController::class, 'delete'])->name('order.delete');
        Route::post('/set-employee-order', [OrderController::class, 'set_employee_order'])->name('order.set-employee-order');
        Route::post('/update-order-status', [OrderController::class, 'update_order_status'])->name('order.update-order-status');
    });
});    

Route::group(['middleware' => 'customer'], function() {
    // User
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::group(['prefix' => 'shop', 'as' => 'shop.'], function() {
        Route::get('/', [ShopController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('show-detail-product');
    });

    Route::group(['middleware' => 'login'], function() {
        Route::group(['prefix' => 'cart', 'as' => 'cart.'], function() {
            Route::get('/', [CartController::class, 'index'])->name('index');
        });
        Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax'])->name('add_cart_ajax');
        Route::post('/update-cart', [CartController::class, 'update_cart'])->name('update_cart');
        Route::get('/delete-cart/{session_id}', [CartController::class, 'del_cart'])->name('del_cart');

        //Checkout
        Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function() {
            Route::get('/', [CheckoutController::class, 'index'])->name('index');
            Route::post('/', [CheckoutController::class, 'save_checkout_customer'])->name('save_checkout');
            Route::post('/place-order', [CheckoutController::class, 'place_order'])->name('place_order');
            Route::get('/payments', [CheckoutController::class, 'payment'])->name('payment');
        });

        //User Detail
        Route::get('/users/detail', [UserController::class, 'show'])->name('user.detail');
        Route::put('/users/detail', [UserController::class, 'update_customer'])->name('user.update_customer');
        Route::put('/users/change-password', [UserController::class, 'change_password'])->name('user.change-password');
    });
});

// Login Page
Route::get('/login', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [LoginController::class, 'getLogout'])->name('logout');
Route::get('/register', [LoginController::class, 'getRegister'])->name('getRegister');
Route::post('/register', [LoginController::class, 'postRegister'])->name('postRegister');