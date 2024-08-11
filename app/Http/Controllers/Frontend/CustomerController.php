<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //

    public function registration(Request $request)
    {

       //step1 validation
        $validation=Validator::make($request->all(),[
            'customer_name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6|confirmed',
            'mobile_number'=>'required|min:11|max:11'
            
        ]);

        if($validation->fails())
        {
            notify()->error($validation->getMessageBag());
            return redirect()->back();
        }

       // query

       Customer::create([
        //bam pase column name=>dan pase value (form input)
        'name'=>$request->customer_name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'mobile'=>$request->mobile_number
       ]);

       notify()->success('Customer Registration Successful.');

       return redirect()->back();



    }

    public function customerLogin(Request $request)
    {

       
       //step1 validation
       $validation=Validator::make($request->all(),[
        'email'=>'required|email',
        'password'=>'required|min:6',
        ]);

    if($validation->fails())
    {
        notify()->error($validation->getMessageBag());
       
        return redirect()->back();
    }

   
       //condition for login
       $credentials=$request->except('_token');
       
       $check=auth('customerGuard')->attempt($credentials);
    //    $check=Auth::guard('customerGuard')->attempt($credentials)

       if($check){
        notify()->success('Login Success');
       
        return redirect()->route('home');
       }else
       {
        notify()->error('Login failed.');

        return redirect()->route('home');
       }
    }

    public function logout(){

        auth('customerGuard')->logout();

        session()->forget('basket');

        notify()->success('logout success.');
        return redirect()->route('home');
    }

    public function viewProfile()
    {

        $orders=Order::where('customer_id',auth('customerGuard')->user()->id)->get();
        
        return view('frontend.pages.profile',compact('orders'));
    }
}
