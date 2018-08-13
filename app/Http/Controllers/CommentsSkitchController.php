<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User ; 

use App\Skitch ; 

use App\Comment ; 

use App\Http\Requests\CreatePostRequest ; 

class CommentsSkitchController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth')->except(['show','index']);
    }

    public function store(User $user , Skitch $skitch,CreatePostRequest $form)
    {
       
       //The logic of validation is in the form request 
        
        return $skitch->addComment([

            'body' => request('body'), 
            'user_id' =>auth()->id()

        ])->load('author');


    }


    public function reply(User $user,Skitch $skitch,Comment $comment,CreatePostRequest $form)
    {
        /* $this->validate(request(),[
            'body' => 'required|spamfree'
        ]);*/

        return $comment->addComment([

            'body' => request('body'), 
            'user_id' =>auth()->id()

        ])->load('author');


    }
}
