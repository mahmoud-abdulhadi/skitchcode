<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread ; 

class ThreadsLikesController extends Controller
{
    
    public function __construct(){

    	$this->middleware('auth');
    }	

    public function store(Thread $thread){

    	$thread->like();
    }

    public function destroy(Thread $thread){

    	$thread->unlike();
    }
}
