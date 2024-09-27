<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

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
            'cat_name'=>'required|min:2',
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

    public function delete($id)
    {

        try{
            $category=Category::find($id);
            $category->delete();
    
            notify()->success('Category deleted.');
            return redirect()->back();
        }catch(Throwable $ex)
        {
            notify()->error('Category has product.');
            return redirect()->back();
        }
        

    }
}
