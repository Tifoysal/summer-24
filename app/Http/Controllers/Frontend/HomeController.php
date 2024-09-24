<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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
}
