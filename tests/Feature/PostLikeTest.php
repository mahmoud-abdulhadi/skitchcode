<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostLikeTest extends TestCase
{
    
	use DatabaseMigrations ; 
      /** @test */
    function a_guest_may_not_like_a_post(){
    	$this->disableExceptionHandling()
    		->post('/posts/ldka-asdasd/likes')
    		->assertRedirect('/login');
    }

    /** @test */ 

    function authenticated_user_can_like_a_post(){

    	$this->signIn();

    	$post = create('App\Post');

    	$this->post('/posts/' . $post->slug . '/likes');


    	$this->assertCount(1,$post->likes);

      $this->assertTrue($post->isLiked);

    }


    /** @test */ 
   function authenticated_user_can_unlike_a_post(){

   		//build the fucking world now 
   		$this->signIn();

   		//create a post 
   		$post = create('App\Post');

   		//like the post 
   		$post->like();

   		$this->assertCount(1,$post->likes);

      $this->assertTrue($post->isLiked);

   		//hit the endpint to unlike the post 
   		$this->delete('/posts/'. $post->slug. '/likes');

   		//assert the count updated

   		$this->assertCount(0,$post->fresh()->likes);

      $this->assertFalse($post->fresh()->isLiked);

   }

   /** @test */ 
   function authenticated_user_may_like_a_post_once(){

   	  	//build the world 

     	 $this->signIn();

         $post = create('App\Post');

         //we could use Route Model Binding 

         $this->post('/posts/' . $post->slug.'/likes') ; 


         $this->post('/posts/' . $post->slug.'/likes') ;


         
         //It should be recorded in the database 

         $this->assertCount(1,$post->likes);

   }
}
