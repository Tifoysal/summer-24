<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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


        $validation=Validator::make($request->all(),[
            'product_name'=>'required',
            'product_price'=>'required|numeric|min:10',
            'product_image'=>'required|file|max:1024'
        ]);
        if($validation->fails())
        {
            notify()->error($validation->getMessageBag());
            return redirect()->back();
        }

        $fileName=null;
       
        //check file exist
        if($request->hasFile('product_image'))
        {
       
            $file=$request->file('product_image');

            //file name generate
            $fileName=date('Ymdhis').'.'.$file->getClientOriginalExtension();

             //file store where i want to 
            $file->storeAs('/',$fileName);
       
        }

       Product::create([
        'name'=>$request->product_name,
        'price'=>$request->product_price,
        'image'=>$fileName
       ]);

       return redirect()->route('product.list');

    }
}
