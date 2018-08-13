<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Workspace ; 

class WorkspacesSearchController extends Controller
{
    

    public function show(){

    	$searchTerm = request('q');

    	$workspaces = Workspace::search($searchTerm)->get() ; 

    	if(request()->expectsJson()){

    		return $workspaces ; 
    	}


    	return view('projects.index',compact('workspaces'));
    }
}
