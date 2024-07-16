<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product()
    {
        return view ('frontend.product');
    }


    public function appointment()
    {
        return view ('frontend.appointment');
    }
}
