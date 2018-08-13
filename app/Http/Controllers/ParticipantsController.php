<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Workspace ; 
use App\User ; 

class ParticipantsController extends Controller
{
    

    public function index(User $user , Workspace $workspace){


    	return $workspace->participants;
    }

    public function store(Workspace $workspace){

    	//authorization
    	$this->authorize('delete',$workspace);

    	//validation 
    	$this->validate(request(),[

    		'username' => 'required'
    	]);


    	$user = User::where('username',request(['username']))->firstOrFail();

        if(!$user){

            return response('User not found', 404);
        }

    	
    	$workspace->add($user);

        return $workspace->participants->last();

    }	

    public function destroy(Workspace $workspace,User $user){



    	if($workspace->user_id != auth()->id() && $user->id != auth()->id()){


    		return response([],403);
    	}

    	

     

    	$workspace->remove($user);


    }
}
