<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User ; 
use App\Workspace ; 

use App\Comment ; 

use App\Http\Requests\CreatePostRequest ; 



class CommentsWorkspaceController extends Controller
{
    public function __construct()
    {


    	$this->middleware('auth')->except(['index','show']);
    }

    public function store(User $user,Workspace $workspace,CreatePostRequest $form){


       /*  $this->validate(request(),[
            'body' => 'required'
        ]);*/
         
        return $workspace->addComment([
            'body' =>  request('body'), 
            'user_id' => auth()->id()
        ])->load('author');
    	
    }

    public function reply(User $user , Workspace $workspace,Comment $comment,CreatePostRequest $form){

        /*$this->validate(request(),[
            'body' => 'required'
        ]);*/
         
        return $comment->addComment([
            'body' =>  request('body'), 
            'user_id' => auth()->id()
        ])->load('author');
    	
    }
}
