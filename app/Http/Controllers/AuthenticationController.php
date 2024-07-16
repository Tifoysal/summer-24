<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function loginForm() 
    {
        return view('backend.login');    
    }

    public function doLogin(Request $request)
    {
        
        // $credentials=$request->only(['email','password']);
        // $credentials=['email'=>$request->user_email,'password'=>$request->user_password];
        $credentials=$request->except("_token");

        $check=Auth::attempt($credentials);
        if($check)
        {
            return redirect()->route('dashboard');
           
        }else{
            //2 number user
            return redirect()->back();
        }




    }


    public function logout()
    {
          Auth::logout();
          
          return redirect()->route('login');
    }
}
