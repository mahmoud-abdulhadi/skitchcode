<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Skitch ; 

class SkitchesLikesController extends Controller
{
    

    public function __construct(){

    	$this->middleware('auth');
    }

    public function store(Skitch $skitch){

    	$skitch->like();
    }

    public function destroy(Skitch $skitch){

    	$skitch->unlike();
    }
}
