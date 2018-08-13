<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Skitch ; 

use App\User ; 

class ForksController extends Controller
{
   public function __construct(){

   		$this->middleware('auth')->only(['store']);

   }

    public function store(User $user,Skitch $skitch){

    	$forkedSkitch = $skitch->fork();


    	return redirect($forkedSkitch->path())->with('flash','Skitch Forked Successfully');
    }

    public function index(User $user,Skitch $skitch){

    	return $skitch->forks ; 
    }

}
