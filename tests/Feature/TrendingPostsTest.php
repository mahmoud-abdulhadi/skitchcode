<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TrendingPostsTest extends TestCase
{
    use DatabaseMigrations ; 

   public function setUp(){

   	parent::setUp();

      $this->trending = new \App\Trends\TrendingPosts(); 


   	$this->trending->reset();

   }


   /** @test */
   function it_increments_a_post_score_each_time_it_is_read()
   {


   		$post = create('App\Post');

   		$this->assertEmpty($this->trending->get());

       

   		$this->call('GET',$post->path());

        // dd($this->trending->get());

   		$trends = $this->trending->get();

   		$this->assertCount(1,$trends);



   		$this->assertEquals($post->title,$trends[0]->title);

         //after a test the threads is stil in Redis databas with key testing_tredning_threads
   }
}
