<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productList(){

       $allProduct=Product::with('category')->paginate(5);
    //    dd($allProduct);

        return view('backend.product-list',compact('allProduct'));
    }


    public function create()
    {
       
        $allCategory=Category::all();

        return view('backend.product-create',compact('allCategory'));

    }


    public function store(Request $request)
    {

        // dd($request->all());

        $validation=Validator::make($request->all(),[
            'product_name'=>'required',
            'product_price'=>'required|numeric|min:10',
            'product_image'=>'required|file|max:1024',
            'category_id'=>'required'
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
        'image'=>$fileName,
        'category_id'=>$request->category_id
       ]);

       return redirect()->route('product.list');

    }
}
