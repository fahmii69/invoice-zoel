<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
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

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/product/get', [ProductController::class, 'getProduct'])->name('product.list');
Route::resource('product', ProductController::class);

Route::get('/supplier/get', [SupplierController::class, 'getSupplier'])->name('supplier.list');
Route::resource('supplier', SupplierController::class);

Route::get('/category/get', [CategoryController::class, 'getCategory'])->name('category.list');
Route::resource('category', CategoryController::class);

Route::get('/customer/get', [CustomerController::class, 'getcustomer'])->name('customer.list');
Route::resource('customer', CustomerController::class);

Route::get('/stock/get', [StockController::class, 'getStock'])->name('stock.list');
Route::resource('stock', StockController::class);

Route::get('/contract/get', [ContractController::class, 'getcontract'])->name('contract.list');
Route::resource('contract', ContractController::class);

Route::get('/sale/get', [SaleController::class, 'getSale'])->name('sale.list');
Route::get('/pdf/{sale}', [SaleController::class, 'pdf'])->name('sale.pdf');
Route::post('/sale/get/contract/price', [SaleController::class, 'getContractPrice'])->name('sale.getContractPrice');
Route::resource('sale', SaleController::class);
