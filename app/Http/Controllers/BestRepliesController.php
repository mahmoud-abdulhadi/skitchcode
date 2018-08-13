<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment ; 

class BestRepliesController extends Controller
{
    public function __construct(){

    	$this->middleware('auth');
    }

    public function store(Comment $comment){


    		//authorization 
    		$this->authorize('update',$comment->commentable);

    		$comment->commentable->markBestReply($comment);
    }
}
