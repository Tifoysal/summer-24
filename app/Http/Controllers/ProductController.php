<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function productList(){

      
    //    dd($allProduct);

        return view('backend.product-list');
    }

    public function getProductData()
    {
        $data=Product::with('category')->get();
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a><a href="" class="edit btn btn-success btn-sm">Edit</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);    
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
            'category_id'=>'required',
            'product_stock'=>'required',
            'product_discount'=>'nullable|numeric',
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
        'discount'=>$request->product_discount,
        'image'=>$fileName,
        'stock'=>$request->product_stock,
        'category_id'=>$request->category_id
       ]);

       return redirect()->route('product.list');

    }

    public function delete($id)
    {

        // Product::find($id)->delete();
        $product=Product::find($id);//data anlam
        $product->delete();//delete korlam

        notify()->success('Product Deleted successfully.');

        return redirect()->back();

        
    }


    public function viewProduct($id)
    {
        $product=Product::find($id);

        return view('backend.page.product-view',compact('product'));
    }

    public function edit($paglaID)
    {

        $product=Product::find($paglaID);
        $allCategory=Category::all();
        return view('backend.page.product-edit',compact('allCategory','product'));
    }

    public function update(Request $request,$paglaId)
    {
        // dd($request->all());

        //validation



        //query
        $product=Product::find($paglaId);
        $product->update([
            'name'=>$request->product_name,
            'price'=>$request->product_price,
        ]);
      
        notify()->success('Product updated successfully.');
        return redirect()->route('product.list');


    }

    public function setAlertStock(Request $request){
       

        session()->put('alert',$request->alert_qty);
        return redirect()->back();
    }


}
