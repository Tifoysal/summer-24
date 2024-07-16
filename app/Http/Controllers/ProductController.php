<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productList(){

       $allProduct=Product::paginate(5);

        return view('backend.product-list',compact('allProduct'));
    }


    public function create()
    {

        return view('backend.product-create');

    }


    public function store(Request $request)
    {

       Product::create([
        'name'=>$request->product_name,
        'price'=>$request->product_price,
       ]);

       return redirect()->route('product.list');

    }
}
