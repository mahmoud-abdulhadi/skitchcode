<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    
    use DatabaseMigrations ; 


    protected $thread; 

    protected function setUp(){

    	parent::setUp();


    	$this->thread = create('App\Thread');

    }

    /** @test */
    public function a_user_can_view_all_threads(){

    	$this->get('/threads')
    		->assertStatus(200)
    		->assertSee($this->thread->title);

    }

    /** @test */ 
    public function a_user_can_view_single_thread(){


        //create a thread 

        $thread = create('App\Thread');

       
        //create a comment

        $comment = create('App\Comment',['commentable_id' => $thread->id,'commentable_type' => get_class($thread)]);

        

        //when we visit the thread 
        $this->get($thread->path())
        //we see the thread title 
            ->assertSee($thread->title)
        //the thread body 
            ->assertSee($thread->body)

        //the comment body 
            ->assertSee($comment->body);
    }

    /** @test */ 
    public function a_user_can_filter_threads_according_to_a_channel()
    {

        //we create a channel 

        $channel = create('App\Channel');



        //create a thread that belongs to that channel 

        $threadInChannel = create('App\Thread',['channel_id' => $channel->id]);


        //create a thread that dones't belongs to a channel 

        $threadNotInChannel = create('App\Thread');


        //when we hit the endpoint of filtering 

        $this->get('/threads/'. $channel->slug)

        //We see the threads that belongs to the channel 
            ->assertSee($threadInChannel->title)

        //and doesn't see the threads that doesn't belong to the channel
            ->assertDontSee($threadNotInChannel->title);


    }

    

    /** @test */
    public function a_user_can_filter_threads_by_any_username(){


        //signIn A new User 

        $this->signIn(create('App\User',['username' => 'mahmoud.hadi']));


        //create a thread by that user

        $threadByUser = create('App\Thread',['user_id' => auth()->id()]); 

        //create a thread not by that user 
        $threadNotByUser = create('App\Thread');


        //when hitting endpoint fetch the threads created by that user not by else users

       $this->get('/threads?by=mahmoud.hadi')
            ->assertSee($threadByUser->title) 

           ->assertDontSee($threadNotByUser->title);


    }

    

    /** @test */ 

    function a_user_can_filter_threads_by_tags(){

         //we create a Tag 

        $tag = create('App\Tag');



        //create a thread and attach tag to it  

        $threadWithTag = create('App\Thread');

        $threadWithTag->addTag($tag);


        //create a thread not attached with that tag 

        $threadWithoutTag = create('App\Thread');


        //when we hit the endpoint of filtering 

        $this->get('/threads/tags/'. $tag->slug)

        //We see the threads that attached to the tag  
            ->assertSee($threadWithTag->title)

        //and doesn't see the threads that doesn't attached to the tag 
            ->assertDontSee($threadWithoutTag->title);
    }

    /** @test */ 
    function it_records_new_view_each_time_a_thread_is_read(){


        $thread = create('App\Thread');

        $this->assertSame(0,$thread->views);


        $this->call('GET',$thread->path());


        $this->assertEquals(1,$thread->fresh()->views);


    }

      /** @test */ 
    function a_user_can_fetch_threads_tags(){

        //create a Thread
        $thread = create('App\Thread');


        //count of post tags is 0 

        $this->assertCount(0,$thread->tags);

        //create two tags 

        $tag1 = create('App\Tag');

        $tag2 = create('App\Tag');

        //attach those tags to thread 
        $thread->addTag($tag1);

        $thread->addTag($tag2);

        $this->assertCount(2,$thread->fresh()->tags);


        //fetch the skitch tags json
       $results = $this->getJson($thread->path(). '/tags')->json();


        //count of skitch tags should be 2 

       $this->assertCount(2,$results);


    }


}
