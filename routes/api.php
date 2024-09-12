<?php

use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/get-products',[ProductController::class,'allProducts']);

Route::post('/create-product',[ProductController::class,'createNewProductFromOutside']);