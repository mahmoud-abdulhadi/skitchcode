<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadSearchTest extends TestCase
{
    
	use DatabaseMigrations;

    /** @test */
   function a_user_can_search_threads(){

   	config(['scout.driver' => 'algolia']);


   	$searchTerm = 'foobar'; 

   	create('App\Thread',[],2);


 	create('App\Thread',['body' => "A Thread with the {$searchTerm} term"],2);

 	$results = null ; 
   	do{
   		sleep(.25);

   		$results = $this->getJson("/threads/search?q={$searchTerm}")->json();


   	}while(empty($results));

   	
   	$this->assertCount(2,$results);

   	//cleaning test records from algolia indices 

   	\App\Thread::latest()->take(4)->unsearchable();

   }
}
