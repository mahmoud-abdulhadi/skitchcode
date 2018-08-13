<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentLikeTest extends TestCase
{
   
   use DatabaseMigrations ; 


   /** @test */ 
   function a_guest_cannot_like_a_comment()
   {

   		$this->disableExceptionHandling()
   			->post('/comments/1/likes')
   			->assertRedirect('/login');


   }

   /** @test */ 
   function authenticated_user_can_like_a_comment()
   {


   		$this->signIn();

   		$comment = create('App\Comment');

   		//we could use Route Model Binding 

   		$this->post('/comments/' . $comment->id.'/likes') ; 


   		
   		//It should be recorded in the databse 

   		$this->assertCount(1,$comment->likes);

         $this->assertTrue($comment->isLiked);


   }

   /** @test */ 
   function authenticated_user_can_unlike_a_comment(){

   		//build the fucking world now 
   		$this->signIn();

   		//create a comment 
   		$comment = create('App\Comment');

   		//like the comment 
   		$comment->like();

   		$this->assertCount(1,$comment->likes);

         $this->assertTrue($comment->isLiked);

   		//hit the endpint to unlike the comment 
   		$this->delete('/comments/'. $comment->id. '/likes');

   		//assert the count updated

   		$this->assertCount(0,$comment->fresh()->likes);

         $this->assertFalse($comment->fresh()->isLiked);

   }

   /** @test */ 
   function authenticated_user_may_like_a_comment_once(){

   	  	//build the world 

     	 $this->signIn();

         $comment = create('App\Comment');

         //we could use Route Model Binding 

         $this->post('/comments/' . $comment->id.'/likes') ; 


         $this->post('/comments/' . $comment->id.'/likes') ;


         
         //It should be recorded in the databse 

         $this->assertCount(1,$comment->likes);

   }
}
