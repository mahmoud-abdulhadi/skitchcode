<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Skitch ; 

class SkitchesSearchController extends Controller
{
    

    public function show(){

    	$searchTerm = request('q');

    	$skitches = Skitch::search($searchTerm)->get();


    	if(request()->expectsJson()){

    		return $skitches ; 

    	}

    	return view('skitches.index',compact('skitches'));

    }
}
