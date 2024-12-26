<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    
    public $total;
   
    public function allProducts()
    {
    
        $products=Product::all();
        

        return $this->responseSuccess(ProductResource::collection($products),'All Products.');
       
    }
    public function singleProduct($id)
    {
    
        $products=Product::find($id);
        

        return $this->responseSuccess(ProductResource::make($products),'Single Products.');
       
    }

    public function createNewProductFromOutside(Request $request)
    {

         // dd($request->all());

         $validation=Validator::make($request->all(),[
            'product_name'=>'required',
            'product_price'=>'required|numeric|min:10',
            'product_image'=>'required|file|max:1024',
            'category_id'=>'required',
            'product_stock'=>'required',
            'product_discount'=>'nullable|numeric',
        ]);

        if($validation->fails())
        {
           return $this->responseFailed($validation->getMessageBag());
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

       $pro=Product::create([
        'name'=>$request->product_name,
        'price'=>$request->product_price,
        'discount'=>$request->product_discount,
        'image'=>$fileName,
        'stock'=>$request->product_stock,
        'category_id'=>$request->category_id
       ]);

       return $this->responseSuccess($pro,'Product Created successfully.');

    }
}
