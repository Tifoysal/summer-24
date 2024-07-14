<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        
        $allCategory=Category::all();
       
       
       return view('backend.category-list',compact('allCategory'));   
    }

    public function form()
    {
        return view('backend.category-form');    
    }

    public function store(Request $request)
    {

        //dd($request->all()); //to see data comming from form

        //lets store data into database

        Category::create([
            //bam pase table er column name => dan pase input field er name
            'name'=>$request->cat_name,
            'description'=>$request->cat_description
        ]);

        return redirect()->back();

    }
}
