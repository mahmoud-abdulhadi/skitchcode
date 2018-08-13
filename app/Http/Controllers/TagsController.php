<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag ; 

class TagsController extends Controller
{
    public function index(){

        $tags = Tag::latest()->get();
    	if(request()->expectsJson()){

    		return $tags;
    	}

    return view('admin.tags',['tags' => $tags]);
}

    public function store(){


    	$tag = Tag::create([

    		'name' => request('name'),
    	
    	]);

    	if(request()->wantsJson()){

    			return $tag ; 
    	}
    	
    }


    public function destroy(Tag $tag){

    	$tag->delete();


    	if(request()->expectsJson()){

    		return response('Tag Deleted Succesfully',204);
    	}
    }
}
