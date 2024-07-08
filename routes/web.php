<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[HomeController::class,'home']);

Route::get('/contact-us',[ContactController::class,'contact']);
