<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
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
    Route::put('/imports/{id}', [ImportController::class, 'update'])->name('import.update');
    Route::delete('/imports/{id}', [ImportController::class, 'destroy'])->name('import.delete');

    //Product
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.delete');
});