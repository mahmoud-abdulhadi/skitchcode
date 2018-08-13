<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment ; 

class CommentsLikesController extends Controller
{
    public function __construct(){

    	$this->middleware('auth');
    }

    public function store(Comment $comment){

    	$comment->like();

    	return redirect()->back();

    }

    public function destroy(Comment $comment){

    	$comment->unlike();
    }
}
