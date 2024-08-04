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
                'subtotal'=>1 * $product->price,
                'image'=>$product->image
            ];

            session()->put('basket',$cart);

            notify()->success('Product added to cart.');
            return redirect()->back();
        }else{

            if(array_key_exists($pId,$myCart))
            {
                // dd($myCart[$pId]);
                //step 2: quantity update, subtotal update
               //q=1,sub=300
                $myCart[$pId]['quantity'] = $myCart[$pId]['quantity'] + 1;
                $myCart[$pId]['subtotal'] = $myCart[$pId]['quantity'] * $myCart[$pId]['price'];

                session()->put('basket',$myCart);

                notify()->success('Quantity updated.');
                return redirect()->back();


            }
            else{
                //step 3: add to cart
                $myCart[$product->id]=[
                    'product_id'=>$product->id,
                    'product_name'=>$product->name,
                    'price'=>$product->price,
                    'quantity'=>1,
                    'subtotal'=>1 * $product->price,
                    'image'=>$product->image
                ];

                
                session()->put('basket',$myCart);
                notify()->success("Product Added to Cart");
                return redirect()->back();
            }
        }
    }

    public function viewCart()
    {
        //ternary operator (condition) ? statement 1 : statement2

        //null coalescing ??
        //$a=5; $b=6;
        // $x= $a ?? $b

        $myCart=session()->get('basket') ?? [];

    //    dd($myCart);
        return view('frontend.pages.cart',compact('myCart'));
    }

    public function clearCart()
    {

      session()->forget('basket');

      notify()->success('Cart clear.');

      return redirect()->back();

    }

    public function cartItemDelete($productId)
    {
        
        $cart=session()->get('basket');

       unset($cart[$productId]);


    
       session()->put('basket',$cart);

       notify()->success('Item remove.');

       return redirect()->back();



       

    }
}
