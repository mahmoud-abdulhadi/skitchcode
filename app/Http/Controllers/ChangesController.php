<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User ; 

use App\Workspace ; 

use App\Change ; 

class ChangesController extends Controller
{
    


    public function show(User $user , Workspace $workspace){
    	


    	$change = null ; 

    	$coder = null ; 


    	if(request('changeId')){


    		

    		$change = Change::where('id',request('changeId'))->firstOrFail();

    		

    		$coder = User::where('id',$change->user_id)->firstOrFail();


    	}
    	

    	return view('changes.show',compact(['workspace','change','coder']));
    }
}
