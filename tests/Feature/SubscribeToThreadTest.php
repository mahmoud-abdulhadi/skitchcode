<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubscribeToThreadTest extends TestCase
{
   use DatabaseMigrations ; 

   /** @test */ 
   public function a_user_can_subscribe_to_threads()
   {

   		$this->signIn();


   		$thread = create('App\Thread'); 


   		$this->post($thread->path().'/subscriptions');

   		$this->assertCount(1,$thread->subscriptions);

   }

   /** @test */ 
   public function a_thread_can_unsubscribe_from_threads()
   {

   		$thread = create('App\Thread') ; 

   		$this->signIn();


   		$thread->subscribe();

   		$this->assertCount(1,$thread->subscriptions);

   		$this->delete($thread->path().'/subscriptions');

   		$this->assertCount(0,$thread->fresh()->subscriptions);


   }
}
