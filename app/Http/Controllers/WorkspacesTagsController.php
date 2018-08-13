<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag ; 

use App\User ; 

use App\Workspace ; 

class WorkspacesTagsController extends Controller
{
    

      public function show(Tag $tag){


    	$workspaces = $tag->workspaces ; 

    	if(request()->expectsJson()){

    		return $workspaces ; 

    	}

    	return view('projects.index',compact('workspaces'));

    
	}

	public function index(User $user,Workspace $workspace){


		if(request()->wantsJson()){

			return $workspace->tags ; 
		}
	}
}
