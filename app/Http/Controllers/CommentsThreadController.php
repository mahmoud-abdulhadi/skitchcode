<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel ; 

use App\Thread ; 

use App\Comment ; 

use App\Http\Requests\CreatePostRequest ; 

class CommentsThreadController extends Controller
{
    public function __construct()
    {


    	$this->middleware('auth')->except(['index','show']);
    	
    }

    public function store(Channel $channel,Thread $thread,CreatePostRequest $form)
    {

        if($thread->locked){

                 return response('You do not hoave persmission,This Thread is locked',422);
        }
        
       return $thread->addComment([
            'body' => request('body'), 
            'user_id' => auth()->id()

        ])->load('author');
    }


    public function reply(Channel $channel,Thread $thread,Comment $comment,CreatePostRequest $form)
    {

        /* $this->validate(request(),[
            'body' => 'required'
        ]);*/
        
       return $comment->addComment([
            'body' => request('body'), 
            'user_id' => auth()->id()

        ])->load('author');


    }


}
