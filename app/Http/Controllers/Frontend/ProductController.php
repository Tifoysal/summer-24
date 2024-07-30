<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function allProduct()
    {
    
      $products=Product::all();
       return view('frontend.products',compact('products'));
    }

    public function  showProduct($id)
    {
      
      $singleProduct=Product::find($id);

     
      $relatedProduct=Product::where('category_id',$singleProduct->category_id)
                      ->where('id','!=',$singleProduct->id)
                      ->limit(4)
                      ->get();

      //method chaining
      return view('frontend.pages.single_product',compact('singleProduct','relatedProduct'));
    }
}
