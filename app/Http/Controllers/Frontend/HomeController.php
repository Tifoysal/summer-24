<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

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
       Log::info("OTP submitted.");
        $user=Customer::where('email',$request->email)
                        ->where('otp',$request->otp)->first();
        $email=$request->email;

        if($user)
        {
            Log::info("User Exist.");

            if(strtotime($user->otp_expired_at) > strtotime(now()))
            {
                //varified user
                Log::info("OTP has validity.");
                $user->update([
                    'is_email_verified'=>true,
                    'otp'=>null,
                    'otp_expired_at'=>null
                ]);

                Log::info("Account Verified.");


                notify()->success('Account Verified');
                return redirect()->route('home');
            }else{
                //otp expired.
                Log::info("OTP has expired.");

               
                notify()->error('OTP expired. Please re-send OTP.');
                return view('frontend.pages.otp',compact('email'));
            }
        }else
        {
            //incorrect otp or email
            Log::info("User does not exist.");

        }

        Log::info("OTP invalid");
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

    public function socialLogin($provider)
    {
        return Socialite::driver($provider)->redirect();

    }


    public function callback()
    {
        $user = Socialite::driver('github')->user();

        //find the user in customer table

        $customer=Customer::where('provider_id',$user->id)->first();
        // dd($customer);
        if($customer)
        {
            //sudhu login

            Auth::guard('customerGuard')->login($customer, true);
            notify()->success('Login successfull.');

        }else{

            //registar first

            $customer=Customer::create([
            'name' => $user->name,
            'email' => strtolower($user->nickname).'@gmail.com',
            'mobile' =>'01717181818' ,
            'image' =>$user->avatar, 
            'provider_id' =>$user->id, 
            'password' =>bcrypt('123456'), 
            'address' =>$user->location, 
            ]);

            //then login
            Auth::guard('customerGuard')->login($customer, true);

        notify()->success('Register and Login successfull.');
       
        }
        return redirect()->route('home');
    }
}
