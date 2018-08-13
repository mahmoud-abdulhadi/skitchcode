<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category ; 

use App\Post ; 

use App\Comment ; 

use App\Http\Requests\CreatePostRequest ; 
class CommentsPostController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth')->except(['index','show']);
    }


    public function store(Category $category , Post $post,CreatePostRequest $form){

        //the logic of validation is the Form Request 

        

    	return $post->addComment([
    		'body' => request('body'), 
    		'user_id' => auth()->id()

    	])->load('author');

    }

    public function reply(Category $category,Post $post,Comment $comment,CreatePostRequest $form)
    {

       /* $this->validate(request(),[

            'body' => 'required'
        ]);*/


       return  $comment->addComment([

            'body' => request('body'),
            'user_id' => auth()->id()
        ])->load('author');

    }
}
