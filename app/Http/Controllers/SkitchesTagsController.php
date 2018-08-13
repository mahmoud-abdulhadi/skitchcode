<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag ; 

use App\User ; 

use App\Skitch ; 

class SkitchesTagsController extends Controller
{
    

    public function show(Tag $tag){


    	$skitches = $tag->skitches ; 

    	if(request()->expectsJson()){

    		return $skitches ; 

    	}

    	return view('skitches.index',compact('skitches'));

    }

    public function index(User $user , Skitch $skitch){

    		if(request()->wantsjson()){

    			return $skitch->tags;
    		} 
    }
}
