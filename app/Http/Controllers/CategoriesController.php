<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category ; 

class CategoriesController extends Controller
{
    
    public function index()
    {



    	$categories = Category::latest()->get(); 

    	
    	if(request()->wantsJson()){

    		return $categories ; 
    	}




        return view('admin.categories.index',compact('categories'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required'

        ]);

        $category = Category::create([

            'title' => request('title')
        ]);

        return $category ; 

        
    }

    public function destroy(Category $category){

    	foreach($category->posts as $post){

    		$post->forceDelete();


    	}

    	$category->delete();

    	if(request()->wantsJson()){
    		return response([],204);
    	}
    }

    public function update(Category $category)
    {


    	$category->title = request('title'); 


    	$category->save();

    }

}
