<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User ; 

class UserAvatarController extends Controller
{
    

    public function store(User $user){

    	$this->validate(request(),[

    		'avatar' => ['required' , 'image']
    	]);

    	auth()->user()->update([
    		//hashed file name to prevent conflict 
    		'avatar' => request()->file('avatar')->store('avatars','public')

    	]);

        return response([],204);

    }
}
