<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::get('/',[HomeController::class,'home']);

Route::get('/contact-us',[ContactController::class,'contact']);

Route::get('/product',[ProductController::class,'product']);

Route::get('/user-list',[UserController::class,'list'])->name('UserList'); 






