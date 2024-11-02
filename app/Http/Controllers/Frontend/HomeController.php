<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // app()->setLocale('bn');
        return view("frontend.home");    
    }


    public function productsUnderCategory($id)
    {
      
        $products=Product::where('category_id',$id)->get();

       return view('frontend.pages.products-under-category',compact('products'));

    }

    public function changeLang($langName)
    {

       session()->put('locale',$langName);

        return redirect()->back();
    }

    public function otpPage()
    {
        
        return view('frontend.pages.otp');
    }


    public function otpSubmit(Request $request)
    {
// dd(strtotime(now()));
       
        $user=Customer::where('email',$request->email)
                        ->where('otp',$request->otp)->first();
        $email=$request->email;

        if($user)
        {

            if(strtotime($user->otp_expired_at) > strtotime(now()))
            {
                //varified user

                $user->update([
                    'is_email_verified'=>true,
                    'otp'=>null,
                    'otp_expired_at'=>null
                ]);

                notify()->success('Account Verified');
                return redirect()->route('home');
            }else{
                //otp expired.
               
                notify()->error('OTP expired. Please re-send OTP.');
                return view('frontend.pages.otp',compact('email'));
            }
        }else
        {
            //incorrect otp or email
        }
        notify()->error('Invalid OTP or email.');

        return view('frontend.pages.otp',compact('email'));
    }

    public function otpResend($email)
    {

        $user=Customer::where('email',$email)->first();

        if($user)
        {
            $otp=rand(100000,999999);

            $user->update([
                'otp'=>$otp,
                'otp_expired_at'=>now()->addMinutes(3),
            ]);

                notify()->success('Resend success');
            return view('frontend.pages.otp',compact('email'));
        }
        
    }


}
