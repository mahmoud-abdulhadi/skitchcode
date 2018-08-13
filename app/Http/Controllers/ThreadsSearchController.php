<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;
use App\Trends\TrendingThreads;
class ThreadsSearchController extends Controller
{
    


    public function show(TrendingThreads $trending)
    {

    	$searchTerm = request('q');

    	$threads = Thread::search($searchTerm)->get();

    	if(request()->expectsJson()){

    		return $threads ; 
    	}

    	return view('threads.index',[
            'threads' => $threads ,
            'trends' => $trending->get()
        ]);
    }
}
