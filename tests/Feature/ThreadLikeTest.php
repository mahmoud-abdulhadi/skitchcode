<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadLikeTest extends TestCase
{
    use DatabaseMigrations ; 

    /** @test */
    function a_guest_may_not_like_a_thread(){
    	$this->disableExceptionHandling()
    		->post('/threads/2/likes')
    		->assertRedirect('/login');
    }

    /** @test */ 

    function authenticated_user_can_like_a_thread(){

    	$this->signIn();

    	$thread = create('App\Thread');

    	$this->post('/threads/' . $thread->slug . '/likes');


    	$this->assertCount(1,$thread->likes);

      $this->assertTrue($thread->isLiked);

    }


    /** @test */ 
   function authenticated_user_can_unlike_a_thread(){

   		//build the fucking world now 
   		$this->signIn();

   		//create a comment 
   		$thread = create('App\Thread');

   		//like the comment 
   		$thread->like();

   		$this->assertCount(1,$thread->likes);

      $this->assertTrue($thread->isLiked);

   		//hit the endpint to unlike the comment 
   		$this->delete('/threads/'. $thread->slug. '/likes');

   		//assert the count updated

   		$this->assertCount(0,$thread->fresh()->likes);

      $this->assertFalse($thread->fresh()->isLiked);
   }

   /** @test */ 
   function authenticated_user_may_like_a_thread_once(){

   	  	//build the world 

     	 $this->signIn();

         $thread = create('App\Thread');

         //we could use Route Model Binding 

         $this->post('/threads/' . $thread->slug.'/likes') ; 


         $this->post('/threads/' . $thread->slug.'/likes') ;


         
         //It should be recorded in the databse 

         $this->assertCount(1,$thread->likes);

   }
}
