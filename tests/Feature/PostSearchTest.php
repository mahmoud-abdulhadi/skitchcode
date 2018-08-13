<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostSearchTest extends TestCase
{
    use DatabaseMigrations ; 


     /** @test */
   function a_user_can_search_posts(){

   	config(['scout.driver' => 'algolia']);


   	$searchTerm = 'foobar'; 

   	create('App\Post',[],2);


 	create('App\Post',['content' => " A Post contains {{$searchTerm}} ."],2);

 	$results = null ; 
   	do{
   		sleep(.25);

   		$results = $this->getJson("/posts/search?q={$searchTerm}")->json();


   	}while(empty($results));

   	
   	$this->assertCount(2,$results);

   	//cleaning test records from algolia indices 

   	\App\Post::latest()->take(4)->unsearchable();

   }

}
