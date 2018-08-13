<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkspaceSearchTest extends TestCase
{
   use DatabaseMigrations ; 

     /** @test */
   function a_user_can_search_workspaces(){

   	config(['scout.driver' => 'algolia']);


   	$searchTerm = 'foobar'; 

   	create('App\Workspace',[],2);


 	create('App\Workspace',['title' => "{{$searchTerm}} Title"],2);

 	$results = null ; 
   	do{
   		sleep(.25);

   		$results = $this->getJson("/workspaces/search?q={$searchTerm}")->json();


   	}while(empty($results));

   	
   	$this->assertCount(2,$results);

   	//cleaning test records from algolia indices 

   	\App\Skitch::latest()->take(4)->unsearchable();

   }
}
