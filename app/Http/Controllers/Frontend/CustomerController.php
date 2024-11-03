<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
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
            return redirect()->back()->withInput();
        }

       // query
        $otp=rand(100000,999999);

       Customer::create([
        //bam pase column name=>dan pase value (form input)
        'name'=>$request->customer_name,
        'otp'=>$otp,
        'otp_expired_at'=>now()->addMinutes(3),
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'mobile'=>$request->mobile_number
       ]);

       notify()->success('Customer Registration Successful.');

       return redirect()->route('home');



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

       if($check ){
        $customer=auth('customerGuard')->user();

        if($customer->is_email_verified==true)
        {
            notify()->success('Login Success');
       
            return redirect()->route('home');
        }else{

            auth('customerGuard')->logout();
            notify()->error('Account Not verified');
            $email=$customer->email;
            return view('frontend.pages.otp',compact('email'));
        }
        
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

    public function cancelOrder($id)
    {
       
        $order=Order::find($id);
        
        $order->update([
            'status'=>'cancel'
        ]);

        $items=OrderDetail::where('order_id',$id)->get();
       foreach($items as $item)
       {
        $product=Product::find($item->product_id);

        $product->increment('stock',$item->product_quantity);
       }



        notify()->success('Order cancelled.');
        return redirect()->back();

    }

    public function editProfile()
    {
        return view('frontend.pages.profile-edit');    
    }

    public function updateProfile(Request $request)
    {
       
        $fileName=null;
        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            // $file=request()->file('image')
            $fileName=date('ymdhis').'.'.$file->getClientOriginalExtension();
            $file->storeAs('/customers',$fileName);
        }

       $user=auth('customerGuard')->user();
       $user->update([
        'name'=>$request->customer_name,
        'image'=>$fileName
       ]);

       notify()->success('update success.');

       return redirect()->back();
        
    }
}
