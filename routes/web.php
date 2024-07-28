<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



//for website

Route::get('/',[FrontendHomeController::class,'home'])->name('home');
Route::get('/all-products',[FrontendProductController::class,'allProduct'])->name('frontend.products');
Route::post('/registration',[FrontendCustomerController::class,'registration'])->name('customer.registration');

Route::post('/do-login',[FrontendCustomerController::class,'customerLogin'])->name('customer.login');

// for admin panel

Route::group(['prefix' => 'admin'], function () {


    Route::get('/login', [AuthenticationController::class, 'loginForm'])->name('login');

    Route::post('/do-login', [AuthenticationController::class, 'doLogin'])->name('do.login');


    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', [HomeController::class, 'home'])->name('dashboard');

        Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

        Route::get('/contact-us', [ContactController::class, 'contact']);

        Route::get('/order-list', [OrderController::class, 'orderList']);

        Route::get('/product-list', [ProductController::class, 'productList'])->name('product.list');

        Route::get('/product-create', [ProductController::class, 'create'])->name('product.create');

        Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');

        Route::get('/customer-list', [CustomerController::class, 'customerList'])->name('customer.list');

        Route::get('/category-list', [CategoryController::class, 'list'])->name('category.list');

        Route::get('/category-form', [CategoryController::class, 'form'])->name('category.form');

        Route::post('/category-store', [CategoryController::class, 'store'])->name('category.store');
    });
});
