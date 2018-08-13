<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Carbon\Carbon ; 
use App\Activity ; 

class ActivityTest extends TestCase
{
    use DatabaseMigrations ; 


    /** @test */ 
    public function it_recoreds_activity_when_a_thread_is_created(){

    	$this->signIn();

    	$thread = create('App\Thread');

    	$this->assertDatabaseHas('activities',[
    		'type' => 'thread_created',
    		'user_id' => auth()->id(),
    		'subject_id' => $thread->id,
    		'subject_type' => 'App\Thread'

    	]);

    	$activity = \App\Activity::first();

    	$this->assertEquals($activity->subject->id , $thread->id);
    }

    /** @test */ 
    public function it_recoreds_activity_when_a_post_is_created(){

    	$this->signIn();

    	$post = create('App\Post');

    	$this->assertDatabaseHas('activities',[
    		'type' => 'post_created',
    		'user_id' => auth()->id(),
    		'subject_id' => $post->id,
    		'subject_type' => 'App\Post'

    	]);

    	$activity = \App\Activity::first();

    	$this->assertEquals($activity->subject->id , $post->id);
    }


    /** @test */ 
    public function it_recoreds_activity_when_a_skitch_is_created(){

    	$this->signIn();

    	$skitch = create('App\Skitch');

    	$this->assertDatabaseHas('activities',[
    		'type' => 'skitch_created',
    		'user_id' => auth()->id(),
    		'subject_id' => $skitch->id,
    		'subject_type' => 'App\Skitch'

    	]);

    	$activity = \App\Activity::first();

    	$this->assertEquals($activity->subject->id , $skitch->id);
    }


    /** @test */ 
    public function it_recoreds_activity_when_a_workspace_is_created(){

    	$this->signIn();

    	$workspace = create('App\Workspace');

    	$this->assertDatabaseHas('activities',[
    		'type' => 'workspace_created',
    		'user_id' => auth()->id(),
    		'subject_id' => $workspace->id,
    		'subject_type' => 'App\Workspace'

    	]);

    	$activity = \App\Activity::first();

    	$this->assertEquals($activity->subject->id , $workspace->id);
    }

     	/** @test */ 
    	public function it_records_activity_when_a_comment_is_created(){

    		$this->signIn() ; 


        	//it creates a thread in the process
    		$comment = create('App\Comment'); 

    		$this->assertEquals(2,\App\Activity::count()) ; 

    }


    /** @test */ 
    function it_records_activity_when_a_model_is_liked(){

        $this->signIn();
        $thread = create('App\Thread');

        $this->signIn();

        $like = $thread->like() ; 

        $activities = \App\Activity::all();
        $this->assertCount(2,$activities);

        //dd($activities[1]);


        $this->assertEquals($like->id,$activities[1]->subject_id);


    }



    /** @test */ 
    public function it_fetches_a_feed_for_any_user()
    {
         $this->signIn(); 

         $thread = create('App\Thread',['user_id' => auth()->id()],2);


         
         //manually make one activity one week before
         auth()->user()->activities()->first()->update(['created_at' => Carbon::now()->subWeek()]);

         //when we fetch their feed 
         $feed = Activity::feed(auth()->user());


         $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
         ));

         $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
         ));
    }
}
