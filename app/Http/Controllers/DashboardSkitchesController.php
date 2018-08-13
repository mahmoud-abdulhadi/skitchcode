<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User ; 

class DashboardSkitchesController extends Controller
{
    

    public function index(User $user){


    	return $user->forks ; 
    }
}
