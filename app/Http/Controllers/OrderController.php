<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    

    public function orderList()
    {
        return view('backend.order-list');
    }
}
