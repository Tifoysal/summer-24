<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class HomeController extends Controller
{ 

    public function home(){

        $customerCount=Customer::count();

        $totalSale=Order::sum('total_amount');
     
        return view('backend.home',compact('customerCount','totalSale'));
    }

    public function settings()
    {
        $setting=Setting::find(1);

        return view('backend.settings',compact('setting'));
        
    }


    public function settingSubmit(Request $request)
    {

        $setting=Setting::find(1);
        $logoName=null;

        if($request->has('logo'))
        {
            $file=$request->file('logo');
            $logoName=date('ymdhis').'.'.$file->getClientOriginalExtension();
            $file->storeAs('/logo',$logoName);
        }

        if($setting)
        {
           
            
            $setting->update([
                'logo'=>$logoName ?? $setting->logo,
                'address'=>$request->address,
                'facebook_link'=>$request->facebook_link,
                'contact_number'=>$request->contact,
            ]);
    
        }else{
            Setting::create([
                'logo'=>$logoName,
                'address'=>$request->address,
                'facebook_link'=>$request->facebook_link,
                'contact_number'=>$request->contact,
            ]);
    
        }

       
        notify()->success('Settings Updated.');

        return view('backend.settings');
        
    }

}
