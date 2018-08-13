<?php 


namespace App ; 
use App\Events\ThreadHasNewComment ; 
use App\Events\CommentableHasNewComment; 

use App\Thread ; 

trait CommentableTrait
{



	/**

	 * Commentable has many comments 

	 */
	public function comments(){

		return $this->morphMany('App\Comment','commentable')->latest();
	}


	/**
	*Commentable can add new comment 
	* @comment array of properties
	*/

	public function addComment($comment){
		
		$comment = $this->comments()->create($comment); 

		if($this instanceof Thread)
			{

			event(new ThreadHasNewComment($this,$comment));
		}


		event(new CommentableHasNewComment($comment));


		return $comment ;  
	}

	//get teh count of comments as attribute 
    public function getCommentsCountAttribute(){

        return $this->fresh()->comments()->count();
    }




}