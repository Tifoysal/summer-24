<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\FileUploadService;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
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

    public function store(ProductRequest $request)
    {
        $name=FileUploadService::fileUpload($request->file('product_image'),'/');
        ProductRepository::store($request,$name);
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

    public function productExport() 
    {
         // product_2024-12-22.xlsx
        return Excel::download(new ProductExport, 'product_'.date('Y-m-d').'.xlsx');
       
    }


}
