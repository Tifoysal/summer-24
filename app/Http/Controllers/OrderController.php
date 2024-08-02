<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    

    public function orderList()
    {
        return view('backend.order-list');
    }


    public function addToCart($pId)
    {
        
        $product=Product::find($pId);
        $myCart=session()->get('basket');
        // dd($myCart);
        //step 1: cart empty
        if(empty($myCart))
        {
            //action: add to cart
            $cart[$product->id]=[
                //key=>value
                'product_id'=>$product->id,
                'product_name'=>$product->name,
                'price'=>$product->price,
                'quantity'=>1,
                'subtotal'=>1 * $product->price
            ];

            session()->put('basket',$cart);

            notify()->success('Product added to cart.');
            return redirect()->back();
        }else{

            if(array_key_exists($pId,$myCart))
            {
                //step 2: quantity update
                dd("product exist, quantity update");
            }
            else{
                //step 3: add to cart
                $myCart[$product->id]=[
                    'product_id'=>$product->id,
                    'product_name'=>$product->name,
                    'price'=>$product->price,
                    'quantity'=>1,
                    'subtotal'=>1 * $product->price
                ];

                
                session()->put('basket',$myCart);
                notify()->success("Product Added to Cart");
                return redirect()->back();
            }
        }
    }
}
