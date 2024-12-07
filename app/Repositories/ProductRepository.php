<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{

    public static function store($request,$name){
        Product::create([
            'name'=>$request->product_name,
            'price'=>$request->product_price,
            'discount'=>$request->product_discount,
            'image'=>$name,
            'stock'=>$request->product_stock,
            'category_id'=>$request->category_id
           ]);
    
    }
}