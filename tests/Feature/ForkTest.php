<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Auth ; 

class ForkTest extends TestCase
{
   use DatabaseMigrations ; 



   /** @test */
   function a_guest_cannot_fork_any_skitch(){


   		$this->disableExceptionHandling();

   		$skitch = create('App\Skitch');


   		$this->post($skitch->path().'/forks')
   			->assertRedirect('/login');
   }

   /** @test */
   function authenticated_user_can_fork_skitches(){

   	//signIn 

   	$this->signIn();

   	//create a skitch 

   	$skitch = create('App\Skitch');
   	//hit the endpoint to create a skitch 
   	$this->post($skitch->path().'/forks')
   	//assert Redirect Status
   		->assertStatus(302);


  $this->assertCount(1,$skitch->forks);


   	


   	//assert when visiting the forked skitch page 
      //seeing the skitch title 
      //and seeing the authenticated user name  

   	$this->get($skitch->forks->first()->path())
   		->assertSee($skitch->title)
   		->assertSee(auth()->user()->name);

   }

   /** @test */ 
   function a_user_can_fetch_forks_of_skitch(){


   	$this->signIn();
   	$skitch = create('App\Skitch');	

   	create('App\Skitch',['forkable_id' => $skitch->id],10);

   $forks = $this->getJson($skitch->path().'/forks')->json();


  	$this->assertCount(10,$skitch->forks);


   }


   /** @test */ 
   function a_user_can_fetch_forks_of_another_user(){

      //create a skitch 
      $skitch  = create('App\Skitch');

      //signIn 
       $this->signIn();

       $forkingUser = auth()->user();

      //fork the skitch 

      $forkedSkitch = $skitch->fork(); 

      //logout 
      Auth::logout();


      $results = $this->getJson('/users/'.$forkingUser->username.'/forks')
                  ->assertStatus(200);

   	
   	
   }
}
