<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list()
    {
        
        $allCategory=Category::paginate(5);
       
       return view('backend.category-list',compact('allCategory'));   
    }

    public function form()
    {
        return view('backend.category-form');    
    }

    public function store(Request $request)
    {

        $validation=Validator::make($request->all(),
        [
            'cat_name'=>'required|min:20',
        ]);
        
      if($validation->fails())
      {
        notify()->error($validation->getMessageBag());
        return redirect()->back();
      }


        // dd($request->all()); //to see data comming from form

        //lets store data into database

        Category::create([
            //bam pase table er column name => dan pase input field er name
            'name'=>$request->cat_name,
            'description'=>$request->cat_description
        ]);

        return redirect()->back();

    }
}
