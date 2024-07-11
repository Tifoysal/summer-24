<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[HomeController::class,'home']);

Route::get('/contact-us',[ContactController::class,'contact']);

Route::get('/order-list',[OrderController::class,'orderList']);

Route::get('/product-list',[ProductController::class,'productList']);

Route::get('/customer-list',[CustomerController::class,'customerList'])->name('customer.list');

Route::get('/category-list',[CategoryController::class,'list'])->name('category.list');

Route::get('/category-form',[CategoryController::class, 'form'])->name('category.form');

Route::post('/category-store',[CategoryController::class,'store'])->name('category.store');