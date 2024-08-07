<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerList()
    {

        $customers=Customer::paginate(10);
        return view('backend.customer-list',compact('customers'));
    }
}
