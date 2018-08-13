<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MentionUsersTest extends TestCase
{
   use DatabaseMigrations ; 

    /** @test */ 
   function mentioned_users_in_comment_are_notified()
   {

   		$john = create('App\User',['username' => 'john_doe']); 

   		$this->signIn($john);

   		//create another user 
   		$mahmoud = create('App\User', ['username' => 'mahmoud_hadi']);

   		//we have a thread 

   		$thread = create('App\Thread'); 

   		//John replies mentioning Mahmoud Hadi 
   		$comment = make('App\Comment',[

   			'body' => '@mahmoud_hadi Look at this'
   		]);

   		//Now The signedIn user will post a reply to the Thread 

         //dd($comment->mentionedUsers());

   		$this->post($thread->path() . '/comments',$comment->toArray());


   		//Now , mahmoudhadi should be notified 

   		$this->assertCount(1,$mahmoud->notifications);

   }


    /** @test */ 
   function it_fetch_all_mentioned_users_starting_with_typed_characters()
   {

      $user1 = create('App\User' , ['username' => 'dondraper']);
      $user2 = create('App\User' , ['username' => 'donaldtrump']);

      $user3 = create('App\User' , ['username' => 'johndoe']);


      $results = $this->json('GET','/api/users',['username' => 'don']);

      //dd($results);

      $this->assertCount(2,$results->json());

   }

}
