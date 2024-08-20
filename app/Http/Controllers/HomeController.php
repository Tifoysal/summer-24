<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{ 

    public function home(){

        $customerCount=Customer::count();

        $totalSale=Order::sum('total_amount');
     
        return view('backend.home',compact('customerCount','totalSale'));
    }

}
