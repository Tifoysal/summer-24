<?php

namespace App\Http\Controllers;

use App\Events\CreateCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CategoryController extends Controller
{
    public function list()
    {

        // Cache::forget('cats');
        if(Cache::get('cats'))
        {
            //data from cache
            $title="data from Cache";
            $allCategory=Cache::get('cats');

        }else{
            // data from database
            $title="data from Database";

            $allCategory=Category::with('parent')->paginate(10);
            Cache::put('cats',$allCategory);
        }
        
      
        $parents=Category::with('child')->where('parent_id',null)->get();
       
         
       return view('backend.category-list',compact('allCategory','title','parents'));   
    }

    public function form()
    {
        $allCategory=Category::all();
        return view('backend.category-form',compact('allCategory'));    
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

        try
        {
            Category::create([
                //bam pase table er column name => dan pase input field er name
                'name'=>$request->cat_name,
                'slug'=>str()->slug($request->cat_name),
                'parent_id'=>$request->parent_id,
                'description'=>$request->cat_description
            ]);

            CreateCategory::dispatch();
    
            return redirect()->back();

        }catch(Throwable $e)
        {
            // notify()->error('Something went wrong');
            notify()->error($e->getMessage());

            return redirect()->back();

        }
      

    }

    public function delete($id)
    {

        try{
            $category=Category::find($id);
            $category->delete();

            CreateCategory::dispatch();
    
            notify()->success('Category deleted.');
            return redirect()->back();
        }catch(Throwable $ex)
        {
            notify()->error('Category has product.');
            return redirect()->back();
        }
        

    }
}
