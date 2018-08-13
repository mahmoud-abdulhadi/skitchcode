<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment ; 

class CommentsController extends Controller
{
    
	public function __construct()
	{

		$this->middleware('auth');
	}

    public function destroy(Comment $comment){

    	$this->authorize('delete',$comment);

    	$comment->delete(); 

    	return redirect()->back()
    		->with('flash','Comment Deleted Successfully!!');

    }


    public function update(Comment $comment){

    	$this->authorize('update',$comment);
        try{

            $this->validate(request(),[
            'body' => 'required|spamfree'

        ]);


        $comment->update(['body' => request('body')]);
        }catch(\Exception $e){


            return response('Comment Cannot be stored!!',422);
        }
    	



    }
}
