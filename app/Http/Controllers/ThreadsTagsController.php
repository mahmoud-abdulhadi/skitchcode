<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag ; 

use App\Trends\TrendingThreads;

use App\Channel; 

use App\Thread ; 

class ThreadsTagsController extends Controller
{
    

    public function show(Tag $tag,TrendingThreads $trending){


    	$threads = $tag->threads ; 

    	if(request()->expectsJson()){

    		return $threads ; 

    	}

    	   return view('threads.index',[
            'threads' => $threads ,
            'trends' => $trending->get()
        ]);


    }

    public function index(Channel $channel , Thread $thread){

        if(request()->expectsJson()){

            return $thread->tags ; 
        }
    }
}
