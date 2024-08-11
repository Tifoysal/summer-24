<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function checkout()
    {
        return view('frontend.pages.checkout');
    }

    public function placeOrder(Request $request)
    {

        // dd($request->all());
        //step1 validation
       $validation=Validator::make($request->all(),[
        'receiver_name'=>'required',
        'email'=>'required|email',
        'address'=>'required',
        'paymentMethod'=>'required|in:cod,online'
        ]);

    if($validation->fails())
    {
        notify()->error($validation->getMessageBag());
       
        return redirect()->back();
    }

        $cart=session()->get('basket');
        
        //quary for store data into Orders table
       
        $order=Order::create([
            'receiver_name'=>$request->receiver_name,
            'receiver_email'=>$request->email,
            'receiver_address'=>$request->address,
            'receiver_mobile'=>'01616666666',
            'payment_method'=>$request->paymentMethod,
            'customer_id'=>auth('customerGuard')->user()->id,
            'total_amount'=>array_sum(array_column($cart,'subtotal'))

        ]);

        //quary for storing data into Order_details table
           
        foreach($cart as $singleData)
        {
          
            OrderDetail::create([
                'order_id'=>$order->id,
                'product_id'=>$singleData['product_id'],
                'product_unit_price'=>$singleData['price'],
                'product_quantity'=>$singleData['quantity'],
                'subtotal'=>$singleData['subtotal'],
            ]);
        }
           

        notify()->success('Order place successfully.');
        session()->forget('basket');
        return redirect()->route('home');

    }

    public function viewInvoice($order_id)
    {
       
        $order=Order::with('orderDetails')->find($order_id);
        

       return view('frontend.pages.invoice',compact('order'));
        
    }
}
