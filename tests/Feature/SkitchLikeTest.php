<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SkitchLikeTest extends TestCase
{
    use DatabaseMigrations ; 


      /** @test */
    function a_guest_may_not_like_a_skitch(){
    	$this->disableExceptionHandling()
    		->post('/skitches/3/likes')
    		->assertRedirect('/login');
    }

    /** @test */ 

    function authenticated_user_can_like_a_skitch(){

    	$this->signIn();

    	$skitch = create('App\Skitch');

    	$this->post('/skitches/' . $skitch->id . '/likes');


    	$this->assertCount(1,$skitch->likes);

      $this->assertTrue($skitch->isLiked);

    }


    /** @test */ 
   function authenticated_user_can_unlike_a_skitch(){

   		//build the fucking world now 
   		$this->signIn();

   		//create a post 
   		$skitch = create('App\Skitch');

   		//like the post 
   		$skitch->like();

   		$this->assertCount(1,$skitch->likes);

      $this->assertTrue($skitch->isLiked);

   		//hit the endpint to unlike the post 
   		$this->delete('/skitches/'. $skitch->id. '/likes');

   		//assert the count updated

   		$this->assertCount(0,$skitch->fresh()->likes);

      $this->assertFalse($skitch->fresh()->isLiked);

   }

   /** @test */ 
   function authenticated_user_may_like_a_skitch_once(){

   	  	//build the world 

     	 $this->signIn();

         $skitch = create('App\Skitch');

         //we could use Route Model Binding 

         $this->post('/skitches/' . $skitch->id.'/likes') ; 


         $this->post('/skitches/' . $skitch->id .'/likes') ;


         
         //It should be recorded in the database 

         $this->assertCount(1,$skitch->likes);

   }
}
